<?php
class Madminservices extends CI_Model{
    protected $_table = 'Services';
    public function __construct(){
        parent::__construct();
    }

    public function getListSerivices(){
      $this->db->select('*');
      return $this->db->get($this->_table)->result_array();
    }

    public function getServiceAtId($id){
      $this->db->where('id',$id);
      $this->db->select('*');
      return $this->db->get($this->_table)->result_array();
    }

    public function getAllServicesAtRow($row){
      $this->db->where('row',$row);
      $this->db->select('*');
      return $this->db->get($this->_table)->result_array();
    }

    public function updateServiceAtId ($id, $data) {
      $this->db->where("id", $id);
      if($this->db->update($this->_table, $data)){
          return true;
      }else{
          return false;
      };
    }

    public function insertNewService($data_insert){
      $this->db->insert($this->_table,$data_insert);
    }

    function removeServiceAtId($id)
    {
       $this->db->where('id', $id);
       $this->db->delete($this->_table);
    }

}
?>
