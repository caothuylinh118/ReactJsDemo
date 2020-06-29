<?php
class Madmintest extends CI_Model{
    protected $_table = 'tests';
    public function __construct(){
        parent::__construct();
    }

    public function getListTests(){
      $this->db->select('*');
      return $this->db->get($this->_table)->result_array();
    }

    public function getListTestsWithLang($lang){
      $this->db->where('lang',$lang);
      $this->db->select('*');
      return $this->db->get($this->_table)->result_array();
    }

    public function getTestsAtId($id){
      $this->db->where('item_id',$id);
      $this->db->select('*');
      return $this->db->get($this->_table)->result_array();
    }

    public function getListTestsOfType($type, $lang){
      $this->db->where('lang',$lang);
      $this->db->where('type',$type);
      $this->db->select('*');
      return $this->db->get($this->_table)->result_array();
    }

    public function insertNewTest($data_insert){
      $this->db->insert($this->_table,$data_insert);
    }

    public function updateTestInfo($id,$data_update, $lang){
      $this->db->where('item_id',$id);
      $this->db->where('lang',$lang);
      $this->db->update($this->_table,$data_update);
    }

    function removeTestAtId($id)
    {
       $this->db->where('item_id', $id);
       $this->db->delete($this->_table);
    }

}
?>
