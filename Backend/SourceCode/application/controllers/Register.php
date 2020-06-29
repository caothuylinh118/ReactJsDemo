<?php
class Register extends CI_Controller{
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
    $this->load->model("Musertest");
    $this->_data['title'] = 'Register';
    $this->_data['id_page'] = "";

    // -----------------------
    // Get Langugage Input - Change Language
    $lang =  $this->input->get('lang');
    if ($lang == null || $lang == "") {
      $lang = $this->session->userdata('current_lang');
      if ($lang == "")
        $lang = "fr";
    }

    $this->lang->load('register',$lang);
    $this->lang->load('menu',$lang);
    changeLanguage($lang);

    // Social Network
    $this->_data['authURL_FB'] = $this->facebook->login_url();
    $this->_data['authURL_Twitter'] = $this->getTwitterAuth();
    $this->_data['authURL_linkedin'] = base_url().$this->config->item('linkedin_redirect_url').'?oauth_init=1';
    $this->_data['authURL_google'] = $this->getGoogleAuth();

    // Always init tests
    $tests = $this->Musertest->getListTestByLang($lang);
    $this->_data['tests'] = $tests;
    // -----------------------

    $this->load->view('user/register.php', $this->_data);
  }

  private function getTwitterAuth () {
    //Include the twitter oauth php libraries
    include_once APPPATH."libraries/twitter-oauth-php-codexworld/twitteroauth.php";

    //Twitter API Configuration
    $twitter = getTwitterKey();

    $consumerKey = $twitter['consumer_key'];
    $consumerSecret = $twitter['consumer_recret'];
    $apiKey = $twitter['api_key'];
    $apiSecret = $twitter['api_recret'];

    $connection = new TwitterOAuth($consumerKey, $consumerSecret, $apiKey, $apiSecret);

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

  public function doRegister () {
    $this->load->model("Muserregister");
    $this->load->model("Muserlogin");
    $data = $this->input->post();
    $dataUser = $this->session->all_userdata();

    $currentDate = date('Y-m-d');
    $login_pass_decode = encrypted($data['password']);
    $email = $data['email'];
    $firstName = $data['first-name'];
    $lastName = $data['last-name'];

    $data_insert = array(
      "oauth_provider" => "psyflex",
      "email" => $email,
      "password" => $login_pass_decode,
      "first_name" => $firstName,
      "last_name" => $lastName,
      "created" => $currentDate
    );

    $this->Muserregister->addNewUser($data_insert);
    $result = $this->Muserlogin->getInfoUser($email, 'psyflex');

    $this->session->set_userdata('user', $result[0]);
    redirect(base_url());
  }


}
 ?>
