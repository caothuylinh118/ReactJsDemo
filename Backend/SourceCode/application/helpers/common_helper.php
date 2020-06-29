<?php

// Add Leading Zeros To A Number
function addZeroToNumber($number){
  $number_length = 4;
  $numberResult = substr("0000{$number}", -$number_length);
  return $numberResult;
}

function getLastRegisterId ($list_item) {
  if (count($list_item) > 0){
    $last_item = end ($list_item);
    return $last_item['id'];
  } else {
    return 0;
  }
}

function getLastMonth($date){
  $date = date("Y-m-d");
  $dateTime = new DateTime($date);
  $lastMonth = $dateTime->modify('-' . $dateTime->format('d') . ' days')->format('m');
  return $lastMonth;
}

function formatDate($date){
  $newDate = date("Y-m-d", strtotime($date));
  return $newDate;
}

function remove_format($text){
  $text = str_replace(",", "", $text);
  return $text;
}

function changeLanguage ($lang) {
  $CI =&get_instance();
  $CI->load->library('session');

  $user = $CI->session->set_userdata('current_lang', $lang);

}

function getFacebookKey () {
  $facebook_local = config_item('facebook_local');
  $facebook_demo = config_item('facebook_demo');
  $facebook_real = config_item('facebook_real');
  $environment = config_item('environment');
  if ($environment == 'LOCAL') {
    return $facebook_local;
  } else if ($environment == 'DEMO') {
    return $facebook_demo;
  } else {
    return $facebook_real;
  }
}

function getGoogleKey () {
  $google_local = config_item('google_local');
  $google_demo = config_item('google_demo');
  $google_real = config_item('google_real');
  $environment = config_item('environment');
  if ($environment == 'LOCAL') {
    return $google_local;
  } else if ($environment == 'DEMO') {
    return $google_demo;
  } else {
    return $google_real;
  }
}

function getTwitterKey () {
  $twitter_local = config_item('twitter_local');
  $twitter_demo = config_item('twitter_demo');
  $twitter_real = config_item('twitter_real');
  $environment = config_item('environment');
  if ($environment == 'LOCAL') {
    return $twitter_local;
  } else if ($environment == 'DEMO') {
    return $twitter_demo;
  } else {
    return $twitter_real;
  }
}

function getLinkedinKey () {
  $Linkedin_local = config_item('Linkedin_local');
  $Linkedin_demo = config_item('Linkedin_demo');
  $Linkedin_real = config_item('Linkedin_real');
  $environment = config_item('environment');
  if ($environment == 'LOCAL') {
    return $Linkedin_local;
  } else if ($environment == 'DEMO') {
    return $Linkedin_demo;
  } else {
    return $Linkedin_real;
  }
}
?>
