
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mhotel extends CI_Model{
    function __construct() {
		$this->tableName = 'hotel';
		$this->tableImage = 'hotel_images';
        $this->primaryKey = 'id';
    }
	
	public function inserHotel ($hotelData = array()) {
        if(!empty($hotelData)){
            //insert user data
            $hotelData['created_date']  = date("Y-m-d H:i:s");
            $hotelData['updated_date'] = date("Y-m-d H:i:s");
            $insert = $this->db->insert($this->tableName,$hotelData);

            //get user ID
            // $userID = $this->db->insert_id();
        }

        //return user ID
        return $hotelData?$hotelData:FALSE;
	}
	
	public function inserImage ($hotelData = array()) {
        if(!empty($hotelData)){
            //insert user data
            $insert = $this->db->insert($this->tableImage,$hotelData);

        }

        //return user ID
        return $hotelData?$hotelData:FALSE;
	}

    public function getListHotelInCity($city, $isRecommended, $limit){
		$this->db->select('*');
		$this->db->where('city',$city);
		if ($isRecommended) {
			$this->db->where('is_recommended', 1);
		}
		if ($limit != 0) {
			$this->db->limit($limit);
			// limit($value[, $offset = 0])
			//$this->db->limit(10, 20);
		}
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

	public function getListImagesOfHotel ($hotel_id) {
		$this->db->select('url');
		$this->db->where("hotel_id", $hotel_id);
		return $this->db->get($this->tableImage)->result_array();
	}

	public function getHotelAtId ($hotel_id) {
		$this->db->select('*');
		$this->db->where('hotel_id',$hotel_id);
        return $this->db->get($this->tableName)->result_array()[0];
	}

	public function addHotelView ($hotel_id) {
		$hotel = $this->getHotelAtId($hotel_id);
		$current_view = $hotel['viewd'];
		$new_view = $current_view + 1;
		$data_update = array(
			"viewd" => $new_view
		  );
		$this->db->where("hotel_id", $hotel_id);
		if($this->db->update($this->tableName, $data_update)){
            return true;
        }else{
            return false;
        };
	}
	  
}
