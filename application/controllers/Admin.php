<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function page($view = 'home')
    {
        $this->load->view("admin/$view");
    }

}

/* End of file Admin.php */
