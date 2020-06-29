<?php
class Mtestresult extends CI_Model{
    protected $_table = 'result';
    public function __construct(){
        parent::__construct();
    }

    public function insertResult($data_insert){
      $this->db->insert($this->_table,$data_insert);
    }


    public function getResultByUserId($userId, $lang){
      $this->db->select('result.*, t.title');
      $this->db->where('t.lang',$lang);
      $this->db->where('result.user_id',$userId);
      $this->db->join('tests t', 't.item_id = result.test_id');
      return $this->db->get($this->_table)->result_array();
    }

    public function getLastId($userId){
      $this->db->select_max('id');
      $this->db->where('user_id',$userId);
      return $this->db->get($this->_table)->result_array();
    }

}
?>
