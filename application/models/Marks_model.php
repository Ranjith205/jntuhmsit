<?php
if (!defined('BASEPATH'))
exit('No direct script access allowed');

class Marks_model extends CI_Model {
    
    function get_student_marks_list(){
        return $this->db->query('select u.full_name,c.course_name,u.uid,c.cid,m.marks_id,m.percentage,m.started_date,m.ended_date,m.remarks '
                . 'from marks as m '
                . 'join user as u on u.uid = m.uid '
                . 'join course as c on c.cid = m.cid '
                . 'group by m.marks_id ')->result_array();
    }
    
    function save_marks($marks){
//        $title = $event['title'];
        $gcm_ids_res = $this->db->query("select gcm_id from user where gcm_id != ''")->result_array();
        $gcm_ids = array();
        foreach($gcm_ids_res as $g){
        $gcm_ids[] = $g['gcm_id'];
        }
        
        //$gcm_ids[]= 'APA91bGITsJLRYgx6-YF83fseGJM_IdAgrmxXdsrm6SzwcQLGYIArcFbMPwleUxWbtH_v4n6BaE9GWzICgKla6VEjOktNJtHaW4K9TjyFrK8dMm8qsSQTUkxOR2tMneFLxuaZW8H1iM7';
        $this->send_push_notification(API_KEY,$gcm_ids,"Marks Uploaded","Marks Uploaded");
       $result = $this->db->insert("marks",$marks);
       return $result;
    }
    
    
    function duplicate_check_marks($sid,$cid,$percentage){
        return $this->db->query("select * from marks where uid = $sid and cid = '$cid' and percentage = $percentage")->num_rows();
    }
    
    function delete_student_marks($marks_id){
        return $this->db->query("delete from marks where marks_id = $marks_id");
    }
    
    function get_student_marks_details($marks_id){
        return $this->db->query("Select u.full_name,c.course_name,u.uid,c.cid,m.percentage,m.marks_id,m.started_date,m.ended_date "
                . "from marks as m "
                . "join user as u on u.uid = m.uid "
                . "join course as c on c.cid = m.cid "
                . "where m.marks_id = $marks_id ")->row();
    }
    
    function update_student_model($marks){
        $this->db->set('percentage', $marks['percentage']);
        $this->db->set('ended_date', $marks['ended_date']);
          $this->db->set('started_date', $marks['started_date']);
            $this->db->where('marks_id', $marks['marks_id']);
        $this->db->update('marks');
        if ($this->db->affected_rows() > 0)
            return true;
        else
            return false;
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