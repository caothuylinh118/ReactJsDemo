<?php
class Madminpersonaltype extends CI_Model{
    protected $_table = 'personals_type';
    public function __construct(){
        parent::__construct();
    }

    public function getListPersonalType(){
      $this->db->select('*');
      $this->db->group_by('item_id');
      return $this->db->get($this->_table)->result_array();
    }

    public function getListPersonalsWithLang($lang){
      $this->db->where('lang',$lang);
      $this->db->select('*');
      return $this->db->get($this->_table)->result_array();
    }

    public function getPersonalTypeAtId($id){
      $this->db->where('item_id',$id);
      $this->db->select('*');
      return $this->db->get($this->_table)->result_array();
    }

    public function insertNewPersonalType($data_insert){
      $this->db->insert($this->_table,$data_insert);
    }

    public function getMaxItemId(){
      $this->db->select_max('item_id');
      return $this->db->get($this->_table)->result_array();
    }

    public function updatePersonalTypeInfo($id,$data_update, $lang){
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
