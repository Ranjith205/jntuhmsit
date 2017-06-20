<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Leave_approvel extends CI_Controller{
    
    function __construct() {
        parent::__construct();
        $this->load->model("leave_approvel_model");
    }
    
    
    function leave_approvel_list(){
        $data = $this->login_user;
        if ($data->user_type == '3') {
            redirect(base_url("dashboard/show_dashboard"));
        } else {
            $leave_data = $this->leave_approvel_model->get_pending_leaves_model();

            $this->load->view('includes/header');
            $this->load->view('includes/left_nav');
            $this->load->view('leave_approvel/leave_approvels_list', array('leave_data' => $leave_data));
            $this->load->view('includes/quick_nav');
            $this->load->view('includes/footer');
        }
    }
    
    function approve_leave(){
        if (isset($_POST["lid"])) {
            $user_data = $this->leave_approvel_model->approve_leave($_POST["lid"]);
            
            $this->load->view('includes/header');
            $this->load->view('includes/left_nav');
            $this->load->view('leave_approvel/leave_approvels_list', array('leave_data' => $leave_data));
            $this->load->view('includes/quick_nav');
            $this->load->view('includes/footer');
        }
        
    }
    
    function cancel_leave(){
        if (isset($_POST["lid"])) {
            $user_data = $this->leave_approvel_model->cancel_leave($_POST["lid"]);
            
            $this->load->view('includes/header');
            $this->load->view('includes/left_nav');
            $this->load->view('leave_approvel/leave_approvels_list', array('leave_data' => $leave_data));
            $this->load->view('includes/quick_nav');
            $this->load->view('includes/footer');
        }
    }
}