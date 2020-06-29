<?php
class Hotel extends MY_Controller{

    // http://localhost/taypvs_react_tour/hotels?city=tokyo&from_date=2020-05-14&to_date=2020-05-21&limit=10

    public function __construct(){
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        parent::__construct();
        $this->load->helper("url");
    }

    public function create(){
        $this->load->model("Mhotel");
        $data = $this->input->post();

		$unique_id = uniqid();
		$hotel_id = str_replace(" ", "_", $data['hotel_name']);
		$hotel_id = $hotel_id."_".$unique_id;
        $data_insert = array(
			"hotel_id" => $hotel_id,
            "hotel_name" => $data['hotel_name'],
            "hotel_address" => $data['hotel_address'],
            "city" => $data['hotel_city'],
            "hotel_image" => $data['hotel_image']
          );
      
        $hotel = $this->Mhotel->inserHotel($data_insert);

        if ($hotel) {
            $resutl["result_code"] = "success";
            $resutl["data"] = $hotel;
        } else {
            $resutl["result_code"] = "failed";
            $resutl["data"] = [];
		}
		
        echo json_encode($resutl)."\n";
	}
	
	public function insertHotelImage(){
        $this->load->model("Mhotel");
        $data = $this->input->post();

        $data_insert = array(
			"hotel_id" => $data['hotel_id'],
            "url" => $data['url']
          );
      
        $hotel = $this->Mhotel->inserImage($data_insert);

        if ($hotel) {
            $resutl["result_code"] = "success";
            $resutl["data"] = $hotel;
        } else {
            $resutl["result_code"] = "failed";
            $resutl["data"] = [];
		}
        echo json_encode($resutl)."\n";
    }

    public function getAll () {
        $this->load->model("Muser");
        $users = $this->Muser->getlistUsers();

        $resutl["result_code"] = "success";
        $resutl["data"] = $users;
        echo json_encode($resutl)."\n";

    }

	public function getListHotelInCity () {
		$this->load->model("Mhotel");
		$this->load->model("Mroom");
		$this->load->model("MUserbook");

		$data = $this->input->get();

		$city = strtolower($data['city']);
		$from_date = $data['from_date'];
		$to_date = $data['to_date'];
		$limit = isset($data['limit']) ? $data['limit'] : 0;

        $hotels = $this->Mhotel->getListHotelInCity($city, false, $limit);

		$index = 0;
		foreach($hotels as $hotel){
			$rooms = $this->Mroom->getListRoomsWithHotelId($hotel['hotel_id']);
            $room_left = 0;
            $cheapest_price = 999999;
			foreach($rooms as $room){
				$total_room = $room['room_count'];
				$room_booked = $this->MUserbook->getCountUserBooksFromRoomId($room['room_id'], $from_date, $to_date);
                $room_left = $room_left + $total_room - $room_booked;
                
                // Cheapest price
                if ($cheapest_price >= $room['room_price']) {
                    $cheapest_price = $room['room_price'];
                }
			}
            $hotels[$index]['room_left'] = $room_left;
			$hotels[$index]['price_from'] = $cheapest_price;
			
			// Get Images
			$images = $this->Mhotel->getListImagesOfHotel($hotel['hotel_id']);

			$hotels[$index]['images'] = $images;
			
			$index++;
		}

        $resutl["result_code"] = "success";
        $resutl["data"] = $hotels;
        echo json_encode($resutl)."\n";

	}
	

	//http://localhost/taypvs_react_tour/hotels/recommended?city=tokyo&limit=3
	public function getListHotelRecommended () {
		$this->load->model("Mhotel");
		$this->load->model("Mroom");
		$this->load->model("MUserbook");

		$data = $this->input->get();

		$city = strtolower($data['city']);

		$limit = isset($data['limit']) ? $data['limit'] : 0;

        $hotels = $this->Mhotel->getListHotelInCity($city, true, $limit);
		
		$index = 0;
		foreach($hotels as $hotel){
			$rooms = $this->Mroom->getListRoomsWithHotelId($hotel['hotel_id']);
            $cheapest_price = 999999;
			foreach($rooms as $room){
                // Cheapest price
                if ($cheapest_price >= $room['room_price']) {
                    $cheapest_price = $room['room_price'];
                }
			}
			$hotels[$index]['price_from'] = $cheapest_price;
			
			// Get Images
			$images = $this->Mhotel->getListImagesOfHotel($hotel['hotel_id']);

			$hotels[$index]['images'] = $images;
			
			$index++;
		}

        $resutl["result_code"] = "success";
        $resutl["data"] = $hotels;
        echo json_encode($resutl)."\n";

	}

	public function countUserBookWithRoomId () {
		$this->load->model("MUserbook");
		$data = $this->input->get();
		$data['room_id'] = 'sakura_01_room_01';
		$data['from_date'] = '2020-05-14';
		$data['to_date'] = '2020-05-21';
        $books = $this->MUserbook->getCountUserBooksFromRoomId($data['room_id'], $data['from_date'], $data['to_date']);

        $resutl["result_code"] = "success";
        $resutl["data"] = $books;
        echo json_encode($resutl)."\n";
	}

	public function addHotelView () {
		$this->load->model("Mhotel");
		$data = $this->input->get();
		$isViewIncreases = $this->Mhotel->addHotelView($data['hotel_id']);
		return $isViewIncreases;
	}
    
}
?>
