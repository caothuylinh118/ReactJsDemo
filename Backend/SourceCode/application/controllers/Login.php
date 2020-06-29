<?php
class Login extends CI_Controller{
  protected $_flash_mess = "flash_mess";
  public function __construct(){
    parent::__construct();
    if($this->session->userdata('name')){
      redirect('dashboard');
    }
    // Load linkedin config
    $this->load->config('linkedin');

    // Load facebook library
    $this->load->library('facebook');
  }

  public function index(){

    $this->load->model("Muserlogin");
    $this->load->model("Musertest");

    $this->_data['title'] = 'Login';
    $this->_data['id_page'] = "";

    // Flash Message
    $this->_data['mess'] = $this->session->flashdata($this->_flash_mess);

    $data_post = $this->input->post();

    // -----------------------
    // Get Langugage Input - Change Language
    $lang =  $this->input->get('lang');
    if ($lang == null || $lang == "") {
      $lang = $this->session->userdata('current_lang');
      if ($lang == "")
        $lang = "fr";
    }

    $this->lang->load('login',$lang);
    $this->lang->load('menu',$lang);
    changeLanguage($lang);

    // Always init tests
    $tests = $this->Musertest->getListTestByLang($lang);
    $this->_data['tests'] = $tests;
    // -----------------------

    if($data_post!=null) {
        // Post data
        $login_id = $this->input->post("email");
        $login_pass = $this->input->post("password");
        $this->checkLogin($login_id, $login_pass, 'psyflex');
    }

    // Social Network
    $this->_data['authURL_FB'] = $this->facebook->login_url();
    $this->_data['authURL_Twitter'] = $this->getTwitterAuth();
    $this->_data['authURL_linkedin'] = base_url().$this->config->item('linkedin_redirect_url').'?oauth_init=1';
    $this->_data['authURL_google'] = $this->getGoogleAuth();

    $this->load->view('user/login.php', $this->_data);
  }

  public function facebook_auth () {
    $this->load->model("Muserlogin");
    $this->load->model("user");
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
            // $data['userData'] = $userData;
            // $this->session->set_userdata('userData',$userData);
            $this->loginAfterAuth ($fbUserProfile['id'], "facebook");
        }else{
          // No data
        }

