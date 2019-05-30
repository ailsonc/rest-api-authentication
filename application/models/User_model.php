<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {
    private $table_name = "users";
    public $id;
    public $firstname;
    public $lastname;
    public $email;
    public $password;

    
}