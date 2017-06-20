<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mentor_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function save_mentor($mentor) {
        $result = $this->db->insert("user", $mentor);
        return $result;
    }

    function get_mentor_list() {
        return $this->db->query("select * from user where user_type = 1  and is_deleted = '0'")->result_array();
    }

    function duplicate_check($roll_number) {
        //check duplicate
        return $this->db->query("select * from user where roll_number = '$roll_number'")->num_rows();
    }

    function get_mentor_id($rollnumber) {
        $mentor_id = $this->db->query("select uid from user where roll_number = '$rollnumber'");
        if ($mentor_id->num_rows() > 0) {
            return $mentor_id->row()->uid;
        } else {
            return 0;
        }
    }
    
    function delete_mentor_record($uid){
       return $this->db->query("UPDATE `user` SET `is_deleted`= '1' WHERE uid = $uid");
    }
    
    function get_mentor_details($uid){
        return $this->db->query("select * from user where uid = $uid")->row();
    }
    
    function update_mentor_model($mentor){
        $this->db->set('full_name', $mentor['full_name']);
        $this->db->set('email', $mentor['email']);
        $this->db->set('mobile', $mentor['mobile']);
        $this->db->set('roll_number', $mentor['roll_number']);
        $this->db->set('academic_year', $mentor['academic_year']);
        $this->db->where('uid', $mentor['uid']);
        $this->db->update('user');
        if ($this->db->affected_rows() > 0)
            return true;
        else
            return false;
    }
}

?>