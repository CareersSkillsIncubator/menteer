<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Menteer
 *
 * Original Code is Menteer, Released January 2015
 *
 * The initial developer of the Original Code is CSCI (CareerSkillsIncubator) with
 * the generous support from CIRA.ca (Community Investment Program)
 *
 *
 */

// main dashboard for mentor and mentee
class Dashboard extends CI_Controller {


    public function __construct()
    {
        parent::__construct();

        if(!$this->ion_auth->logged_in())
            redirect('/','refresh');

        if($this->ion_auth->is_admin())
            redirect('/admin','refresh');

        $this->load->model('Application_model');
        $this->load->helper('form');
        $this->user = $this->Application_model->get(array('table'=>'users','id'=>$this->session->userdata('user_id')));

        // check for setup
        if($this->user['is_setup'] == 0) {
            $this->_setup();
        }

        // is this user a mentor or menteer or both
        $val = $this->Application_model->get(array('table'=>'users_answers','user_id'=>$this->session->userdata('user_id'),'questionnaire_id'=>TYPE_QUESTION_ID,));

        // figure out which type we are
        switch($val['questionnaire_answer_id']) {
            case MENTOR_ID:
                $this->session->set_userdata('user_kind','mentor');
                break;
            case MENTEE_ID:
                $this->session->set_userdata('user_kind','mentee');
                break;
            default:
                $this->session->set_userdata('user_kind','both');
        }

        if($this->user['agree']== 1) {
            // check if we need to show the user matches before we begin
            // check for matches available otherwise go to dashboard

            if ($this->input->get('skip') == 1) {
                $this->session->set_userdata('skip_matches', true);
            }

            if ($this->user['is_matched'] == 0 && $this->session->userdata('skip_matches') == false) {
                $this->load->library('matcher');
                $matches = $this->matcher->get_matches($this->session->userdata('user_id'));

                if (is_array($matches) && count($matches) > 0) {
                    $this->session->set_userdata('matches', $matches);
                    $this->session->set_userdata('skip_matches', true);
                    //redirect('/chooser');
                } else {
                    $this->session->set_userdata('matches', $matches);
                    $this->session->set_userdata('skip_matches', true);
                }
            }
        }

        $this->data = array();
    }

    // main
	public function index()
	{

        $this->data['page'] = 'dash';
        $this->data['user'] = $this->user;

        $this->load->view('/dash/header',$this->data);
        $this->load->view('/dash/index',$this->data);
        $this->load->view('/dash/footer',$this->data);

    }

    //end match
    public function end($match_id)
    {

        if(decrypt_url($match_id) > 0 && $this->user['menteer_type']==37) {

            $update['id'] = $this->session->userdata('user_id');
            $update['data']['is_matched'] = 0;
            $update['data']['match_status'] = 'pending';
            $update['table'] = 'users';
            $this->Application_model->update($update);

            $update['id'] = decrypt_url($match_id);
            $update['data']['is_matched'] = 0;
            $update['data']['match_status'] = 'pending';
            $update['table'] = 'users';
            $this->Application_model->update($update);

            $update = array();

            $update['data']['mentee_id'] = decrypt_url($match_id);
            $update['data']['mentor_id'] = $this->session->userdata('user_id');
            $update['data']['stamp'] = date("Y-m-d H:i:s");
            $update['table'] = 'matches_ended';
            $this->Application_model->insert($update);

            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success">Match Has Ended</div>'
            );
        }

