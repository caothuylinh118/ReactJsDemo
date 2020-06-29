<?php
class Madminclient extends CI_Model{
    protected $_table = 'Clients';
    public function __construct(){
        parent::__construct();
    }

    public function getListClients(){
      $this->db->select('*');
      return $this->db->get($this->_table)->result_array();
    }

    public function getClientAtId($id){
      $this->db->where('id',$id);
      $this->db->select('*');
      return $this->db->get($this->_table)->result_array();
    }

    public function getClientsAtRow($row){
      $this->db->where('row',$row);
      $this->db->select('*');
      return $this->db->get($this->_table)->result_array();
    }

    public function updateClientAtId ($id, $data) {
      $this->db->where("id", $id);
      if($this->db->update($this->_table, $data)){
          return true;
      }else{
          return false;
      };
    }

    public function insertNewClient($data_insert){
      $this->db->insert($this->_table,$data_insert);
    }

    function removeClientAtId($id)
    {
       $this->db->where('id', $id);
       $this->db->delete($this->_table);
    }

}
?>
