<?php
class Madminanswer extends CI_Model{
    protected $_table = 'answers';
    public function __construct(){
        parent::__construct();
    }

    public function getListAnswers(){
      $this->db->select('*');
      return $this->db->get($this->_table)->result_array();
    }

    public function getAnswerAtId($id){
      $this->db->where('id',$id);
      $this->db->select('*');
      return $this->db->get($this->_table)->result_array();
    }

    public function getAnswerAtQuestionId($id){
      $this->db->where('questions',$id);
      $this->db->select('*');
      return $this->db->get($this->_table)->result_array();
    }

    public function getListAnswersOfType($type){
      $this->db->where('type',$type);
      $this->db->select('*');
      return $this->db->get($this->_table)->result_array();
    }

    public function updateAnswerColor($old_color, $data_update){
      $this->db->where('color',$old_color);
      $this->db->update($this->_table,$data_update);
    }

    public function updateAnswerColorAtType ($personal_id, $new_color){

      $sql = 'UPDATE answers AS a
              JOIN personals AS p ON p.item_id = a.personal_id
               SET a.color = ? WHERE a.personal_id = ?';
      $this->db->query($sql, array($new_color, $personal_id));

      // $this->db->join('tests as t', 'a.test_id = t.item_id');
      // $this->db->join('personals as p', 'p.type = t.type');
      // $this->db->where('p.item_id',$personal_id);
      // $this->db->where('a.color',$old_color);
      // $this->db->set($data_update);
      // $this->db->update('answers as a');
    }

    public function insertNewAnswer($data_insert){
      $this->db->insert($this->_table,$data_insert);
    }

    public function syncPersonalId ($list_item_id) {
      $list_item_id_str = '';
      $comma = "";
      foreach ($list_item_id as $item_id) {
        $list_item_id_str = $list_item_id_str.$comma."'".$item_id."'";
        $comma = ",";
      }
      $sql = "Update answers AS a
                    JOIN personals AS p ON p.type = a.type
                     SET a.personal_id = p.item_id WHERE (a.color = p.color AND a.type = p.type and a.item_id IN ( ".$list_item_id_str."))";
      $this->db->query($sql);

      // $this->db->where('p.type', 'p.type');
      // $this->db->where('a.color', 'p.color');
      // $this->db->where_in('a.item_id', $list_item_id_str);
      // $this->db->set('a.personal_id', 'p.item_id');
      // $this->db->update('answers as a, personals as p');
    }

    public function insertListAnswers ($data_insert){
      $this->db->insert_batch($this->_table,$data_insert);
    }

    function removeAnswersAtTestId($id)
    {
       $this->db->where('test_id', $id);
       $this->db->delete($this->_table);
    }
}
?>
