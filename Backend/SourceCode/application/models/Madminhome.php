<?php
class Madminhome extends CI_Model{
    protected $_table = 'Home';
    public function __construct(){
        parent::__construct();
    }

    public function getHomeUrl(){
      $this->db->select('*');
      return $this->db->get($this->_table)->result_array();
    }

    public function updateHome($data) {
      $this->db->where("id", 1);
      if($this->db->update($this->_table, $data)){
          return true;
      }else{
          return false;
      };
    }

}
?>
