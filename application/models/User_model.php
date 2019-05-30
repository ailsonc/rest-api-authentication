<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends Generic_model {
    // https://forum.codeigniter.com/thread-61583.html
    function __construct() {
        parent::__construct();

        if(!class_exists("User")) {
            require(APPPATH.'/models/User.php');
        }

        $this->setTable("users");
    }
}