        redirect('/dashboard','refresh');

    }

    //revoke match request
    public function revoke($match_id)
    {

        if(decrypt_url($match_id) > 0 && $this->user['menteer_type']==38) {

            $update['id'] = $this->session->userdata('user_id');
            $update['data']['is_matched'] = 0;
            $update['data']['match_status'] = 'pending';
            $update['table'] = 'users';
            $this->Application_model->update($update);

            $update['id'] = decrypt_url($match_id);
            $update['data']['is_matched'] = 0;
            $update['data']['match_status'] = 'pending';
            $update['table'] = 'users';
            $this->Application_model->update($update);

            $update = array();

            $update['data']['mentor_id'] = decrypt_url($match_id);
            $update['data']['mentee_id'] = $this->session->userdata('user_id');
            $update['data']['stamp'] = date("Y-m-d H:i:s");
            $update['table'] = 'matches_revoked';
            $this->Application_model->insert($update);

            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success">Match Request Revoked</div>'
            );
        }

        redirect('/dashboard','refresh');

    }

    // see this profile
    public function myprofile()
    {

        $this->data['page'] = 'profile';
        $this->data['me'] = $this->user;
        $this->data['user'] = $this->user;

        $this->load->view('/dash/header', $this->data);
        $this->load->view('/dash/myprofile', $this->data);
        $this->load->view('/dash/footer', $this->data);
    }

    // save profile info
    public function save_profile()
    {

        $this->load->library('upload');

        // save profile data
        $update['id'] = $this->session->userdata('user_id');
        $update['data']['location'] = $this->input->post('location');
        $update['data']['phone'] = $this->input->post('phone');
        $update['data']['career_status'] = $this->input->post('career_status');
        $update['data']['career_goals'] = $this->input->post('career_goals');
        $update['data']['education'] = $this->input->post('education');
        $update['data']['experience'] = $this->input->post('experience');
        $update['data']['skills'] = $this->input->post('skills');
        $update['data']['passion'] = $this->input->post('passion');
        $update['table'] = 'users';
        $this->Application_model->update($update);

        // lets save and upload their picture if available
        $config['upload_path']          = './uploads/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 50000;
        $config['max_width']            = 8000;
        $config['max_height']           = 8000;
        $config['file_ext_tolower']     = TRUE;
        //$config['min_width']            = 25;
        $config['encrypt_name']         = TRUE;

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        $upload_errors = '';

        if(isset($_FILES['userfile']['name']) && $_FILES['userfile']['name'] != '') {

            if (!$this->upload->do_upload()) {

                $upload_errors = $this->upload->display_errors();

            } else {
                //$upload_data = array('upload_data' => $this->upload->data());


                // lets resize and crop
                if($this->upload->data('image_width') > 200) {

                    $config['image_library'] = 'gd2';
                    $config['source_image'] = './uploads/'.$this->upload->data('file_name');
                    $config['width']         = 200;

                    if($this->upload->data('file_size') <= 2000) {
                        $config['quality'] = '95%';
                    }

                    if($this->upload->data('file_size') > 2000) {
                        $config['quality'] = '85%';
                    }

                    $this->load->library('image_lib', $config);

                    $this->image_lib->resize();


                }

                $upload['id'] = $this->session->userdata('user_id');
                $upload['data']['picture'] = $this->upload->data('file_name');
                $upload['table'] = 'users';
                $this->Application_model->update($upload);

            }
        }


        if($upload_errors) {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger">'.$upload_errors.'</div>'
            );
            redirect('/dashboard/myprofile','refresh');
        }else {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success">Profile Saved.</div>'
            );
            redirect('/dashboard','refresh');
        }


    }

    // see match profile
    public function match()
    {

        $this->data['page'] = 'profile';
        $match_id = $this->user['is_matched'];

        $this->data['match'] = $this->Application_model->get(array('table'=>'users','id'=>$match_id));

        $this->data['user'] = $this->user;

        if($this->user['is_matched'] > 0) {

            $this->load->view('/dash/header', $this->data);
            $this->load->view('/dash/match', $this->data);
            $this->load->view('/dash/footer', $this->data);

        }else{
            redirect('/dashboard','refresh');
        }

    }

    // send meeting invite with ics to your match
    public function send_meeting()
    {
        // save meeting
        if($this->user['is_matched'] > 0) {
            $update['data']['from'] = $this->session->userdata('user_id');
            $update['data']['to'] = $this->user['is_matched'];
            $update['data']['meeting_subject'] = $this->input->post('meeting_subject');
            $update['data']['meeting_desc'] = $this->input->post('meeting_desc');
            $update['data']['month'] = $this->input->post('month');
            $update['data']['day'] = $this->input->post('day');
            $update['data']['year'] = $this->input->post('year');
            $update['data']['start_ampm'] = $this->input->post('start_ampm');
            $update['data']['end_ampm'] = $this->input->post('end_ampm');
            $update['data']['stamp'] = date("Y-m-d H:i:s");
            $update['data']['start_time'] = $this->input->post('start_time');
            $update['data']['end_time'] = $this->input->post('end_time');

            $update['table'] = 'meetings';
            $update['data']['ical'] = encrypt_url($this->Application_model->insert($update));

            // send emails to each party

            $match = $this->Application_model->get(array('table'=>'users','id'=>$this->user['is_matched']));
            $update['data']['who'][] = $match['first_name'] . " " . $match['last_name'];
            $update['data']['who'][] = $this->user['first_name'] . " " . $this->user['last_name'];

            //convert date and time to nice format
            $nice_date = date('D M d, Y',strtotime($this->input->post('day')."-".$this->input->post('month')."-".$this->input->post('year')));
            $update['data']['nice_date'] = $nice_date;

            // to requesting user
            $data = array();
            $data['user'] = $this->user['first_name'] . " " . $this->user['last_name'];
            $data['message'] = $update['data'];
            $message = $this->load->view('/dash/email/meeting', $data, true);
            $this->email->clear();
            $this->email->from($this->config->item('admin_email', 'ion_auth'), $this->config->item('site_title', 'ion_auth'));
            $this->email->to($this->user['email']);

            $full_subject = "Invitation: " . $nice_date . " " . $this->input->post('start_time') . "" . $this->input->post('start_ampm') . " - " . $this->input->post('end_time') . "" . $this->input->post('end_ampm') . " (" . $this->user['first_name'] . " " . $this->user['last_name'] . ")";

            $this->email->subject($full_subject);
            $this->email->message($message);

            $result = $this->email->send(); // @todo handle false send result


            // to invitee
            $data = array();
            $data['user'] = $match['first_name'] . " " . $match['last_name'];
            $data['message'] = $update['data'];
            $message = $this->load->view('/dash/email/meeting', $data, true);
            $this->email->clear();
            $this->email->from($this->config->item('admin_email', 'ion_auth'), $this->config->item('site_title', 'ion_auth'));
            $this->email->to($match['email']);

            $full_subject = "Invitation: " . $nice_date . " " . $this->input->post('start_time') . "" . $this->input->post('start_ampm') . " - " . $this->input->post('end_time') . "" . $this->input->post('end_ampm') . " (" . $match['first_name'] . " " . $match['last_name'] . ")";

            $this->email->subject($full_subject);
            $this->email->message($message);

            $result = $this->email->send(); // @todo handle false send result


            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success">Meeting Request Sent.</div>'
            );

            redirect('/dashboard/match','refresh');
        }else{

            redirect('/dashboard','refresh');

        }

    }

    // send email message to match
    public function send_message()
    {

        // get email of match

        $match_id = $this->user['is_matched'];

        if($match_id > 0) {

            $match = $this->Application_model->get(array('table'=>'users','id'=>$match_id));

            $send_to = $match['email'];
        }

        $data = array();
        $data['user'] = $this->user['first_name'] . " " . $this->user['last_name'];
        $data['message'] = nl2br($this->input->post('message_body'));
        $message = $this->load->view('/dash/email/message', $data, true);
        $this->email->clear();
        $this->email->from($this->config->item('admin_email', 'ion_auth'), $this->config->item('site_title', 'ion_auth'));
        $this->email->to($send_to);
        $this->email->subject($this->input->post('message_subject'));
        $this->email->message($message);

        $result = $this->email->send(); // @todo handle false send result

        // increment number of messages sent
        $update['id'] = $this->session->userdata('user_id');
        $update['data']['num_messages_sent'] = $this->user['num_messages_sent'] + 1;
        $update['table'] = 'users';
        $this->Application_model->update($update);

        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success">Message Sent.</div>'
        );

        redirect('/dashboard/match');

    }

    // view my settings page
    public function settings()
    {

        $this->data['page'] = 'settings';
        $this->data['user'] = $this->user;

        // get privacy settings

        $my_privacy = explode(',',$this->user['privacy_settings']);

        $this->data['settings'] = $my_privacy;

        $this->load->view('/dash/header',$this->data);
        $this->load->view('/dash/settings',$this->data);
        $this->load->view('/dash/footer',$this->data);

    }

    // delete - actually disable account for now
    public function delete()
    {

        $update['id'] = $this->session->userdata('user_id');
        $update['data']['enabled'] = 0;
        $update['data']['active'] = 0;
        $update['table'] = 'users';
        $this->Application_model->update($update);

        redirect('/logout','refresh');

    }

    // save settings
    public function settings_save()
    {

        // check if privacy settings changed

        $s1 = 0;
        $s2 = 0;
        $s3 = 0;

        if ($this->input->post('share_email'))
            $s1 = 1;

        if ($this->input->post('share_phone'))
            $s2 = 1;

        if ($this->input->post('share_location'))
            $s3 = 1;

        $update['id'] = $this->session->userdata('user_id');
        $update['data']['privacy_settings'] = $s1.",".$s2.",".$s3;
        $update['data']['enabled'] = intval($this->input->post('enabled'));

        switch($this->input->post('menteer_type')){
            case "37" :
                $update['data']['menteer_type'] = 37;
                break;
            default :
                $update['data']['menteer_type'] = 38;
        }

        $update['table'] = 'users';
        $this->Application_model->update($update);


        //check if password being changed

        if($this->input->post('oldpassword') != '') {

            // validate old password

            if ($this->ion_auth->login_check($this->session->userdata('email'), $this->input->post('oldpassword'))){

                // correct password so lets change it

                if(strlen($this->input->post('newpassword')) >= $this->config->item('min_password_length','ion_auth') && $this->input->post('newpassword') <= $this->config->item('max_password_length','ion_auth')) {

                    $this->ion_auth->change_password(
                        $this->session->userdata('email'),
                        $this->input->post('oldpassword'),
                        $this->input->post('newpassword')
                    );

                    $this->session->set_flashdata(
                        'message',
                        '<div class="alert alert-success">Settings Updated.</div>'
                    );

                    redirect('/dashboard', 'refresh');
                }else{

                    $this->session->set_flashdata('message', '<div class="alert alert-danger">Password must be between 8 and 20 characters in length.</div>');
                    redirect('/dashboard/settings','refresh');
                }

            }else{

                $this->session->set_flashdata('message', '<div class="alert alert-danger">Incorrect Password.</div>');
                redirect('/dashboard/settings','refresh');

            }

        }
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success">Settings Updated.</div>'
        );
        redirect('/dashboard','refresh');


    }

    // initial registration agreement of terms disclaimer user must accept or logout of system.
    // will be prompted each time they login until they accept the site agreement
    public function accept()
    {

        $update['id'] = $this->session->userdata('user_id');
        $update['data']['agree'] = '1';
        $update['table'] = 'users';
        $this->Application_model->update($update);

        redirect('/dashboard','refresh');

    }

    /**
     * User Setup - Run Once Only!
     */
    protected function _setup() {

        // we must have data
        if($this->user['frm_data'] == '') {
            return false;
        }

        //update user table first to ensure we don't run this again
        $update_user = array(
            'id' => $this->session->userdata('user_id'),
            'data' => array('is_setup' => 1),
            'table' => 'users'
        );

        $this->Application_model->update($update_user);

        $frm_data_arr = json_decode($this->user['frm_data']);

        $batch = array();

        foreach($frm_data_arr as $data) {

            // only use questionnaire fields
            if(intval($data->name) > 0) {

                // get questionnaire info
                $question_arr = $this->Application_model->get(array('table'=>'questionnaire','id'=>$data->name));

                switch($question_arr['type']){
                    case 'list':
                    case 'yesno':

                        // break up list and prep
                        $list_arr = explode(',',$data->value);

                        foreach($list_arr as $item){

                            $list = array(
                                'user_id' => $this->session->userdata('user_id'),
                                'questionnaire_id' => $data->name,
                                'questionnaire_answer_text' => strtolower(trim($item)),
                                'questionnaire_answer_id' => 0
                            );
                            $batch[] = $list;

                        }

                        break;

                    case 'open':

                        $list = array(
                            'user_id' => $this->session->userdata('user_id'),
                            'questionnaire_id' => $data->name,
                            'questionnaire_answer_text' => strtolower(trim($data->value)),
                            'questionnaire_answer_id' => 0
                        );
                        $batch[] = $list;

                        break;
                    default:

                        $list = array(
                            'user_id' => $this->session->userdata('user_id'),
                            'questionnaire_id' => $data->name,
                            'questionnaire_answer_text' => '',
                            'questionnaire_answer_id' => $data->value
                        );
                        $batch[] = $list;
                }
            }
        }

        $save_data = array(
            'data' => $batch,
            'table' => 'users_answers'
        );

        $this->Application_model->save_batch($save_data);

        // is this user a mentor or menteer or both
        $val = $this->Application_model->get(array('table'=>'users_answers','user_id'=>$this->session->userdata('user_id'),'questionnaire_id'=>TYPE_QUESTION_ID,));

        // temporarily @todo make changes to allow users to be both
        if ($val['questionnaire_answer_id']== 41)
            $val['questionnaire_answer_id'] = 37;

        //clean the user table of this information for security
        $update_user = array(
            'id' => $this->session->userdata('user_id'),
            'data' => array('frm_data' => '','menteer_type' => $val['questionnaire_answer_id']),
            'table' => 'users'
        );
        $this->Application_model->update($update_user);

        // send the mentor an email
        if($val['questionnaire_answer_id'] == 37) {
            $data = array();

            $message = $this->load->view('/dash/email/welcome_mentor', $data, true);
            $this->email->clear();
            $this->email->from($this->config->item('admin_email', 'ion_auth'), $this->config->item('site_title', 'ion_auth'));
            $this->email->to($this->user['email']);
            $this->email->subject('Welcome to Menteer.ca');
            $this->email->message($message);

            $result = $this->email->send(); // @todo handle false send result
        }
    }
}