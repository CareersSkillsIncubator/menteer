<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->data = array();
    }

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

}

/* End of file welcome.php */
/* Location: ./application/controllers/Welcome.php */