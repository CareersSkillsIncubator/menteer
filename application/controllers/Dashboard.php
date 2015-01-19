<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {


    public function __construct()
    {
        parent::__construct();

        if(!$this->ion_auth->logged_in())
            redirect('/','refresh');


        $this->load->model('Application_model');

        $this->user = $this->Application_model->get(array('table'=>'users','id'=>$this->session->userdata('user_id')));

        // check for setup
        if($this->user['is_setup'] == 0) {
            $this->_setup();
        }

        // is this user a mentor or menteer or both
        $val = $this->Application_model->get(array('table'=>'users_answers','user_id'=>$this->session->userdata('user_id'),'questionnaire_id'=>TYPE_QUESTION_ID,));

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
                    redirect('/chooser');
                } else {
                    $this->session->set_userdata('skip_matches', true);
                }
            }
        }

        $this->data = array();
    }

	public function index()
	{

        $this->data['page'] = 'dash';
        $this->data['user'] = $this->user;

        $this->load->view('/dash/header',$this->data);
        $this->load->view('/dash/index',$this->data);
        $this->load->view('/dash/footer',$this->data);

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
