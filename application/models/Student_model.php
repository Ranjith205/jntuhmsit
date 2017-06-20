<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Student_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    
    function delete_student_record($uid){
       return $this->db->query("UPDATE `user` SET `is_deleted`= '1' WHERE uid = $uid");
    }
    
    function get_student_details($uid){
        return $this->db->query("select * from user where uid = $uid")->row();
    }

    function saveStudentModel($student) {
        $result = $this->db->insert("user", $student);
        return $result;
    }
    
    function update_student_model($student){
        $this->db->set('full_name', $student['full_name']);
        $this->db->set('email', $student['email']);
        $this->db->set('mobile', $student['mobile']);
        $this->db->set('roll_number', $student['roll_number']);
        $this->db->set('academic_year', $student['academic_year']);
        $this->db->set('parent_name', $student['parent_name']);
        $this->db->set('parent_mobile', $student['parent_mobile']);
        $this->db->set('parent_email', $student['parent_email']);
        $this->db->where('uid', $student['uid']);
        $this->db->update('user');
        if ($this->db->affected_rows() > 0)
            return true;
        else
            return false;
    }

    function getStudentList() {
        return $studentList = $this->db->query("select * from user where user_type = 0 and is_deleted = '0'")->result_array();
    }

    function duplicate_check($roll_number) {
        //check duplicate
        return $this->db->query("select * from user where roll_number = '$roll_number'")->num_rows();
    }

    function get_student_id($rollnumber) {
        $student_id = $this->db->query("select uid from user where roll_number = '$rollnumber'");
        if ($student_id->num_rows() > 0) {
            return $student_id->row()->uid;
        } else {
            return 0;
        }
    }
    
    function get_parent_data(){
        return $this->db->query("Select full_name,uid,parent_name,parent_mobile,parent_email from user where user_type = 0")->result_array();
    }
}
?>