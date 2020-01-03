<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

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

}

/* End of file Admin.php */
