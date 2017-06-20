<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Mentors extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model("mentor_model");
    }

    public function mentors_list() {
        $mentorsList = $this->mentor_model->get_mentor_list();

        $this->load->view('includes/header');
        $this->load->view('includes/left_nav');
        $this->load->view('mentor/mentor_list', array('mentorsList' => $mentorsList));
        $this->load->view('includes/quick_nav');
        $this->load->view('includes/footer');
    }

    public function add_mentor() {
        $this->load->view('includes/header');
        $this->load->view('includes/left_nav');
        $this->load->view('mentor/add_mentor_form');
        $this->load->view('includes/quick_nav');
        $this->load->view('includes/footer');
    }
    
    function save_mentor() {
        //print_r($_POST);
        // $_POST['email'] <- this is used to get the field entered value from .html file
           
        //need to check the duplicate 
        $mentor = array(
            'full_name' => $_POST['name'],
            'email' => $_POST['email'],
            'mobile' => $_POST['mobile'],
            'password' => md5($_POST['password']),
            'roll_number' => $_POST['rollnumber'],
            'academic_year' => $_POST['academic_year'],
            'user_type' => 1
        );
        //sending data as a array to model to enter the data in to database 
        $result = $this->mentor_model->save_mentor($mentor);
        //handling the result which is from the model 
        if ($result) {
            redirect(base_url('mentors/mentors_list'));
        } else {
            echo "fail";
        }
    }
    
    function delete_mentor(){
         if (isset($_POST["uid"])){
            $this->mentor_model->delete_mentor_record($_POST["uid"]);
        }
        redirect(base_url('mentors/mentors_list'));
    }
    
    function edit_mentor(){
        if (isset($_POST["uid"])){
            $user_data = $this->mentor_model->get_mentor_details($_POST["uid"]);
            $this->load->view('includes/header');
        $this->load->view('includes/left_nav');
        $this->load->view('mentor/mentor_edit', array('user_data' => $user_data));
        $this->load->view('includes/quick_nav');
        $this->load->view('includes/footer');
        }
    }
    
    function update_mentor(){
         $mentor = array(
            'full_name' => $_POST['name'],
            'email' => $_POST['email'],
            'mobile' => $_POST['mobile'],
            'roll_number' => $_POST['rollnumber'],
            'academic_year' => $_POST['academic_year'],
            'uid' => $_POST['uid']
        );
        //sending data as a array to model to enter the data in to database 
        $result = $this->mentor_model->update_mentor_model($mentor);
        //handling the result which is from the model 
        if ($result) {
            redirect(base_url('mentors/mentors_list'));
        } else {
            echo "fail";
        }
    }
}