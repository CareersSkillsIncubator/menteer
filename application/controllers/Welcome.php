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
        $this->load->view('/static/header',$this->data);
		$this->load->view('/static/home',$this->data);
        $this->load->view('/static/footer',$this->data);
    }


    public function email()
    {

        $this->load->view('/auth/email/base');

    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/Welcome.php */