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

// administrate platform
class Admin extends CI_Controller {

    public function __construct()
    {
        parent::__construct();


        if(!$this->ion_auth->is_admin())
            redirect('/');

        $this->load->model('Application_model');

        $this->data= array();
    }

    // export user list then delete from server
    public function export()
    {
        // get all users
        $users = $this->Application_model->get(array('table' => 'users'));

        $list = array();
        foreach ($users as $user) {

            $list[] = array("{$user['first_name']}", "{$user['last_name']}", "{$user['email']}");

        }

        $fp = fopen('exports/export.csv', 'w+');

        foreach ($list as $fields) {
            fputcsv($fp, $fields);
        }

        fclose($fp);

        $path = "exports/export.csv";
        $name = "export.csv";
        // make sure it's a file before doing anything!
        if (is_file($path)) {
            // required for IE
            if (ini_get('zlib.output_compression')) {
                ini_set('zlib.output_compression', 'Off');
            }

            // get the file mime type using the file extension
            $this->load->helper('file');

            $mime = get_mime_by_extension($path);

            // Build the headers to push out the file properly.
            header('Pragma: public');     // required
            header('Expires: 0');         // no cache
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Last-Modified: ' . gmdate('D, d M Y H:i:s', filemtime($path)) . ' GMT');
            header('Cache-Control: private', false);
            header('Content-Type: ' . $mime);  // Add the mime type from Code igniter.
            header('Content-Disposition: attachment; filename="' . basename($name) . '"');  // Add the file name
            header('Content-Transfer-Encoding: binary');
            header('Content-Length: ' . filesize($path)); // provide file size
            header('Connection: close');
            readfile($path); // push it out
            unlink($path);
            exit();

        }
    }

    // show admin console
    public function index()
    {

        // get all users
        $this->data['users'] = $this->Application_model->get(array('table'=>'users'));

        // get data
        $this->data['mentors'] = $this->Application_model->get(array('table'=>'users','mentors'=>true));
        $this->data['mentees'] = $this->Application_model->get(array('table'=>'users','mentees'=>true));
        $this->data['both'] = $this->Application_model->get(array('table'=>'users_answers','both'=>true));
        $this->data['matched'] = $this->Application_model->get(array('table'=>'users','matched'=>true));
        $this->data['meetings'] = $this->Application_model->get(array('table'=>'meetings'));

        $this->data['tasks'] = $this->Application_model->get(array('table'=>'tasks'));
        $this->data['events'] = $this->Application_model->get(array('table'=>'events'));

        $this->load->view('/admin/header',$this->data);
        $this->load->view('/admin/index',$this->data);
        $this->load->view('/admin/footer',$this->data);

    }

    // activate a user from admin
    public function activate($user_id)
    {

        $update['id'] = decrypt_url($user_id);
        $update['data']['active'] = 1;
        $update['table'] = 'users';
        $this->Application_model->update($update);

        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success">User Activated</div>'
        );

        redirect('/admin','refresh');
    }

    //matches ended stats
    public function matches()
    {
        $this->data['revokes'] = $this->Application_model->get(array('table'=>'matches_revoked'));
        $this->data['ends'] = $this->Application_model->get(array('table'=>'matches_ended'));

        $this->load->view('/admin/header',$this->data);
        $this->load->view('/admin/matches',$this->data);
        $this->load->view('/admin/footer',$this->data);
    }

    //survey page
    public function survey()
    {

        $this->data['content'] = $this->Application_model->get(array('table'=>'survey'));

        // get answer counts

        $this->data['counts'] = $this->Application_model->get(array('table'=>'survey_answers','group_by'=>'answer'));

        $this->load->view('/admin/header',$this->data);
        $this->load->view('/admin/survey',$this->data);
        $this->load->view('/admin/footer',$this->data);

    }

    // survey save
    public function survey_save()
    {
        $update['id'] = 1;
        $update['data']['question'] = $this->input->post('question');

        if($this->input->post('publish'))
            $update['data']['is_active'] = 1;
        else
            $update['data']['is_active'] = 0;

        $update['table'] = 'survey';
        $this->Application_model->update($update);

        $update['id'] = 2;
        $update['data']['answer'] = $this->input->post('answer1');
        $update['table'] = 'survey';
        $this->Application_model->update($update);

        $update['id'] = 3;
        $update['data']['answer'] = $this->input->post('answer2');
        $update['table'] = 'survey';
        $this->Application_model->update($update);

        $update['id'] = 4;
        $update['data']['answer'] = $this->input->post('answer3');
        $update['table'] = 'survey';
        $this->Application_model->update($update);

        $update['id'] = 6;
        $update['data']['answer'] = $this->input->post('answer4');
        $update['table'] = 'survey';
        $this->Application_model->update($update);


        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success">Saved</div>'
        );

        redirect('/admin','refresh');

    }

    public function survey_reset()
    {
        $this->Application_model->reset('survey_answers');

        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success">Survey Reset</div>'
        );

        redirect('/admin/survey','refresh');
    }

    //cms page
    public function cms()
    {

        $this->data['content'] = $this->Application_model->get(array('table'=>'content'));

        $this->load->view('/admin/header',$this->data);
        $this->load->view('/admin/cms',$this->data);
        $this->load->view('/admin/footer',$this->data);

    }

    // cms save
    public function cms_save()
    {

        $update['id'] = 1;
        $update['data']['description'] = $this->input->post('about');
        $update['table'] = 'content';
        $this->Application_model->update($update);

        $update['id'] = 2;
        $update['data']['description'] = $this->input->post('story');
        $update['table'] = 'content';
        $this->Application_model->update($update);

        $update['id'] = 3;
        $update['data']['description'] = $this->input->post('donate');
        $update['table'] = 'content';
        $this->Application_model->update($update);

        $update['id'] = 4;
        $update['data']['description'] = $this->input->post('thanks');
        $update['table'] = 'content';
        $this->Application_model->update($update);


        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success">Saved</div>'
        );

        redirect('/admin','refresh');
    }

}