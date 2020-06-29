<?php
class User extends MY_Controller{

    public function __construct(){
		header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        header("Access-Control-Allow-Headers: *");
        parent::__construct();
        $this->load->helper("url");
    }

    //http://localhost/taypvs_react_tour/users/create
    public function create(){
      header('Access-Control-Allow-Origin: *');
          header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
          header("Access-Control-Allow-Headers: *");
        $this->load->model("Muser");
        $data = $this->input->post();

        $data_insert = array(
			"user_id" => isset($data['user_id']) ? $data['user_id'] : "" ,
			"user_name" => $data['user_name'],
			"password" => $data['password'],
			"user_email" => $data['user_email']
          );

          // print("<pre>".print_r($data_insert,true)."</pre>");

        $user = $this->Muser->insertUser($data_insert);

        if ($user) {
            $resutl["result_code"] = "success";
            $resutl["data"] = $user;
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

    public function login() {
		$this->load->model("Muser");
        $data = $this->input->post();

		$email = isset($data['email']) ? $data['email'] : "";
		$password = isset($data['password']) ? $data['password'] : "";
		$user = $this->Muser->login($email, $password);

		if (count($user) > 0) {
			$resutl["result_code"] = "success";
			$resutl["user"] = $user[0];
		} else {
			$resutl["result_code"] = "failed";
		}

        echo json_encode($resutl)."\n";
    }


    public function update() {
        $this->load->model("Muser");

        $data_post = $this->input->post();

        $currentDate = date('Y-m-d');

        $data_insert = array(
        "title" => $data_post['user_name'],
        "user_job" => isset($data['user_job']) ? $data['user_job'] : '',
        "user_avatar" => isset($data['user_avatar']) ? $data['user_avatar'] : ''
        );

        $this->Madminservices->updateServiceAtId($data_post['id'], $data_insert);
	}
	
	public function getListBook () {
		$this->load->model("Muser");
		
		$data = $this->input->get();
		$user_email = $data['user_email'];
		$books = $this->Muser->getListBook ($user_email);

		$resutl["result_code"] = "success";
		$resutl["data"] = $books;
        echo json_encode($resutl)."\n";
	}
}
?>
