<?php defined('BASEPATH') OR exit('No direct script access allowed');

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

// static home page
class Welcome extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->data = array();
    }

    // home page
	public function index()
	{
        $this->data['page'] = 'home';

        $this->data['remember_email'] = '';

        if($this->input->cookie('rememberuseremail', TRUE))
            $this->data['remember_email'] = $this->input->cookie('rememberuseremail', TRUE);

        $this->load->view('/static/header',$this->data);
		$this->load->view('/static/home',$this->data);
        $this->load->view('/static/footer',$this->data);
    }

    // debugging sample email only
    public function email()
    {

        $data = array();
        $data['first_name'] = "Jason";
        $data['last_name'] = "Tester";

        $this->load->view('/chooser/email/match_request',$data);

    }

    // privacy page
    public function privacy()
    {
        $this->data['page'] = 'privacy';

        $this->load->view('/static/header',$this->data);
        $this->load->view('/static/privacy',$this->data);
        $this->load->view('/static/footer',$this->data);
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/Welcome.php */