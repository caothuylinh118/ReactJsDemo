<?php
class Madminteam extends CI_Model{
    protected $_table = 'Team';
    public function __construct(){
        parent::__construct();
    }

    public function getlistMember(){
      $this->db->select('*');
      return $this->db->get($this->_table)->result_array();
    }

    public function getMemberAtId($id){
      $this->db->where('id',$id);
      $this->db->select('*');
      return $this->db->get($this->_table)->result_array();
    }

    public function insertNewMember($data_insert){
      $this->db->insert($this->_table,$data_insert);
    }

    public function selectMaxIdMember(){
      $this->db->select_max('id');
      return $this->db->get($this->_table)->result_array();
    }

    public function updateMemberInfo($id,$data_update){
      $this->db->where('id',$id);
      $this->db->update($this->_table,$data_update);
    }

    public function removeMemberAtId($id){
      $this->db->where('id',$id);
      $this->db->delete($this->_table);
    }

}
?>
