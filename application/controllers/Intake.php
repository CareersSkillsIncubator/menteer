<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Intake extends CI_Controller {

	public function __construct()
    {
        parent::__construct();

        $this->data = array();
    }

	public function index()
	{
        $this->data['page'] = 'home';
        $this->load->view('/intake/header',$this->data);
		$this->load->view('/intake/intake',$this->data);
        $this->load->view('/intake/footer',$this->data);
    }




}
