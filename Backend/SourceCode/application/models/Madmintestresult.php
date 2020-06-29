<?php
class Madmintestresult extends CI_Model{
    protected $_table = 'result';
    public function __construct(){
        parent::__construct();
    }

    public function getListResults($lang, $page, $limit){
      // $sql = "select result.*, t.title, u.first_name from result join tests as t limit 10 offset ".$page;
      $this->db->select('result.*, t.title, u.first_name, t.type');
      $this->db->where('t.lang',$lang);
      $this->db->join('tests t', 't.item_id = result.test_id');
      $this->db->join('users u', 'u.id = result.user_id');
      $this->db->limit($limit, ($page - 1)*$limit);
      $this->db->order_by("result.id", "desc");
      return $this->db->get($this->_table)->result_array();
      // echo $this->db->last_query();
    }

    public function getAllListResults($lang){
      // $sql = "select result.*, t.title, u.first_name from result join tests as t limit 10 offset ".$page;
      // $this->db->select('*');
      // return $this->db->get($this->_table)->result_array();
      $this->db->select('result.*, t.title, u.first_name, t.type');
      $this->db->where('t.lang',$lang);
      $this->db->join('tests t', 't.item_id = result.test_id');
      $this->db->join('users u', 'u.id = result.user_id');
      $this->db->order_by("result.id", "desc");
      return $this->db->get($this->_table)->result_array();
      // echo $this->db->last_query();
    }

    // public function getListFromIndex ($page) {
    //   $sql = "select * from Career limit 4 offset ".$page;
    //   $query = $this->db->query($sql);
    //   // print("<pre>".print_r($query,true)."</pre>");
    //   return $query->result_array();
    // }

    public function getListResultsFromUser($id, $lang){
      $this->db->select('result.*, t.title, t.type');
      $this->db->where('result.user_id',$id);
      $this->db->where('t.lang',$lang);
      $this->db->join('tests t', 't.item_id = result.test_id');

      return $this->db->get($this->_table)->result_array();
      // echo $this->db->last_query();
    }

    public function getListResultsFromId($id, $lang){
      $this->db->select('result.*, t.title, u.first_name,, u.last_name');
      $this->db->where('result.id',$id);
      $this->db->where('t.lang',$lang);
      $this->db->join('tests t', 't.item_id = result.test_id');
      $this->db->join('users u', 'u.id = result.user_id');
      return $this->db->get($this->_table)->result_array();
      // echo $this->db->last_query();
    }

    public function getResultFrom($id){
      $this->db->where('id',$id);
      $this->db->select('*');
      return $this->db->get($this->_table)->result_array();
    }

    public function getListColors(){
      $this->db->where('lang','en');
      $this->db->select('color');
      return $this->db->get($this->_table)->result_array();
    }

    public function getListResultsNameColor(){
      $this->db->where('lang','en');
      $this->db->select('color, name');
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
