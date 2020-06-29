<?php
class Madminmembertag extends CI_Model{
    protected $_table = 'TeamTag';
    public function __construct(){
        parent::__construct();
    }

    public function getlistTag(){
      $this->db->select('*');
      return $this->db->get($this->_table)->result_array();
    }

    public function getTagAtmemberId($id){
      $this->db->where('member_id',$id);
      $this->db->select('*');
      return $this->db->get($this->_table)->result_array();
    }

    public function insertListTagContent ($data_insert){
      $this->db->insert_batch($this->_table,$data_insert);
    }

    function removeTagAtMemberId($id)
    {
       $this->db->where('member_id', $id);
       $this->db->delete($this->_table);
    }
}
?>
