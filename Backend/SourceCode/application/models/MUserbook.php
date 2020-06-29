
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class MUserbook extends CI_Model{
    function __construct() {
		$this->tableName = 'user_book';
		$this->bookTableName = 'hotel';
        $this->primaryKey = 'id';
	}
	//https://www.codeigniter.com/userguide3/database/query_builder.html#query-grouping
	//https://stackoverflow.com/questions/16498693/codeigniters-where-and-or-where
    
    public function getUserBooksFromRoomId($id){
		$this->db->select('*');
		$this->db->where('room_id',$id);
        return $this->db->get($this->tableName)->result_array();
	}
	
	public function getCountUserBooksFromRoomId ($room_id, $from_date, $to_date) {
		// $this->db->select('*, COUNT(*) as count');
		// $this->db->where('room_id',$room_id);
		return $this->db->select_sum('room_book_count')->from($this->tableName)
		->group_start()
			->or_group_start()
					->where('from_date >=',$from_date)
					->where('from_date <=',$to_date)
			->group_end()
			->or_group_start()
					->where('to_date >=',$from_date)
					->where('to_date <=',$to_date)
			->group_end()
			->or_group_start()
					->where('from_date <=',$from_date)
					->where('to_date >=',$to_date)
			->group_end()
		->group_end()
		->where('room_id',$room_id)
		->get()->result_array()[0]['room_book_count'];

	}
	
	/**
	 * 10 room
	 * 1 : 15/2 - 20/2
	 * 2 : 15/2 - 18/2 : 2 nguoi
	 * 3 : 10/2 - 25/2
	 * 4 : 01/2 - 10/2 : 3 nguoi 
	 * 5 : 01/2 - 05/2
	 * 6 : 18/2 - 25/2 : 2 nguoi
	 * 
	 * 
	 * Choose : 14/2 - 21/2 : left 4 Room
	 * Choose : 11/2 - 15/2 : left 7 Room
	 * Choose : 01/2 - 13/2 : left 7 Room
	 */


	public function insertBookRoom ($bookData = array()) {
		if(!empty($bookData)){
            //insert user data
            $bookData['created_date']  = date("Y-m-d H:i:s");
            // $bookData['updated_date'] = date("Y-m-d H:i:s");
            $insert = $this->db->insert($this->tableName,$bookData);
            //get user ID
            // $userID = $this->db->insert_id();
        }

        //return user ID
        return $bookData?$bookData:FALSE;
	}

}
