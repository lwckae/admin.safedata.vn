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
        echo '<!-- debug ';
        $os = system('uname');
        echo ' end debug -->';
        if(str_replace(array("\n", "\r"),'', $os) == 'Linux')
        {
            echo '<!-- debug ';
            $request = system('ssh '.$server['username'].'@'.$server['hostname'].' -p '.$server['port'].' -o '.'StrictHostKeyChecking=no echo test');
            echo ' end debug -->';
            if($request == 'test')
            {
                echo '<div class="badge badge-success"><i class="fa fa-check"></i> Successfully</div>';
            }
            else
                echo '<div class="badge badge-danger">Failed</div>';
        }
        else
        {
            echo '<div class="badge badge-warning">Not supported!</div>';
        }
        
    }
}

/* End of file Server.php */
