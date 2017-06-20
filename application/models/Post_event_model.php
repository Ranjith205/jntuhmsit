<?php

class Post_event_model extends CI_Model{
    function __construct() {
        parent::__construct();
    }
    
    function get_post_event(){
        return $eventList = $this->db->query('select * from bulletin')->result_array();
    }
    
    function save_event($event){
        
        $title = $event['title'];
        $gcm_ids_res = $this->db->query("select gcm_id from user where gcm_id != ''")->result_array();
        $gcm_ids = array();
        foreach($gcm_ids_res as $g){
        $gcm_ids[] = $g['gcm_id'];
        }
        
        //$gcm_ids[]= 'APA91bGITsJLRYgx6-YF83fseGJM_IdAgrmxXdsrm6SzwcQLGYIArcFbMPwleUxWbtH_v4n6BaE9GWzICgKla6VEjOktNJtHaW4K9TjyFrK8dMm8qsSQTUkxOR2tMneFLxuaZW8H1iM7';
        $this->send_push_notification(API_KEY,$gcm_ids,$title,"New Event Posted");
        return $this->db->insert("bulletin",$event);
    }
    
    function delete_event_record($bid){
        return $this->db->query("delete from bulletin where bid = $bid");
    }
    
    function get_event_details($bid){
        return $this->db->query("select * from bulletin where bid = $bid")->row();
        
    }
    
    function update_event($event){
        $this->db->set('title', $event['title']);
        $this->db->set('description', $event['description']);
        $this->db->set('event_date', $event['event_date']);
        $this->db->where('bid', $event['bid']);
        $this->db->update('bulletin');
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
     curl_close($ch);
     return;
    }
}