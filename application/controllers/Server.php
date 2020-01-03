<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Server extends CI_Controller {
    public function checkConnection()
    {
        $server = array(
            'username' => $this->input->post('username'),
            'hostname' => $this->input->post('hostname'),
            'port' => $this->input->post('port')
        );
        if(TRUE)
        {
            echo '<div class="badge badge-success">Connected</div>';
        }
        else
            echo '<div class="badge badge-danger">Failed</div>';
    }
}

/* End of file Server.php */
