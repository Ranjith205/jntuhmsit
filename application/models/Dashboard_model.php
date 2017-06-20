<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }

//    function checkContactModel($phone_no = 0, $user_id = 0) {
//        return $this->db->query("SELECT 1 FROM `users` where phone_no = '$phone_no' and user_id <> $user_id")->num_rows();
//    }
    
    function saveStudentModel($student){
       $result = $this->db->insert("user",$student);
       return $result;
    }
    
    function get_event_list(){
        return $this->db->query("Select * from bulletin")->result_array();
    }
    
    function get_event_count(){
        return $this->db->query("Select * from bulletin")->num_rows();
    }
    
    function get_event_list_for_dashboard(){
        return $this->db->query("Select * from bulletin order by bid desc limit 5")->result_array();
    }
    
    function get_leave_approvel_count(){
        return $this->db->query("select * from apply_leave where status = 1")->num_rows();
    }
    
    function get_student_leaves_exceeded(){
        return $this->db->query("SELECT * FROM `user` WHERE total_leaves_taken > 12.0")->num_rows();
    }
    
    function get_student_failed_count(){
        return $this->db->query('select * from marks where percentage < 70')->num_rows();
    }
}
?>