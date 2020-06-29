<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
|  LinkedIn API Configuration
| -------------------------------------------------------------------
|
| To get an facebook app details you have to create a Facebook app
| at Facebook developers panel (https://developers.facebook.com)
|
|  linkedin_api_key        string   Your LinkedIn App Client ID.
|  linkedin_api_secret     string   Your LinkedIn App Client Secret.
|  linkedin_redirect_url   string   URL to redirect back to after login. (do not include base URL)
|  linkedin_scope          array    Your required permissions.
*/
// Local
// $config['linkedin_api_key']       = '77xv565tp5a675';
// $config['linkedin_api_secret']    = 'C6tpqT3VmTJm9jAd';

// Demo
$config['linkedin_api_key']       = '81hdm6esj4qdjf';
$config['linkedin_api_secret']    = 'mEPRo9ZEwr0AYDGB';

// Real
// $config['linkedin_api_key']       = '';
// $config['linkedin_api_secret']    = '';

$config['linkedin_redirect_url']  = 'login/linkedin_auth';
$config['linkedin_scope']         = 'r_basicprofile r_emailaddress';
