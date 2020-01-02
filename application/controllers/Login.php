<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

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

    public function logout()
    {
        $this->session->unset_userdata('account');
        redirect('');
    }

}

/* End of file Login.php */
