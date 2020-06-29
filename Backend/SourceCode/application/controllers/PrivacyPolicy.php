<?php
class PrivacyPolicy extends CI_Controller{
  protected $_flash_mess = "flash_mess";
  protected $_flash_post = "_flash_post";
  public function __construct(){
    parent::__construct();
    $this->load->helper("url");
  }

  public function index(){
    $this->load->model("Muserhome");
    $this->load->model("Musertest");

    $this->_data['title'] = 'Home';
    $this->_data['id_page'] = "";

    // Get Langugage Input - Change Language
    $lang =  $this->input->get('lang');
    if ($lang == null || $lang == "") {
      $lang = $this->session->userdata('current_lang');
      if ($lang == "")
        $lang = "fr";
    }

    $this->lang->load('privacy_lang',$lang);
    $this->lang->load('menu',$lang);
    changeLanguage($lang);

    // Always init tests
    $tests = $this->Musertest->getListTestByLang($lang);
    $this->_data['tests'] = $tests;
    // UserLogin
    $user = $this->session->userdata('user');
    $this->_data['user'] = $user;

    $this->_data['content'] = $user;

    $this->load->view('/user/privacy.php', $this->_data);
  }


}
?>
