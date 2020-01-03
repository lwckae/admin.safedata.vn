<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Server extends CI_Controller {
    public function checkConnection()
    {
        max_execution_time(10);
        max_input_time(10);
        $server = array(
            'username' => $this->input->post('username'),
            'hostname' => $this->input->post('hostname'),
            'port' => $this->input->post('port')
        );
        $data = shell_exec('ssh '.$server['username'].'@'.$server['hostname'].' -p '.$server['port'].' -o '.'StrictHostKeyChecking=no echo test');
        if($data == 'test')
        {
            echo '<div class="badge badge-success"><i class="fa fa-check"></i> Successfully</div>';
        }
        else
            echo '<div class="badge badge-danger">Failed</div>';
    }
}

/* End of file Server.php */
