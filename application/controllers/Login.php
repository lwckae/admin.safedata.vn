<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        if( $this->session->has_userdata('account'))
            redirect($this->config->item('adminView'));
    }

    public function view()
    {
        $this->load->view('login/view');
    }

    public function process()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $this->backend_model->loginStrapi($email, $password);            
    }

}

/* End of file Login.php */
