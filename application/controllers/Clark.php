<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Clark extends CI_Controller {

    function __construct() {
        parent::__construct();
        $data = $this->login_user;
        if ($data->user_type == '3') {
            redirect(base_url("students/upload_students"));
        }
        $this->load->model("clark_model");
        $this->load->model("student_model");
    }

    public function clark_list() {
        $clarkList = $this->clark_model->get_clark_list();

        $this->load->view('includes/header');
        $this->load->view('includes/left_nav');
        $this->load->view('clark/clark_list', array('clarkList' => $clarkList));
        $this->load->view('includes/quick_nav');
        $this->load->view('includes/footer');
    }

    public function add_clark() {
        $this->load->view('includes/header');
        $this->load->view('includes/left_nav');
        $this->load->view('clark/add_clark_form');
        $this->load->view('includes/quick_nav');
        $this->load->view('includes/footer');
    }

    function save_clark() {
        //print_r($_POST);
        // $_POST['email'] <- this is used to get the field entered value from .html file
        //need to check the duplicate 
        $clark = array(
            'full_name' => $_POST['name'],
            'email' => $_POST['email'],
            'mobile' => $_POST['mobile'],
            'password' => md5($_POST['password']),
            'roll_number' => $_POST['rollnumber'],
            'academic_year' => $_POST['academic_year'],
            'user_type' => 3
        );
        //sending data as a array to model to enter the data in to database 
        $result = $this->clark_model->save_clark($clark);
        //handling the result which is from the model 
        if ($result) {
            Redirect(base_url('clark/clark_list'));
        } else {
            echo "fail";
        }
    }

    function update_clark() {
        $student = array(
            'full_name' => $_POST['name'],
            'email' => $_POST['email'],
            'mobile' => $_POST['mobile'],
            'roll_number' => $_POST['rollnumber'],
            'academic_year' => $_POST['academic_year'],
            'uid' => $_POST['uid']
        );
        //sending data as a array to model to enter the data in to database 
        $result = $this->student_model->update_student_model($student);
        //handling the result which is from the model 
        if ($result) {
            Redirect(base_url('clark/clark_list'));
        } else {
            Redirect(base_url('clark/clark_list'));
        }
    }

    function delete_clark() {
        if (isset($_POST["uid"])) {
            $this->student_model->delete_student_record($_POST["uid"]);
        }
        redirect(base_url('clark/clark_list'));
    }

    function edit_clark() {
        if (isset($_POST["uid"])) {
            $user_data = $this->student_model->get_student_details($_POST["uid"]);

            $this->load->view('includes/header');
            $this->load->view('includes/left_nav');
            $this->load->view('clark/clark_edit', array('user_data' => $user_data));
            $this->load->view('includes/quick_nav');
            $this->load->view('includes/footer');
        }
    }

}
