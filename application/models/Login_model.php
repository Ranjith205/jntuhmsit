<?php

class Login_model extends CI_Model{
    function __construct() {
        parent::__construct();
    }
    
    
    function get_login_data($username){
        return $this->db->query("select * from user where roll_number = '$username' and user_type in(2,3)")->row();
    }
    
}

