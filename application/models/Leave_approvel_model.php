<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Leave_approvel_model extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    function get_pending_leaves_model(){
        return $this->db->query("select u.full_name,u.roll_number,u.total_leaves_taken,a.assigned_to,a.status,a.lid "
                . "from apply_leave as a "
                . "join user as u on u.uid = a.uid "
                . "where a.status = '1'")->result_array();
    }
    
    function approve_leave($lid){
        $data = $this->login_user;
        
        $this->db->set('status', '1');
        $this->db->set('approved_by', $data->uid);
        $this->db->where('lid', $lid);
        $this->db->update('apply_leave');
        if ($this->db->affected_rows() > 0)
            return true;
        else
            return false;
    }
    
    function cancel_leave($lid){
        $data = $this->login_user;
        
        $this->db->set('status', '2');
        $this->db->set('approved_by', $data->uid);
        $this->db->where('lid', $lid);
        $this->db->update('apply_leave');
        if ($this->db->affected_rows() > 0)
            return true;
        else
            return false;
    }
}