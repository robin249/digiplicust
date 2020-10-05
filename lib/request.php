<?php
function GUID()
{
  if (function_exists('com_create_guid') === true)
    return trim(com_create_guid(), '{}');

  return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
}

function uniq_alphanum()
{
  $number = rand(100,1000000);
  $t=time();
  $random = $number.''.$t;
  return md5(uniqid($random, true));
}

function base64_to_jpeg($base64_string, $imageName, $domain) {
  $imageData = base64_decode($base64_string);
  $source = imagecreatefromstring($imageData);
  $imageSave = imagejpeg($source,$imageName,100);
  imagedestroy($source);
  return $domain . $imageName;
}

function httpGet($url, $headers=false)
{
  $ch = curl_init();  
  curl_setopt($ch,CURLOPT_URL,$url);
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
  curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
  curl_setopt($ch,CURLOPT_HEADER, false);

  $result=curl_exec($ch);

  curl_close($ch);
  return $result;
}

function httpPost($url, $params, $headers=false)
{
  $postData = '';
  //create name value pairs seperated by &
  foreach($params as $k => $v) 
  { 
    $postData .= $k . '='.$v.'&'; 
  }
  $postData = rtrim($postData, '&');

  $ch = curl_init();  

  curl_setopt($ch, CURLOPT_URL,$url);
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
  curl_setopt($ch, CURLOPT_HEADER, false); 
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);    

  $output=curl_exec($ch);
  $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

  curl_close($ch);
  if ($http_status==200) {
      $obj = json_decode($output);
      return $obj->{'access_token'};
  }
  else
      return false; 
}

function httpPutRaw($url, $params, $headers=false)
{ 
    $ch = curl_init(); 
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch, CURLOPT_HEADER, false); 
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $params);

    $output=curl_exec($ch);
    $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    // return $output;
    return $http_status;
}

?>