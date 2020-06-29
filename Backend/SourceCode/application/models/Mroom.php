
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mroom extends CI_Model{
    function __construct() {
		$this->tableName = 'room';
		$this->tableRoomImages = 'room_images';
		$this->tableBook = 'user_book';
        $this->primaryKey = 'id';
    }
    
    public function getListRoomsWithHotelId($hotel_id){
		$this->db->select('*');
		$this->db->where('hotel_id',$hotel_id);
        return $this->db->get($this->tableName)->result_array();
    }

	public function getListImagesWithRoomId($room_id){
		$this->db->select('url');
		$this->db->where('room_id',$room_id);
        return $this->db->get($this->tableRoomImages)->result_array();
    }

	public function getRoomAtId ($room_id) {
		$this->db->select('*');
		$this->db->where('room_id',$room_id);
        return $this->db->get($this->tableName)->result_array()[0];
	}

	public function inserRoom ($roomData = array()) {
        if(!empty($roomData)){
            //insert user data
            $roomData['created_date']  = date("Y-m-d H:i:s");
            $roomData['updated_date'] = date("Y-m-d H:i:s");
            $insert = $this->db->insert($this->tableName,$roomData);

            //get user ID
            // $userID = $this->db->insert_id();
        }

        //return user ID
        return $roomData?$roomData:FALSE;
	}

	public function inserImage ($roomData = array()) {
        if(!empty($roomData)){
            $insert = $this->db->insert($this->tableRoomImages,$roomData);

        }
        return $roomData?$roomData:FALSE;
	}
	  
}
