<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    function __construct() {
        parent::__construct();
        $data = $this->login_user;
        if ($data->user_type == '3') {
            redirect(base_url("students/upload_students"));
        }
        $this->load->model("dashboard_model");
    }

    //this is to get the dashboard
    public function show_dashboard() {
        $event_list = $this->dashboard_model->get_event_list_for_dashboard();
        //event count
        $event_count = $this->dashboard_model->get_event_count();
        //leve approvel count 
        $leave_approvel_count = $this->dashboard_model->get_leave_approvel_count();
        //student leave exceeded count
        $student_leaves_exceeded = $this->dashboard_model->get_student_leaves_exceeded();
        //students failed count
        $student_failed = $this->dashboard_model->get_student_failed_count();

        $this->load->view('includes/header');
        $this->load->view('includes/left_nav');
        $this->load->view('dashboard', array('event_list' => $event_list, 'event_count' => $event_count,
            'leave_approvel_count' => $leave_approvel_count,
            'student_leaves_exceeded' => $student_leaves_exceeded,
            'student_failed' => $student_failed));
        $this->load->view('includes/quick_nav');
        $this->load->view('includes/footer');
    }

}

?>