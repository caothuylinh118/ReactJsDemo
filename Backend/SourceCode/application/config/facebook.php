<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
|  Facebook API Configuration
| -------------------------------------------------------------------
|
| To get an facebook app details you have to create a Facebook app
| at Facebook developers panel (https://developers.facebook.com)
|
|  facebook_app_id               string   Your Facebook App ID.
|  facebook_app_secret           string   Your Facebook App Secret.
|  facebook_login_type           string   Set login type. (web, js, canvas)
|  facebook_login_redirect_url   string   URL to redirect back to after login. (do not include base URL)
|  facebook_logout_redirect_url  string   URL to redirect back to after logout. (do not include base URL)
|  facebook_permissions          array    Your required permissions.
|  facebook_graph_version        string   Specify Facebook Graph version. Eg v2.10
|  facebook_auth_on_load         boolean  Set to TRUE to check for valid access token on every page load.
*/
// Real
// $config['facebook_app_id']              = '1679526832084959';
// $config['facebook_app_secret']          = '4481057ba8c8f3c092a297d3bf9d7c62';

// Demo
$config['facebook_app_id']              = '346601099198491';
$config['facebook_app_secret']          = '768cd70b9e1c7fe47ccd29edf97ed300';

// Local - Setting TayPVS
// $config['facebook_app_id']              = '1679526832084959';
// $config['facebook_app_secret']          = '4481057ba8c8f3c092a297d3bf9d7c62';

$config['facebook_login_type']          = 'web';
$config['facebook_login_redirect_url']  = 'login/facebook_auth';
$config['facebook_logout_redirect_url'] = 'user_authentication/logout';
$config['facebook_permissions']         = array('email');
$config['facebook_graph_version']       = 'v2.10';
$config['facebook_auth_on_load']        = TRUE;
