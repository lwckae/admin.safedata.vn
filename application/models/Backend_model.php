<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Backend_model extends CI_Model {
    public function loginStrapi($email, $password)
    {
        $param = array (
            'identifier' => $email,
            'password' => $password,
        );
        $curl = curl_init();
        // Set some options - we are passing in a useragent too here
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_POST =>  1,
            CURLOPT_POSTFIELDS => $param,
            CURLOPT_URL => $this->config->item('serverAPI').'auth/local',
        ]);
        // Send the request & save response to $resp
        print_r(curl_exec($curl));
        $json = json_decode(curl_exec($curl), true);
        
    }
    

}

/* End of file Backend_model.php */
