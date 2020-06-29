<?php
class Room extends MY_Controller{

    // http://localhost/taypvs_react_tour/hotels?city=tokyo&from_date=2020-05-14&to_date=2020-05-21
	// http://localhost/taypvs_react_tour/hotels/rooms?hotel_id=sakura_01&from_date=2020-05-14&to_date=2020-05-21

    public function __construct(){
		header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        parent::__construct();
        $this->load->helper("url");
    }

    public function create(){
        $this->load->model("Mroom");
        $data = $this->input->post();

		$unique_id = uniqid();
		$room_id = str_replace(" ", "_", $data['room_name']);
		$room_id = $data['hotel_id']."_".$room_id."_".$unique_id;
        $data_insert = array(
			"room_id" => $room_id,
			"hotel_id" => $data['hotel_id'],
            "room_name" => $data['room_name'],
            "room_price" => $data['room_price'],
            "room_count" => $data['room_count'],
            "room_type" => $data['room_type']
          );
      
        $room = $this->Mroom->inserRoom($data_insert);

        if ($room) {
            $resutl["result_code"] = "success";
            $resutl["data"] = $room;
        } else {
            $resutl["result_code"] = "failed";
            $resutl["data"] = [];
		}
		
        echo json_encode($resutl)."\n";
	}

	public function insertRoomImage(){
        $this->load->model("Mroom");
        $data = $this->input->post();

        $data_insert = array(
			"room_id" => $data['room_id'],
            "url" => $data['url']
          );
      
        $room = $this->Mroom->inserImage($data_insert);

        if ($room) {
            $resutl["result_code"] = "success";
            $resutl["data"] = $room;
        } else {
            $resutl["result_code"] = "failed";
            $resutl["data"] = [];
		}
        echo json_encode($resutl)."\n";
	}
	
	public function getRoomInfo () {
		$this->load->model("Mroom");
		$this->load->model("Mhotel");
		$this->load->model("MUserbook");

		$data = $this->input->get();

		$room_id = strtolower($data['room_id']);
		

		$room = $this->Mroom->getRoomAtId($room_id);
		
		$hotel_id = $room['hotel_id'];
		$hotel = $this->Mhotel->getHotelAtId($hotel_id);
		
		
        $resutl["result_code"] = "success";
		$resutl["data"]['room'] = $room;
		$resutl['data']['hotel'] = $hotel;
        echo json_encode($resutl)."\n";
	}

	public function getListRoomsFromHotelId () {
		$this->load->model("Mroom");
		$this->load->model("Mhotel");
		$this->load->model("MUserbook");
		
		$data = $this->input->get();

		$hotel_id = strtolower($data['hotel_id']);
		$from_date = $data['from_date'];
		$to_date = $data['to_date'];

        $rooms = $this->Mroom->getListRoomsWithHotelId($hotel_id);
		$hotel = $this->Mhotel->getHotelAtId($hotel_id);
		$rooms_return = [];

		$cheapest_price = 999999;
		foreach($rooms as $room){
			$total_room = $room['room_count'];
			$room_booked = $this->MUserbook->getCountUserBooksFromRoomId($room['room_id'], $from_date, $to_date);
			$room_left = $total_room - $room_booked;
			
			$room['room_left'] = $room_left;

			$images = $this->Mroom->getListImagesWithRoomId($room['room_id']);
			$room['images'] = $images;
			array_push($rooms_return, $room);
		}
		
		
        $resutl["result_code"] = "success";
		$resutl["data"] = $rooms_return;
		$resutl['hotel'] = $hotel;
        echo json_encode($resutl)."\n";
	}

	// http://localhost/taypvs_react_tour/book
	public function bookRoom () {
		$this->load->model("MUserbook");
		
		$data = $this->input->post();
		$user_email = strtolower($data['user_email']);
		$room_id = strtolower($data['room_id']);
		$from_date = $data['from_date'];
		$to_date = $data['to_date'];
		$room_book_count = $data['room_count'];

		$unique_id = uniqid();

		$book_id = $unique_id;

		$data_insert = array(
			"room_id" => $room_id,
			"user_email" => $user_email,
            "from_date" => $from_date,
            "to_date" => $to_date,
            "room_book_count" => $room_book_count,
            "book_id" => $book_id
          );
      
        $book = $this->MUserbook->insertBookRoom($data_insert);

        if ($book) {
            $resutl["result_code"] = "success";
            $resutl["data"] = $book;
        } else {
            $resutl["result_code"] = "failed";
            $resutl["data"] = [];
		}
		
        echo json_encode($resutl)."\n";
	}
    
}
?>
