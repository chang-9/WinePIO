<?php

class Curl {

  public function get($url){

    $ch = curl_init($url);                                                                      
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");                                                                 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                                                                    
    $result = curl_exec($ch);
    return $result;
  }

  public function post($url, $params){

    $post_data = '';
    
    foreach($params as $k => $v){ 
      $post_data .= $k . '='.$v.'&'; 
    }

    rtrim($post_data, '&');

    $ch = curl_init();  

    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_HEADER, false); 
    curl_setopt($ch, CURLOPT_POST, count($post_data));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);    

    $output = curl_exec($ch);

    curl_close($ch);
    return $output;

  }

  public function put($url, $params){

    $post_data = '';
    
    foreach($params as $k => $v){ 
      $post_data .= $k . '='.$v.'&'; 
    }

    rtrim($post_data, '&');

    $ch = curl_init();  
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT"); 
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_HEADER, false); 
    curl_setopt($ch, CURLOPT_POST, count($post_data));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);    

    $output = curl_exec($ch);

    curl_close($ch);
    return $output;

  }


  public function delete($url, $params){

    $post_data = '';
    
    foreach($params as $k => $v){ 
      $post_data .= $k . '='.$v.'&'; 
    }

    rtrim($post_data, '&');

    $ch = curl_init();  
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE"); 
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_HEADER, false); 
    curl_setopt($ch, CURLOPT_POST, count($post_data));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);    

    $output = curl_exec($ch);

    curl_close($ch);
    return $output;

  }

}

$curl = new Curl;

// Get google
echo $curl->get("https://www.google.com");
?>