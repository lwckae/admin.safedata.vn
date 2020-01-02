<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Web_model extends CI_Model {
    public function getTitle($url)
    {
        $str = file_get_contents($url);
        if(strlen($str)>0){
            $str = trim(preg_replace('/\s+/', ' ', $str)); // supports line breaks inside <title>
            preg_match("/\<title\>(.*)\<\/title\>/i",$str,$title); // ignore case
            return $title[1];
        }
    }

    public function getDomainName($url)
    {
        $string = explode('/', $url);
            if(count($string) == 1)
              $domain = $string[0];
            elseif(count($string) == 3)
              $domain = $string[2];
            elseif(count($string) == 4)
              $domain = $string[2];
            else
              $domain = $string[2];
        return explode('.',$domain)[0];
    }

    public function server_map_API($object, $key, $value){
      $curl = curl_init();
      // Set some options - we are passing in a useragent too here
      curl_setopt_array($curl, [
          CURLOPT_RETURNTRANSFER => 1,
          CURLOPT_URL => $this->config->item('server_api').$object,
          CURLOPT_HTTPHEADER => [
            'Authorization: Bearer '.$this->config->item('cms_token'),
          ],
      ]);
      // Send the request & save response to $resp
      $json = json_decode(curl_exec($curl), true);

      # Recover object become array
      $count = count($json);
      $data[$object] = array();
      for ($i=0; $i < $count; $i++)
          $data[$object][$json[$i][$key]] = $json[$i][$value];

      return $data[$object];
    }

    public function server_single_API($object){
        // Get cURL resource
        $curl = curl_init();
        // Set some options - we are passing in a useragent too here
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $this->config->item('server_api').$object,
            CURLOPT_HTTPHEADER => [
              'Authorization: Bearer '.$this->config->item('cms_token'),
            ],
        ]);
        // Send the request & save response to $resp
        $resp = json_decode(curl_exec($curl), true);
        // Close request to clear up some resources
        curl_close($curl);
        return $resp;

    }

    public function server_article_API($id){
      $object = 'articles';
      // Get cURL resource
      $curl = curl_init();
      // Set some options - we are passing in a useragent too here
      curl_setopt_array($curl, [
          CURLOPT_RETURNTRANSFER => 1,
          CURLOPT_URL => $this->config->item('server_api').$object.'/'.$id,
          CURLOPT_HTTPHEADER => [
            'Authorization: Bearer '.$this->config->item('cms_token'),
          ],
      ]);
      // Send the request & save response to $resp
      $resp = json_decode(curl_exec($curl), true);
      // Close request to clear up some resources
      curl_close($curl);
      return $resp;
    }
}

/* End of file Web_model.php */
