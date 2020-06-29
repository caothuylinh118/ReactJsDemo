
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Muser extends CI_Model{
    function __construct() {
		$this->tableName = 'user';
		$this->tableBookRoom = 'user_book';
        $this->primaryKey = 'id';
    }

    public function insertUser ($userData = array()) {
        if(!empty($userData)){
            //insert user data
            $userData['created_date']  = date("Y-m-d H:i:s");
            $userData['updated_date'] = date("Y-m-d H:i:s");
            $insert = $this->db->insert($this->tableName,$userData);

            //get user ID
            // $userID = $this->db->insert_id();
        }

        //return user ID
        return $userData?$userData:FALSE;
    }

    public function getListUsers(){
        $this->db->select('*');
        return $this->db->get($this->tableName)->result_array();
    }

	public function login ($user_email, $password) {
		$this->db->select('*');
		$this->db->where('user_email',$user_email);
		$this->db->where('password',$password);
		return $this->db->get($this->tableName)->result_array();
	}

    public function updateUserAtId ($id, $data) {
        $this->db->where("id", $id);
        if($this->db->update($this->_table, $data)){
            return true;
        }else{
            return false;
        };
	}
	
	public function getListBook($user_email){
		$this->db->select('*');
		$this->db->join('room', 'room.room_id = user_book.room_id', 'inner');
		$this->db->join('hotel', 'hotel.hotel_id = room.hotel_id', 'inner');
		$this->db->where('user_email',$user_email);
        return $this->db->get($this->tableBookRoom)->result_array();
    }


}
