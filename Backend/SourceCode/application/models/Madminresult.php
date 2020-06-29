<?php
class Madminresult extends CI_Model{
    protected $_table = 'personals';
    protected $_table_character = 'characteristic';
    public function __construct(){
        parent::__construct();
    }

    public function getListPersonals(){
      $this->db->select('*');
      return $this->db->get($this->_table)->result_array();
    }

    public function getListPersonalsWithLang($lang, $type_id){
      $this->db->where('lang',$lang);
      $this->db->where('type',$type_id);
      $this->db->select('*');
      return $this->db->get($this->_table)->result_array();
    }

    public function getListCharacterWithLang($lang){
      $this->db->where('lang',$lang);
      $this->db->select('*');
      return $this->db->get($this->_table_character)->result_array();
    }

    public function getPersonalsAtId($id){
      $this->db->where('item_id',$id);
      $this->db->select('*');
      return $this->db->get($this->_table)->result_array();
    }

    public function getListColors(){
      $this->db->where('lang','en');
      $this->db->select('color');
      return $this->db->get($this->_table)->result_array();
    }

    public function getMaxItemId(){
      $this->db->select_max('item_id');
      return $this->db->get($this->_table)->result_array();
    }

    public function getListResultsNameColor($type_id){
      $this->db->where('lang','en');
      $this->db->select('color, name');
      $this->db->where('type',$type_id);
      return $this->db->get($this->_table)->result_array();
    }

    public function insertNewPersonal($data_insert){
      $this->db->insert($this->_table,$data_insert);
    }

    public function insertListPersonals ($data_insert){
      $this->db->insert_batch($this->_table,$data_insert);
    }

    public function updatePersonalInfo($id,$data_update, $lang){
      $this->db->where('item_id',$id);
      $this->db->where('lang',$lang);
      $this->db->update($this->_table,$data_update);
    }

    public function updateCharacterAtPersonal($item_id, $data_update){
      $this->db->where('item_id',$item_id);
      $this->db->update($this->_table,$data_update);
    }

    function removeTestAtId($id)
    {
       $this->db->where('item_id', $id);
       $this->db->delete($this->_table);
    }

}
?>
