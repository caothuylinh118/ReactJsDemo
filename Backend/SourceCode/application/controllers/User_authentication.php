<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User_Authentication extends CI_Controller
{
    function __construct() {
        parent::__construct();

        // Load linkedin config
        $this->load->config('linkedin');

        // Load facebook library
        $this->load->library('facebook');

        //Load user model
        $this->load->model('user');
    }

    public function index(){
        $userData = array();

        // Check if user is logged in
        if($this->facebook->is_authenticated()){
            // Get user facebook profile details
            $fbUserProfile = $this->facebook->request('get', '/me?fields=id,first_name,last_name,email,link');

            // Preparing data for database insertion
            $userData['oauth_provider'] = 'facebook';
            $userData['oauth_uid'] = $fbUserProfile['id'];
            $userData['first_name'] = $fbUserProfile['first_name'];
            $userData['last_name'] = $fbUserProfile['last_name'];
            $userData['email'] = $fbUserProfile['email'];
            $userData['gender'] = "";
            $userData['locale'] = "";
            $userData['cover'] = "";
            $userData['picture'] = "";
            $userData['link'] = "";

            // Insert or update user data
            $userID = $this->user->checkUser($userData);

            // Check user data insert or update status
            if(!empty($userID)){
                $data['userData'] = $userData;
                $this->session->set_userdata('userData',$userData);
            }else{
               $data['userData'] = array();
            }

            // Get logout URL
            // $data['logoutURL'] = $this->facebook->logout_url();
            $data['logoutURL'] = $this->facebook->logout_url();
        }else{
            // Get login URL
            $data['authURL'] =  $this->facebook->login_url();
        }

        // Load login & profile view
        $this->load->view('user_authentication/index',$data);
    }

    public function twitter () {
      $userData = array();

      //Include the twitter oauth php libraries
      include_once APPPATH."libraries/twitter-oauth-php-codexworld/twitteroauth.php";

      //Twitter API Configuration
      $consumerKey = 'OkxmkjQ4oXiukr467VuDaN1B7';
      $consumerSecret = 'GCFqUIHBvLXctm03XKFVshdqhYERvEtUfbq9NzHHsLSYMxYARR';
      $oauthCallback = base_url().'user_authentication/twitter';

      //Get existing token and token secret from session
      $sessToken = $this->session->userdata('token');
      $sessTokenSecret = $this->session->userdata('token_secret');

      //Get status and user info from session
      $sessStatus = $this->session->userdata('status');
      $sessUserData = $this->session->userdata('userData');

      if(isset($sessStatus) && $sessStatus == 'verified'){
          //Connect and get latest tweets
          $connection = new TwitterOAuth($consumerKey, $consumerSecret, $sessUserData['accessToken']['oauth_token'], $sessUserData['accessToken']['oauth_token_secret']);
          $data['tweets'] = $connection->get('statuses/user_timeline', array('screen_name' => $sessUserData['username'], 'count' => 5));

          //User info from session
          $userData = $sessUserData;
      }elseif(isset($_REQUEST['oauth_token']) && $sessToken == $_REQUEST['oauth_token']){
          //Successful response returns oauth_token, oauth_token_secret, user_id, and screen_name
          $connection = new TwitterOAuth($consumerKey, $consumerSecret, $sessToken, $sessTokenSecret);
          $accessToken = $connection->getAccessToken($_REQUEST['oauth_verifier']);
          if($connection->http_code == '200'){
              //Get user profile info
              $parametersTwitter = array();

              $userInfo = $connection->get('account/verify_credentials');
              print_r($userInfo) ;
              //Preparing data for database insertion
              $name = explode(" ",$userInfo->name);
              $first_name = isset($name[0])?$name[0]:'';
              $last_name = isset($name[1])?$name[1]:'';
              $userData = array(
                  'oauth_provider' => 'twitter',
                  'oauth_uid' => $userInfo->id,
                  'username' => $userInfo->screen_name,
                  'first_name' => $first_name,
                  'last_name' => $last_name,
                  'locale' => $userInfo->lang,
                  'profile_url' => 'https://twitter.com/'.$userInfo->screen_name,
                  'picture_url' => $userInfo->profile_image_url
              );

              //Insert or update user data
              $userID = $this->user->checkUser($userData);

              //Store status and user profile info into session
              $userData['accessToken'] = $accessToken;
              $this->session->set_userdata('status','verified');
              $this->session->set_userdata('userData',$userData);

              //Get latest tweets
              $data['tweets'] = $connection->get('statuses/user_timeline', array('screen_name' => $userInfo->screen_name, 'count' => 5));
          }else{
              $data['error_msg'] = 'Some problem occurred, please try again later!';
          }
      }else{
          //unset token and token secret from session
          $this->session->unset_userdata('token');
          $this->session->unset_userdata('token_secret');

          //Fresh authentication
          $connection = new TwitterOAuth($consumerKey, $consumerSecret,'2477966881-1wO5QyQ89aTD1OReXdsP8fU4ZLSI3k3zB4G1UTK', 'BnpFvO5TOEtp5djJ95A5u2Ytt1KAZ2h4bOW1zuUcJKX2N');
          $requestToken = $connection->getRequestToken($oauthCallback);

          //Received token info from twitter
          $this->session->set_userdata('token',$requestToken['oauth_token']);
          $this->session->set_userdata('token_secret',$requestToken['oauth_token_secret']);

          //Any value other than 200 is failure, so continue only if http code is 200
          if($connection->http_code == '200'){
              //Get twitter oauth url
              $twitterUrl = $connection->getAuthorizeURL($requestToken['oauth_token']);
              $data['oauthURL'] = $twitterUrl;
          }else{
              $data['oauthURL'] = base_url().'user_authentication/twitter';
              $data['error_msg'] = 'Error connecting to twitter! try again later!';
          }
      }

      $data['userData'] = $userData;
      $this->load->view('user_authentication/twitter',$data);
    }

    public function linkedin() {
      $userData = array();

      //Include the linkedin api php libraries
      include_once APPPATH."libraries/linkedin-oauth-client/http.php";
      include_once APPPATH."libraries/linkedin-oauth-client/oauth_client.php";


      //Get status and user info from session
      $oauthStatus = $this->session->userdata('oauth_status');
      $sessUserData = $this->session->userdata('userData');

      if(isset($oauthStatus) && $oauthStatus == 'verified'){
          //User info from session
          $userData = $sessUserData;
      }elseif((isset($_REQUEST["oauth_init"]) && $_REQUEST["oauth_init"] == 1) || (isset($_REQUEST['oauth_token']) && isset($_REQUEST['oauth_verifier']))){
          $client = new oauth_client_class;
          $client->client_id = $this->config->item('linkedin_api_key');
          $client->client_secret = $this->config->item('linkedin_api_secret');
          $client->redirect_uri = base_url().$this->config->item('linkedin_redirect_url');
          $client->scope = $this->config->item('linkedin_scope');
          $client->debug = false;
          $client->debug_http = true;
          $application_line = __LINE__;

          //If authentication returns success
          if($success = $client->Initialize()){
              if(($success = $client->Process())){
                  if(strlen($client->authorization_error)){
                      $client->error = $client->authorization_error;
                      $success = false;
                  }elseif(strlen($client->access_token)){
                      $success = $client->CallAPI('http://api.linkedin.com/v1/people/~:(id,email-address,first-name,last-name,location,picture-url,public-profile-url,formatted-name)',
                      'GET',
                      array('format'=>'json'),
                      array('FailOnAccessError'=>true), $userInfo);
                  }
              }
              $success = $client->Finalize($success);
          }

          if($client->exit) exit;

          if($success){
              //Preparing data for database insertion
              $first_name = !empty($userInfo->firstName)?$userInfo->firstName:'';
              $last_name = !empty($userInfo->lastName)?$userInfo->lastName:'';
              $userData = array(
                  'oauth_provider'=> 'linkedin',
                  'oauth_uid'     => $userInfo->id,
                  'first_name'     => $first_name,
                  'last_name'     => $last_name,
                  'email'         => $userInfo->emailAddress,
                  'locale'         => $userInfo->location->name,
                  'profile_url'     => $userInfo->publicProfileUrl,
                  'picture_url'     => $userInfo->pictureUrl
              );

              //Insert or update user data
              $userID = $this->user->checkUser($userData);

              //Store status and user profile info into session
              $this->session->set_userdata('oauth_status','verified');
              $this->session->set_userdata('userData',$userData);

              //Redirect the user back to the same page
              redirect('/user_authentication/linkedin');

          }else{
               $data['error_msg'] = 'Some problem occurred, please try again later!';
          }
      }elseif(isset($_REQUEST["oauth_problem"]) && $_REQUEST["oauth_problem"] <> ""){
          $data['error_msg'] = $_GET["oauth_problem"];
      }else{
          $data['oauthURL'] = base_url().$this->config->item('linkedin_redirect_url').'?oauth_init=1';
      }

      $data['userData'] = $userData;

      // Load login & profile view
      $this->load->view('user_authentication/linkedin',$data);
    }

    public function google() {
      // Include two files from google-php-client library in controller
      include_once APPPATH . "libraries/google-api-php-client-master/src/Google/Client.php";
      include_once APPPATH . "libraries/google-api-php-client-master/src/Google/Service/Oauth2.php";

      // Store values in variables from project created in Google Developer Console
      $client_id = '885009573118-l1rf1lnked9jpv9o6d9rqd8g81rfuquv.apps.googleusercontent.com';
      $client_secret = 'DoZkp8WsXh1DXxaD-9Pg61Kd';
      $redirect_uri = 'http://localhost/psyflex/user_authentication/google';
      $simple_api_key = 'AIzaSyChrdsTRcYJ3GCzE9s7uFSxV7_RCL6Laeo';

      // Create Client Request to access Google API
      $client = new Google_Client();
      $client->setApplicationName("PHP Google OAuth Login Example");
      $client->setClientId($client_id);
      $client->setClientSecret($client_secret);
      $client->setRedirectUri($redirect_uri);
      $client->setDeveloperKey($simple_api_key);
      $client->addScope("https://www.googleapis.com/auth/userinfo.email");

      // Send Client Request
      $objOAuthService = new Google_Service_Oauth2($client);

      // Add Access Token to Session
      if (isset($_GET['code'])) {
      $client->authenticate($_GET['code']);
      $_SESSION['access_token'] = $client->getAccessToken();
      header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
      }

      // Set Access Token to make Request
      if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
      $client->setAccessToken($_SESSION['access_token']);
      }

      // Get User Data from Google and store them in $data
      if ($client->getAccessToken()) {
        $userData = $objOAuthService->userinfo->get();

        print("<pre>".print_r($userData,true)."</pre>");

        $userLoginData = array(
            'oauth_provider' => 'google',
            'oauth_uid' => $userData->id,
            'username' => $userData->screen_name,
            'first_name' => $userData->given_name,
            'last_name' => $userData->family_name,
            'locale' => '',
            'profile_url' => $userData->picture,
            'email' => $userData->email
        );

        //Insert or update user data
        $userID = $this->user->checkUser($userLoginData);

        //Store status and user profile info into session
        $userLoginData['accessToken'] = $client->getAccessToken();;

        $data['userData'] = $userData;
        $_SESSION['access_token'] = $client->getAccessToken();
      } else {
        $authUrl = $client->createAuthUrl();
        $data['authUrl'] = $authUrl;
      }
      // Load view and send values stored in $data
      $this->load->view('user_authentication/google', $data);
    }

    public function logout() {
        // Remove user data from session
        $this->session->unset_userdata('oauth_status');
        $this->session->unset_userdata('userData');
        // Remove local Facebook session
        $this->facebook->destroy_session();
        // Redirect to login page
        redirect('/user_authentication');
    }
}
