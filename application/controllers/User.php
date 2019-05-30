<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//https://www.codeofaninja.com/2018/09/rest-api-authentication-example-php-jwt-tutorial.html
class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('User');
    }

	public function index() {
        echo 'User';
    }

    public function create() {
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $data = json_decode(file_get_contents("php://input"));
            $data;

            $user = new User();
            $user->firstname = $data->firstname;
            $user->lastname = $data->lastname;
            $user->email = $data->email;
            $user->password = $data->password;

            $inserted_id = $this->user_model->insert($user);

            http_response_code(200);
            echo json_encode(array("message" => "User was created.", "id" => $inserted_id));
        } else {
            http_response_code(400);
            echo json_encode(array("message" => "Unable to create user."));
        }
    }
}