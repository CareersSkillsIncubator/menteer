<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Chooser extends CI_Controller {

	public function __construct()
    {
        parent::__construct();

        if(!$this->ion_auth->logged_in())
            redirect('/','refresh');

        $this->load->model('Application_model');
        $this->load->model('Matcher_model');
        $this->load->library('email');

        $this->user = $this->Application_model->get(array('table'=>'users','id'=>$this->session->userdata('user_id')));

        $this->session->set_userdata('skip_matches',false); // reset

        $this->data = array();

    }

	public function index()
	{

        // mentors cannot choose another mentor
        if($this->user['menteer_type']==37)
            redirect('/dashboard','refresh');

        if($this->user['match_status']=='active')
            redirect('/dashboard','refresh');

        $matches = $this->session->userdata('matches');

        // make sure we have matches

        if(is_array($matches) && count($matches) > 0){

            // lets add some data to the matches

            foreach($matches as $key=>$val) {

                // get user info
                $mentors[$key]['match_score'] = $val;

                $mentors[$key]['user'] = $this->Application_model->get(array('table'=>'users','id'=>$key));

                $mentors[$key]['answers'] = $this->_extract_data($this->Matcher_model->get(array('table'=>'users_answers','user_id'=>$key)));
            }

            //printer($mentors);

        }else{
            $this->session->set_userdata('skip_matches',true);
            redirect('/dashboard','refresh');
        }

        $this->data['page'] = 'chooser';
        $this->data['user'] = $this->user;
        $this->data['mentors'] = $mentors;

        $this->load->view('/chooser/header',$this->data);
        $this->load->view('/chooser/index',$this->data);
        $this->load->view('/chooser/footer',$this->data);

    }

    // mentor accepts or declines
    public function profile()
    {

        // lets check if we can access this method

        if($this->user['menteer_type']==37 && $this->user['is_matched'] > 0 && $this->user['match_status']=='pending') {

            // get mentee
            $mentee_id = $this->user['is_matched'];
            $mentee['profile']['user'] = $this->Application_model->get(array('table' => 'users', 'id' => $mentee_id));
            $mentee['profile']['answers'] = $this->_extract_data(
                $this->Matcher_model->get(array('table' => 'users_answers', 'user_id' => $mentee_id))
            );

            $this->data['page'] = 'profile';
            $this->data['user'] = $this->user;
            $this->data['mentee'] = $mentee;

            $this->load->view('/chooser/header', $this->data);
            $this->load->view('/chooser/profile', $this->data);
            $this->load->view('/chooser/footer', $this->data);

        }else{

            redirect('/dashboard');

        }

    }

    public function accept()
    {

        if($this->user['menteer_type']==37 && $this->user['is_matched'] > 0 && $this->user['match_status']=='pending') {

            // mentor update
            $update_user = array(
                'id' => $this->session->userdata('user_id'),
                'data' => array('match_status' => 'active'),
                'table' => 'users'
            );
            $this->Application_model->update($update_user);

            // mentee update
            $update_user = array(
                'id' => $this->user['is_matched'],
                'data' => array('match_status' => 'active'),
                'table' => 'users'
            );
            $this->Application_model->update($update_user);

            $mentee = $this->Application_model->get(array('table'=>'users','id'=>$this->user['is_matched']));

            // notify mentee about the accept

            $data = array();
            $data['first_name'] = $this->user['first_name'];
            $data['last_name'] = $this->user['last_name'];

            $message = $this->load->view('/chooser/email/accept', $data, true);
            $this->email->clear();
            $this->email->from($this->config->item('admin_email', 'ion_auth'), $this->config->item('site_title', 'ion_auth'));
            $this->email->to($mentee['email']);
            $this->email->subject('Mentor has accepted');
            $this->email->message($message);

            $result = $this->email->send(); // @todo handle false send result

            $this->session->set_flashdata('message', '<div class="alert alert-success">The Mentee has been notified about the acceptance.</div>');
            redirect('/dashboard');

        }else{

            redirect('/dashboard');

        }

    }

    public function decline()
    {

        if($this->user['menteer_type']==37 && $this->user['is_matched'] > 0 && $this->user['match_status']=='pending') {

            // mentor update
            $update_user = array(
                'id' => $this->session->userdata('user_id'),
                'data' => array('is_matched' => '0'),
                'table' => 'users'
            );
            $this->Application_model->update($update_user);

            // mentee update
            $update_user = array(
                'id' => $this->user['is_matched'],
                'data' => array('is_matched' => '0'),
                'table' => 'users'
            );
            $this->Application_model->update($update_user);

            $mentee = $this->Application_model->get(array('table'=>'users','id'=>$this->user['is_matched']));

            // notify mentee about the accept

            $data = array();
            $data['first_name'] = $this->user['first_name'];
            $data['last_name'] = $this->user['last_name'];

            $message = $this->load->view('/chooser/email/decline', $data, true);
            $this->email->clear();
            $this->email->from($this->config->item('admin_email', 'ion_auth'), $this->config->item('site_title', 'ion_auth'));
            $this->email->to($mentee['email']);
            $this->email->subject('Mentor has declined');
            $this->email->message($message);

            $result = $this->email->send(); // @todo handle false send result

            $this->session->set_flashdata('message', '<div class="alert alert-success">The Mentee has been notified.</div>');
            redirect('/dashboard');

        }else{

            redirect('/dashboard');

        }

    }

    public function select($mentor_id) {

        // mentors cannot choose another mentor
        if($this->user['menteer_type']==37)
            redirect('/dashboard','refresh');

        // make sure mentor is not selected, if so return back to chooser

        $mentor_id = decrypt_url($mentor_id);

        $mentor = $this->Application_model->get(array('table'=>'users','id'=>$mentor_id));

        if($mentor['is_matched']==0){

            // update mentee
            $update_user = array(
                'id' => $this->session->userdata('user_id'),
                'data' => array('is_matched' => $mentor_id,'match_status' => 'pending'),
                'table' => 'users'
            );
            $this->Application_model->update($update_user);

            // update mentor
            $update_user = array(
                'id' => $mentor_id,
                'data' => array('is_matched' => $this->session->userdata('user_id'),'match_status' => 'pending'),
                'table' => 'users'
            );
            $this->Application_model->update($update_user);

            // send email to mentor to approve or decline request

            $data = array();
            $data['first_name'] = $this->user['first_name'];
            $data['last_name'] = $this->user['last_name'];

            $message = $this->load->view('/chooser/email/match_request', $data, true);
            $this->email->clear();
            $this->email->from($this->config->item('admin_email', 'ion_auth'), $this->config->item('site_title', 'ion_auth'));
            $this->email->to($mentor['email']);
            $this->email->subject('Request to Mentor');
            $this->email->message($message);

            $result = $this->email->send(); // @todo handle false send result

            $this->session->set_flashdata('message', '<div class="alert alert-info">The Mentor you selected has been notified. You will be sent an email once they accept.</div>');
            redirect('/dashboard');


        }else{

            $this->session->set_flashdata('message', '<div class="alert alert-danger">Sorry, the Mentor you selected was just matched. Please select again.</div>');
            redirect('/chooser');

        }

    }

    protected function _extract_data($mentor_answers) {

        $question = array();

        foreach($mentor_answers as $item){

            if($item['questionnaire_answer_id'] == 0)
                $answer = $item['questionnaire_answer_text'];
            else
                $answer = $this->Application_model->get(array('table'=>'questionnaire_answers','id'=>$item['questionnaire_answer_id']));

            $question[$item['questionnaire_id']][] = $answer;

        }

        return $question;
    }

}
