<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends Generic_model {
    public $table = "users";
    public $id;
    public $firstname;
    public $lastname;
    public $email;
    public $password;

    function __construct() {
        // Call the Model constructor
        parent::__construct();

    }
}