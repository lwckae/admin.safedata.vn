<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        if(! $this->session->has_userdata('account'))
            redirect();
    }
    
    public function page($view = 'home')
    {
        // Debug mode 
        echo '<!--';
        print_r($_SESSION['account']);
        echo '-->';
        // Get value from backend server
        $pull['data'] = $this->backend_model->serverSingleAPI($view);
        // Load view
        $this->load->view("admin/$view", $pull);
    }

    public function logout()
    {
        $this->session->unset_userdata('account');
        redirect('');
    }

}

/* End of file Admin.php */