        // Get logout URL
        // $data['logoutURL'] = $this->facebook->logout_url();
        $data['logoutURL'] = $this->facebook->logout_url();
    }else{
        // Get login URL
        // $data['authURL'] =  $this->facebook->login_url();
    }

    // Load login & profile view
    // $this->load->view('user_authentication/index',$data);
  }

  public function twitter_auth () {
    $this->load->model("Muserlogin");
    $this->load->model("user");
    $userData = array();

    //Include the twitter oauth php libraries
    include_once APPPATH."libraries/twitter-oauth-php-codexworld/twitteroauth.php";

    $twitter = getTwitterKey();

    $consumerKey = $twitter['consumer_key'];
    $consumerSecret = $twitter['consumer_recret'];

    //Get existing token and token secret from session
    $sessToken = $this->session->userdata('token');
    $sessTokenSecret = $this->session->userdata('token_secret');

    if(isset($_REQUEST['oauth_token']) && $sessToken == $_REQUEST['oauth_token']){
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
            $this->loginAfterAuth($userInfo->id, "twitter");
        } else{
            redirect(base_url()."login");
            $data['error_msg'] = 'Some problem occurred, please try again later!';
        }
    }
    else {
      redirect(base_url()."login");
    }

    $data['userData'] = $userData;
  }

  private function getTwitterAuth () {
    //Include the twitter oauth php libraries
    include_once APPPATH."libraries/twitter-oauth-php-codexworld/twitteroauth.php";

    $twitter = getTwitterKey();

    $consumerKey = $twitter['consumer_key'];
    $consumerSecret = $twitter['consumer_recret'];
    $apiKey = $twitter['api_key'];
    $apiSecret = $twitter['api_recret'];

    $connection = new TwitterOAuth($consumerKey, $consumerSecret, $apiKey, $apiSecret);

    // Real
    // $consumerKey = '8o7bboogGGQvZsZOSgONqbICW';
    // $consumerSecret = '6RUh4pwWHJA1QVnYO7mlqZY5KGEHCWSEnF7YJe9WDcywctWiFA';
    // $connection = new TwitterOAuth($consumerKey, $consumerSecret,'770572538459983873-jghJeDul4rrNHnTKGZpBGx3NjBk8vN1', 'KBbTvNdbzKoojFOOn8qJcdPiz6ldzXXfk7a99PJunwNpH');

    $oauthCallback = base_url().'login/twitter_auth';

    //unset token and token secret from session
    $this->session->unset_userdata('token');
    $this->session->unset_userdata('token_secret');

    //Fresh authentication

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
    return $data['oauthURL'];
  }

  public function linkedin_auth () {
    $this->load->model("Muserlogin");
    $this->load->model("user");

    $userData = array();

    //Include the linkedin api php libraries
    include_once APPPATH."libraries/linkedin-oauth-client/http.php";
    include_once APPPATH."libraries/linkedin-oauth-client/oauth_client.php";


    //Get status and user info from session
    $oauthStatus = $this->session->userdata('oauth_status');
    $sessUserData = $this->session->userdata('userData');

    if((isset($_REQUEST["oauth_init"]) && $_REQUEST["oauth_init"] == 1) || (isset($_REQUEST['oauth_token']) && isset($_REQUEST['oauth_verifier']))){
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

            $this->loginAfterAuth($userInfo->id, "linkedin");

        }else{
             $data['error_msg'] = 'Some problem occurred, please try again later!';
        }
    }elseif(isset($_REQUEST["oauth_problem"]) && $_REQUEST["oauth_problem"] <> ""){
        $data['error_msg'] = $_GET["oauth_problem"];
    }

  }

  public function google_auth () {
    $this->load->model("Muserlogin");
    $this->load->model("user");
    // Include two files from google-php-client library in controller
    include_once APPPATH . "libraries/google-api-php-client-master/src/Google/Client.php";
    include_once APPPATH . "libraries/google-api-php-client-master/src/Google/Service/Oauth2.php";

    $google = getGoogleKey();

    $client_id = $google['client_id'];
    $client_secret = $google['client_secret'];
    $redirect_uri = $google['redirect_uri'];
    $simple_api_key = $google['simple_api_key'];

    // Create Client Request to access Google API
    $client = new Google_Client();
    $client->setApplicationName("Psyflex Google OAuth Login Example");
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

      $this->loginAfterAuth($userData->id, "google");
    }
    // Load view and send values stored in $data
  }

  private function getGoogleAuth () {
    // Include two files from google-php-client library in controller
    include_once APPPATH . "libraries/google-api-php-client-master/src/Google/Client.php";
    include_once APPPATH . "libraries/google-api-php-client-master/src/Google/Service/Oauth2.php";

    $google = getGoogleKey();

    $client_id = $google['client_id'];
    $client_secret = $google['client_secret'];
    $redirect_uri = $google['redirect_uri'];
    $simple_api_key = $google['simple_api_key'];

    // Create Client Request to access Google API
    $client = new Google_Client();
    $client->setApplicationName("Psyflex Google OAuth Login Example");
    $client->setClientId($client_id);
    $client->setClientSecret($client_secret);
    $client->setRedirectUri($redirect_uri);
    $client->setDeveloperKey($simple_api_key);
    $client->addScope("https://www.googleapis.com/auth/userinfo.email");

    $authUrl = $client->createAuthUrl();
    return $authUrl;
  }

  private function loginAfterAuth ($id, $authType) {
    $result = $this->Muserlogin->getUserAtAuthID($id);
    $emailAuth = $result[0]['email'];
    $this->checkLogin ($emailAuth, "", $authType);
  }

  private function checkLogin ($id, $password, $authType) {
    $result = $this->Muserlogin->getInfoUser($id, $authType);
    // $result = $this->Muserlogin->getInfoUser($id, 'google');

    // Debug
    // $userInfo = $result[0];
    // $this->session->set_userdata('user', $userInfo);
    // redirect(base_url());

    if ($result == null) {
      $this->session->set_flashdata($this->_flash_mess, $this->lang->line('wrong_email_password'));
      redirect('login');
    } else  {
      $userInfo = $result[0];
      $login_pass_decode = decrypted($userInfo['password']);
      if ($password != $login_pass_decode){
        if ($authType=="psyflex") {
          $this->session->set_flashdata($this->_flash_mess, $this->lang->line('wrong_email_password'));
          redirect('login');
        } else {
          $this->session->set_userdata('user', $userInfo);
          redirect(base_url());
        }
      } else {
        $this->session->set_userdata('user', $userInfo);
        redirect(base_url());
      }
    }
  }


}
 ?>
