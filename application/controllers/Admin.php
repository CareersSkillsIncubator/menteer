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

// administer platform
class Admin extends CI_Controller {

    public function __construct()
    {
        parent::__construct();


        if(!$this->ion_auth->is_admin())
            redirect('/');

        $this->load->model('Application_model');

        $this->data= array();
    }

    public function index()
    {

        $this->load->view('/admin/header',$this->data);
        $this->load->view('/admin/index',$this->data);
        $this->load->view('/admin/footer',$this->data);

    }

}
