<?php
class Course_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function saveCourseModel($course) {
        return $this->db->insert("course", $course);
    }

    function getCourseList() {
        return $studentList = $this->db->query('select * from course')->result_array();
    }

    function duplicate_check_model($sid, $cid, $mid) {
        return $this->db->query("select * from course_enrollment where sid ='$sid' and mid = '$mid' and cid = '$cid'")->num_rows();
    }

    function save_course_enrollment($course_enrollment) {
        return $this->db->insert("course_enrollment", $course_enrollment);
    }

    function get_course_enrollment_list() {
        return $this->db->query('select ce.ce_id,ce.is_enrolled,ce.sid,u.full_name as student_name, ce.mid, u1.full_name as mentor_name, ce.cid, c.course_name '
                        . 'from course_enrollment as ce '
                        . 'join user as u on u.uid = ce.sid '
                        . 'join user as u1 on u1.uid = ce.mid '
                        . 'join course as c on c.cid = ce.cid '
                        . 'group by ce.ce_id order by c.course_name')->result_array();
    }

    function get_course_details($cid) {
        return $this->db->query("select * from course where cid = '$cid'")->row();
    }

    function delete_course_record($cid) {
        return $this->db->query("delete from course where cid = '$cid'");
    }

    function update_course_model($course) {
        $this->db->set('course_name', $course['course_name']);
        $this->db->set('no_of_leaves', $course['no_of_leaves']);
        $this->db->set('from_date', $course['from_date']);
        $this->db->set('to_date', $course['to_date']);
        $this->db->set('credits', $course['credits']);
        $this->db->where('cid', $course['cid']);
        $this->db->update('course');
        if ($this->db->affected_rows() > 0)
            return true;
        else
            return false;
    }

    function inactive_course_record($cid) {
        return $this->db->query("UPDATE `course` SET `is_active`= '0' WHERE cid = '$cid'");
    }

    function active_course_record($cid) {
        return $this->db->query("UPDATE `course` SET `is_active`= '1' WHERE cid = '$cid'");
    }

    function get_course_enrollment_row($ce_id = 0) {
        return $this->db->query('select ce.ce_id, ce.sid,u.full_name as student_name,u1.uid as mentor_id, ce.mid, u1.full_name as mentor_name, ce.cid, c.course_name '
                        . 'from course_enrollment as ce '
                        . 'join user as u on u.uid = ce.sid '
                        . 'join user as u1 on u1.uid = ce.mid '
                        . 'join course as c on c.cid = ce.cid '
                        . 'where ce.ce_id =  ' . $ce_id . ' '
                        . 'group by ce.ce_id order by c.course_name')->row();
    }

    function upload_course_enrollment($ce_id, $mentor_id) {
        return $this->db->query("UPDATE `course_enrollment` SET `mid`= $mentor_id WHERE ce_id = $ce_id");
    }

    function delete_enrollment_course_record($ce_id) {
        return $this->db->query("delete from course_enrollment where ce_id = $ce_id");
    }

    function inactive_course_enrollment($ce_id) {
        return $this->db->query("UPDATE `course_enrollment` SET `is_enrolled`= '1' WHERE ce_id = '$ce_id'");
    }

    function active_course_enrollment($ce_id) {
        return $this->db->query("UPDATE `course_enrollment` SET `is_enrolled`= '0' WHERE ce_id = '$ce_id'");
    }

}
?>