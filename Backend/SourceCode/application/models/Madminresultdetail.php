<?php
class Madminresultdetail extends CI_Model{
    protected $_table = 'result_detail';
    public function __construct(){
        parent::__construct();
    }

    public function getListResultDetail($lang, $resultId){
      // $sql = "select result.*, t.title, u.first_name from result join tests as t limit 10 offset ".$page;
      $this->db->select('result_detail.*, a.title as answer_title, q.title as question_title');
      $this->db->where('a.lang',$lang);
      $this->db->where('q.lang',$lang);
      $this->db->where('result_detail.result_id',$resultId);
      $this->db->join('answers a', 'a.item_id = result_detail.answer_id');
      $this->db->join('questions q', 'q.item_id = result_detail.question_id');
      return $this->db->get($this->_table)->result_array();
    }

}
?>
