<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Chooser extends CI_Controller {

	public function __construct()
    {
        parent::__construct();

        if(!$this->ion_auth->logged_in())
            redirect('/','refresh');

        $this->load->model('Application_model');
        $this->load->model('Matcher_model');

        $this->user = $this->Application_model->get(array('table'=>'users','id'=>$this->session->userdata('user_id')));

        $this->data = array();

    }

	public function index()
	{
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
