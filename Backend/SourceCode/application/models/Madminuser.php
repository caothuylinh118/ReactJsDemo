<?php
class Madminuser extends CI_Model{
    protected $_table = 'users';
    public function __construct(){
        parent::__construct();
    }

    public function getListUsers(){
      $this->db->select('*');
      return $this->db->get($this->_table)->result_array();
    }

    public function getUserAtId($id){
      $this->db->where('id',$id);
      $this->db->select('*');
      return $this->db->get($this->_table)->result_array();
    }

    public function updatePersonalInfo($id,$data_update, $lang){
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
