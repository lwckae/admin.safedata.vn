<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Backend_model extends CI_Model {
    public function loginStrapi($email, $password)
    {
        $payload = array(
            'identifier' => $email,
            'password' => $password
        );
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $this->config->item('backendAPI').'auth/local');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_POST, count($payload));
        curl_setopt($curl, CURLOPT_POSTFIELDS, $payload);
        $result = json_decode(curl_exec($curl), TRUE);
        curl_close($curl);
        if(isset($result['jwt']))
        {
            $this->session->set_userdata('account', $result);
            redirect($this->config->item('adminView'));
        }
        elseif(isset($result['statusCode']))
        {
            $this->session->set_flashdata('message', 'Error: '.$result['message'][0]['messages'][0]['message']);
            redirect('');
        }
        else 
            echo 'underfined case';
        exit();
    }
    

}

/* End of file Backend_model.php */
