<?php
class Madminquestion extends CI_Model{
    protected $_table = 'questions';
    public function __construct(){
        parent::__construct();
    }

    public function getListQuestions(){
      $this->db->select('*');
      return $this->db->get($this->_table)->result_array();
    }

    public function getQuestionAtId($id){
      $this->db->where('id',$id);
      $this->db->select('*');
      return $this->db->get($this->_table)->result_array();
    }

    public function getQuestionsAtTestId($id){
      $this->db->where('test_id',$id);
      $this->db->select('*');
      return $this->db->get($this->_table)->result_array();
    }

    public function getListQuestionsOfType($type){
      $this->db->where('type',$type);
      $this->db->select('*');
      return $this->db->get($this->_table)->result_array();
    }

    public function insertNewQuestion($data_insert){
      $this->db->insert($this->_table,$data_insert);
    }

    public function insertListQuestions ($data_insert){
      $this->db->insert_batch($this->_table,$data_insert);
    }

    function removeQuestionsAtTestId($id)
    {
       $this->db->where('test_id', $id);
       $this->db->delete($this->_table);
    }

}
?>
