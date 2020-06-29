<?php
class Tests extends CI_Controller{
  protected $_flash_mess = "flash_mess";
  protected $_flash_post = "_flash_post";
  public function __construct(){
    parent::__construct();
    $this->load->helper("url");
  }

  public function index(){
    $this->load->model("Muserquestion");
    $this->load->model("Museranswer");
    $this->load->model("Musertest");

    $this->_data['title'] = 'Tests';

    // -----------------------
    // Get Langugage Input - Change Language
    $lang =  $this->input->get('lang');
    if ($lang == null || $lang == "") {
      $lang = $this->session->userdata('current_lang');
      if ($lang == "")
        $lang = "fr";
    }

    $this->lang->load('test',$lang);
    $this->lang->load('menu',$lang);
    changeLanguage($lang);

    // Always init tests
    $tests = $this->Musertest->getListTestByLang($lang);
    $this->_data['tests'] = $tests;
    // -----------------------
    // UserLogin
    $user = $this->session->userdata('user');
    $this->_data['user'] = $user;
    if (!isset($user)) {
      // Have to Login for doing Test
      $this->session->set_flashdata($this->_flash_mess, $this->lang->line('please_login'));
      redirect('login');
    }

    $testIdCipher =  $this->input->get('test_id');
    $type_id =  $this->input->get('type_id');

    $testId = 0;
    if ($testIdCipher!=null) {
      $testId = decrypted($testIdCipher);
    }

    // Get Data From Last Saved
    $currentQuestionIndex = 0;
    $answer = $this->session->userdata('answers_'.$testId);
    if ($answer == null || $answer == "") {
      $answer = array ();
      $answer['test'] = $testId;
      $answer['type_id'] = $type_id;
      $answer['current_question_index'] = $currentQuestionIndex;
    } else {
      $currentQuestionIndex = $answer['current_question_index'];
    }

    $questions = $this->Muserquestion->getListQuestionsByTestid($testId, $lang);
    $answer['length'] = sizeof($questions);
    $this->session->set_userdata('answers_'.$testId, $answer);

    $questionsInit = $this->initQuestionsList($questions, $lang);

    $this->session->set_userdata('questions', $questionsInit);

    $this->_data['questions'] = $questionsInit;
    $this->_data['q_index'] = $currentQuestionIndex;
    $this->_data['testId'] = $testId;
    $this->_data['id_page'] = "l_question";
    $this->_data['type_id'] = $type_id;
    $this->load->view('/user/tests.php', $this->_data);
  }

  private function initQuestionsList ($questions, $lang) {
    $counter = 0;
    $index = 0;
    $questionArray = array ();
    for ($i = 0; $i < sizeof($questions); $i++) {
      $questionsId = $questions[$i]['item_id'];
      $questionArray[$i]['title'] = $questions[$i]['title'];
      $questionArray[$i]['id'] = $questionsId;
      $questionArray[$i]['item_id'] = $questions[$i]['item_id'];
      $questionArray[$i]['test_id'] = $questions[$i]['test_id'];

      $answers = $this->Museranswer->getAnswerAtQuestionId($questionsId, $lang);

      $questionArray[$i]['answers'] = $answers;
    }

    return $questionArray;
  }

  public function doTest () {
    $this->load->model("Mtestresult");
    $this->load->model("Muserresult");
    $this->load->model("Muserresultdetail");

    // Get Data from Ajax
    $point = $this->input->post('point');
    $color = $this->input->post('type');
    $testId = $this->input->post('test_id');
    $question_id = $this->input->post('question_id');
    $answer_id = $this->input->post('answer_id');

    $answer = $this->session->userdata('answers_'.$testId);

    $curretnPoint = 0;
    if (isset($answer['point']))
      if (isset($answer['point'][$color]))
        $curretnPoint = $answer['point'][$color];
    $curretnPoint = $curretnPoint + $point;

    $answer['point'][$color] = $curretnPoint;
    $answer['questions'][$question_id] = $point;
    $answer['answers'][$question_id.'_answer'] = $answer_id;
    // Up to next questions;
    $currentQuestionIndex = $answer['current_question_index'];
    $currentQuestionIndex++;

    if ($currentQuestionIndex == $answer['length']) {
      $this->session->set_userdata('answers_result_'.$testId, $answer);
      $this->session->unset_userdata('answers_'.$testId);

      $this->insertTestResult($answer, $testId, $answer['type_id']);
      $cipherID = encrypted ($testId);

      $data = array(
              'result'      => "finish",
              'type_id' => $answer['type_id'],
              'id' =>  $cipherID
              );
      echo json_encode($data);
    } else {
      $answer['current_question_index'] = $currentQuestionIndex;
      $this->session->set_userdata('answers_'.$testId, $answer);

      $data = array(
              'result'      => "success"
              );
      echo json_encode($data);
    }

  }

  private function insertTestResult ($answers, $testId, $type_id) {
    $points = $answers['point'];
    $questions = $answers['questions'];
    $answerArray = $answers['answers'];
    $results = $this->Muserresult->getResultByLang('en', $type_id);

    $points_insert = array ();
    for ($i = 0; $i < sizeof($results); $i++) {
      $colorDtb = $results[$i]['color'];
      $point = 0;
      if (isset($points[$colorDtb]))
        $point = $points[$colorDtb];

      $points_insert [$i] = $point;
    }

    $currentDate = date('Y-m-d');
    $user = $this->session->userdata('user');
    $data_insert = array(
      "user_id" => $user['id'],
      "user_email" => $user['email'],
      "test_id" => $testId,
      "point_1" => $points_insert[0],
      "point_2" => $points_insert[1],
      "point_3" => $points_insert[2],
      "point_4" => $points_insert[3],
      "point_5" => $points_insert[4],
      "point_6" => $points_insert[5],
      "updated_date" => $currentDate
    );

    $results = $this->Mtestresult->insertResult($data_insert);

    $lastInsertId = $this->getLastIdFromResult($user['id']);

    $result_detail = array ();
    foreach ($questions as $key => $item) {
      $answerID = $answerArray[$key.'_answer'];
      $data_insert_result = array(
        "test_id" => $testId,
        "question_id" => $key,
        "result_id" => $lastInsertId,
        "point" => $item,
        "user_id" => $user['id'],
        "answer_id" => $answerID,
        "updated_date" => $currentDate
      );
      array_push ($result_detail, $data_insert_result);
    }

    $this->Muserresultdetail->insertListResult($result_detail);
  }

  private function getLastIdFromResult ($userId) {
    // $this->load->model("Mtestresult");
    $maxId = $this->Mtestresult->getLastId($userId);
    return $maxId[0]['id'];
  }

}
?>
