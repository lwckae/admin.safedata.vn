<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Server extends CI_Controller {
    private function checkRemoteConnection($username, $hostname, $port){
        $query = 'ssh '.$username.'@'.$hostname.' -p '.$port.' -i '.$this->config->item('sshPrivateKeyPath').' echo connected';
        if(system($query) == "connected")
            return TRUE;
        else
            return FALSE;
    }

    public function checkConnection()
    {
        $server = array(
            'username' => $this->input->post('username'),
            'hostname' => $this->input->post('hostname'),
            'port' => $this->input->post('port')
        );
        if($this->checkRemoteConnection($server['username'], $server['hostname'], $server['port']))
        {
            echo '<div class="badge badge-success">Connected</div>';
        }
        else
            echo '<div class="badge badge-danger">Failed</div>';
    }
}

/* End of file Server.php */
