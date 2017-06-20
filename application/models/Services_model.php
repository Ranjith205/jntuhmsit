<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Services_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_user_data($val, $claus) {
        return $this->db->query("select * from user where " . $claus . " = '$val' ")->row();
    }

    function update_user_login($uid, $guid, $gcm_id) {
        $this->db->query("update user set guid = '" . $guid . "', gcm_id = '" . $gcm_id . "',login_status = 1 where uid = " . $uid);
    }

    function user_data($uid) {
        return $this->db->query("select * from user where uid = '" . $uid . "'")->row();
    }

    function login_status($uid) {
        return $this->db->query("select login_status from users where uid = '" . $uid . "'")->row();
    }

    function change_passowrd($user_id, $password) {
        $this->db->set('password', md5($password));
        $this->db->where('uid', $user_id);
        $this->db->update('user');
        if ($this->db->affected_rows() > 0)
            return true;
        else
            return false;
    }

    function update_user_profile($uid, $app_data) {
        $email_id = '';
        $add2 = '';
        $profile_pic = '';
        extract($app_data);
        return $this->db->query("update user set "
                        . "email = '" . $email . "', "
                        . "full_name = '" . $full_name . "', "
                        . "mobile = '" . $mobile . "', "
                        . "user_img='" . $user_img . "' "
                        . "where uid = " . $uid);
    }

    function forgot_password($uid) {
        return $this->db->query("update users set pwd = md5('msit@2017') where uid = '" . $uid . "'");
    }

    function get_courses_val() {
        return $this->db->query("SELECT * FROM course where is_active = 1")->result_array();
    }

    function get_marks_val($uid, $cid) {
        return $this->db->query("Select percentage,started_date,ended_date from marks where uid = $uid and cid = '$cid'")->row();
    }

    function get_attendance_val($uid) {
        return $this->db->query("select c.cid as cid,c.course_name as course_name,l.leave_type_name as leave_type_name, ae.taken_leave_on as taken_leave_on, ae.aid "
                        . "from attendance as ae "
                        . "join course as c on c.cid = ae.cid "
                        . "join leave_type as l on l.leave_type_id = ae.leave_type_id "
                        . "where ae.uid = $uid "
                        . "group by ae.uid order by ae.taken_leave_on")->result_array();
    }

    function get_all_mentors_details() {
        return $this->db->query("select full_name,email,user_img,mobile from user where user_type = 1 and is_deleted = 1")->result_array();
    }

    function get_events($date) {
        return $this->db->query("SELECT * FROM `bulletin` order by event_date")->result_array();
    }

    function get_students($cid, $uid) {
        return $this->db->query("select  u.uid,u.full_name,u.mobile,u.email,u.parent_name,u.parent_mobile,u.parent_email,u.roll_number,u.user_img "
                        . "from course_enrollment as ce "
                        . "join user as u on u.uid = ce.sid "
                        . "group by u.uid order by u.full_name")->result_array();
    }
    
    function get_all_students(){
        return $this->db->query("SELECT * FROM `user` WHERE user_type = 0 and is_deleted = '0'")->result_array();
    }
    
    function post_event($uid,$title,$desc,$event_date){
        $event = array(
            'title' => $title,
            'description'=> $desc,
            'created_date'=> date('Y-m-d'),
            'event_date' => $event_date,
            'created_by' => $uid
        );
        
        $this->db->insert("bulletin",$event);
        
        $gcm_ids_res = $this->db->query("select gcm_id from user where gcm_id != ''")->result_array();
        $gcm_ids = array();
        foreach($gcm_ids_res as $g){
        $gcm_ids[] = $g['gcm_id'];
        }
        
        //$gcm_ids[]= 'APA91bGITsJLRYgx6-YF83fseGJM_IdAgrmxXdsrm6SzwcQLGYIArcFbMPwleUxWbtH_v4n6BaE9GWzICgKla6VEjOktNJtHaW4K9TjyFrK8dMm8qsSQTUkxOR2tMneFLxuaZW8H1iM7';
        $this->send_push_notification(API_KEY,$gcm_ids,$title,"New Event Posted");
        return true;
    }
    
    function get_student_marks($student_id){
        return $this->db->query("select c.course_name,m.percentage,m.started_date,m.ended_date "
                . "from marks as m join course as c on c.cid = m.cid "
                . "where m.uid = $student_id")->result_array();
    }
    
    function insert_apply_leave($uid, $reason, $from_date, $to_date, $cid, $mid){
        $leave = array(
            'uid' => $uid,
            'created_date' => date('Y-m-d'),
            'status' => 1,
            'reason' => $reason,
            'from_date' => $from_date,
            'to_date' => $to_date,
            'cid' => $cid,
            'assigned_to' => $mid
        );
        return $this->db->insert("apply_leave",$leave);
        
    }
    
    function get_applied_leave($uid){
        return $this->db->query("select * from apply_leave where uid = $uid")->result_array();
    }
    
    function present_course_wise_student_list($cid,$mid){
        //return $this->db->query("select u.mobile,u.email,u.user_img,u.roll_number,u.full_name,u.uid,ce.mid,ce.ce_id from "
          //      . "course_enrollment as ce "
            //    . "join user as u on u.uid = ce.sid "
               // . "where ce.cid = '$cid' and ce.is_enrolled = '0' and ce.mid = $mid")->result_array();
                 $date = date('Y-m-d');
                return $this->db->query("SELECT u.uid,u.full_name,u.total_leaves_taken,u.mobile,u.email,u.user_img,u.roll_number,if(a.attendance_type_id >=0,a.attendance_type_id,3) as attendance_type 
                    FROM `user` as u 
                    join course_enrollment as ce on ce.sid = u.uid 
                    left join attendance as a on a.uid = u.uid and a.cid = ce.cid and taken_leave_on = '$date'
                    where u.user_type = 0 and ce.cid = '$cid' and ce.mid =  $mid
            ORDER BY `user_type`  DESC")->result_array();
    }
    
    function get_course_by_date($date){
        return $this->db->query("SELECT * FROM course WHERE '$date' BETWEEN from_date AND to_date")->row();
    }
    
    function get_mentor_id($uid,$cid){
        return $this->db->query("select mid from course_enrollment where cid = '$cid' and sid = $uid")->row();
    }
    
    function get_student_attendance($uid){
        return $this->db->query("select c.course_name,a.taken_leave_on,a.aid, at.attendance_type_name from "
                . "attendance as a "
                . "join course as c on c.cid = a.cid "
                . "join attendance_type as at on at.attendance_type_id = a.attendance_type_id "
                . "where uid = '$uid'")->result_array();
    }
    
    //need to implement the after the 
    function total_leaves_taken($uid){
        return $this->db->query("select total_leaves_taken from user where uid = $uid")->row();
    }
    
    function get_student_my_team_data($uid,$cid){
        $mentor_id = $this->db->query("select mid from course_enrollment where sid = $uid and cid = '$cid'")->row();
        return $this->db->query("select u.uid,u.full_name,u.roll_number,u.email,u.user_img,u.mobile from "
                . "course_enrollment as ce "
                . "join user as u on u.uid = ce.sid "
                . "where ce.mid = $mentor_id->mid ")->result_array();
    }

    function insert_student_attendance($cid,$date,$uid,$attendance_type_id){
        $data = $this->db->query("select * from attendance where uid = '$uid' and cid = '$cid' and taken_leave_on = '$date'")->num_rows();
        log_message("info",$this->db->last_query());
        if ($data > 0) {
            $this->db->set('attendance_type_id', $attendance_type_id);
            $this->db->where('cid', $cid);
            $this->db->where('taken_leave_on', $date);
            $this->db->where('uid', $uid);
            $res = $this->db->update('attendance');
            
        } else {
            $attendance = array(
              'uid' => $uid,
              'cid' => $cid,
              'taken_leave_on' => $date,
              'attendance_type_id' => $attendance_type_id
            );

           $res = $this->db->insert("attendance", $attendance);
        }
        
        log_message("info",$this->db->last_query());
        return $res;
    }

    function get_student_leaves($uid){
        return $this->db->query("select total_leaves_taken from user where uid =$uid")->row();
    }
    
    function update_leaves_count($no_of_leaves,$uid){
        $this->db->set('total_leaves_taken', $no_of_leaves);
        $this->db->where('uid', $uid);
        $this->db->update('user');
        if ($this->db->affected_rows() > 0)
            return true;
        else
            return false;
    }

    function update_leave_status($uid,$approved_status,$lid){
        $this->db->set('status', $approved_status);
        $this->db->set('approved_by', $uid);
        $this->db->where('lid', $lid);
        $this->db->update('apply_leave');
        if ($this->db->affected_rows() > 0)
            return true;
        else
            return false;
    }

    
    function getLeavesApplied($uid){
        return $this->db->query("select * from apply_leave where assigned_to = $uid and status = '1'")->result_array();
    }
    
    function save_user_image($user_img = '', $uid = 0) {
        $url = '';
        if ($user_img != '' && $uid > 0) {
            $data = "data:image/png;base64,$user_img";
            list($type, $data) = explode(';', $data);
            list(, $data) = explode(',', $data);
            $data = base64_decode($data);
            $url = "assets/users/" . $uid . ".png";
            file_put_contents($url, $data);
            $image = array(
                'user_img' => $url,
            );
            $this->db->where('uid', $uid);
            $this->db->update('user', $image);
        }
        return $url;
    }


//for notification
    function send_push_notification($api_key,$gcm_ids,$message,$title){
     $url = 'https://gcm-http.googleapis.com/gcm/send';
     
     $fields = array(
         'registration_ids' => $gcm_ids,
         'data' => array("message" => $message,
      "title" => $title)
     );
     $data = json_encode($fields);


     $headers = array(
         'Authorization: key=' . $api_key,
         'Content-Type: application/json');

     $ch = curl_init();
     curl_setopt($ch, CURLOPT_URL, $url);
     curl_setopt($ch, CURLOPT_POST, true);
     curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
     curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
     $result = curl_exec($ch);
     /*if ($result === FALSE) {
       die('Curl failed: ' . curl_error($ch));
       } */
     curl_close($ch);
     return;
    }

}