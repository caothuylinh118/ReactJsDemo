<?php
class History extends CI_Controller{
  protected $_flash_mess = "flash_mess";
  protected $_flash_post = "_flash_post";
  public function __construct(){
    parent::__construct();
    $this->load->helper("url");
  }

  public function index(){
    $this->load->model("Mtestresult");
    $this->load->model("Musertest");

    $this->_data['title'] = 'Result';
    $this->_data['id_page'] = "l_result";

    // -----------------------
    // Get Langugage Input - Change Language
    $lang =  $this->input->get('lang');
    if ($lang == null || $lang == "") {
      $lang = $this->session->userdata('current_lang');
      if ($lang == "")
        $lang = "fr";
    }
    changeLanguage($lang);
    $this->lang->load('menu',$lang);

    // Always init tests
    $tests = $this->Musertest->getListTestByLang($lang);
    $this->_data['tests'] = $tests;
    // -----------------------
    // UserLogin
    $user = $this->session->userdata('user');
    $this->_data['user'] = $user;
    if (!isset($user)) {
      // Have to Login for doing Test
      $this->session->set_flashdata($this->_flash_mess, "Please login to view the result!");
      redirect('login');
    }

    $results = $this->Mtestresult->getResultByUserId($user['id'],$lang);

    // print("<pre>".print_r($results,true)."</pre>");

    $this->_data['results'] = $results;
    $this->load->view('/user/history.php', $this->_data);
  }

  private function initResultList ($answers, $resultDtb) {
    $points = $answers['point'];

    $resultArray = $resultDtb;
    for ($i = 0; $i < sizeof($resultDtb); $i++) {
      $colorDtb = $resultDtb[$i]['color'];
      $point = 0;
      if (isset($points[$colorDtb]))
        $point = $points[$colorDtb];
      $resultArray [$i]['point'] = $point;
    }

    return $resultArray;
  }


}
?>
