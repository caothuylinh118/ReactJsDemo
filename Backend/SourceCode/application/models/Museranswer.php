<?php
class Museranswer extends CI_Model{
    protected $_table = 'answers';
    public function __construct(){
        parent::__construct();
    }

    public function getListAnswers(){
      $this->db->select('*');
      return $this->db->get($this->_table)->result_array();
    }

    public function getAnswerAtId($id){
      $this->db->where('id',$id);
      $this->db->select('*');
      return $this->db->get($this->_table)->result_array();
    }

    public function getAnswerAtQuestionId($id, $lang){
      $this->db->where('questions',$id);
      $this->db->where('lang',$lang);
      $this->db->select('*');
      return $this->db->get($this->_table)->result_array();
    }

    public function getListAnswersOfType($type){
      $this->db->where('type',$type);
      $this->db->select('*');
      return $this->db->get($this->_table)->result_array();
    }

    public function insertNewAnswer($data_insert){
      $this->db->insert($this->_table,$data_insert);
    }

    public function insertListAnswers ($data_insert){
      $this->db->insert_batch($this->_table,$data_insert);
    }

    function removeAnswersAtTestId($id)
    {
       $this->db->where('test_id', $id);
       $this->db->delete($this->_table);
    }
}
?>
