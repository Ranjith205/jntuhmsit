<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Clark_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function save_clark($clark) {
        $result = $this->db->insert("user", $clark);
        return $result;
    }

    function get_clark_list() {
        return $this->db->query("select * from user where user_type = 3 and is_deleted = '0'")->result_array();
    }

    function duplicate_check($roll_number) {
        //check duplicate
        return $this->db->query("select * from user where roll_number = '$roll_number'")->num_rows();
    }

    function get_clark_id($rollnumber) {
        $clark_id = $this->db->query("select uid from user where roll_number = '$rollnumber'");
        if ($clark_id->num_rows() > 0) {
            return $clark_id->row()->uid;
        } else {
            return 0;
        }
    }
}
