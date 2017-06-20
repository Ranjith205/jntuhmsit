<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
        //if session got set then we are not redirecting to login controller 
        if (is_object($this->session->userdata("user_data"))) {
            if ($this->login_user->user_type == '3') {
                redirect(base_url("students/upload_students"));
            } else {
                redirect(base_url('dashboard/show_dashboard'));
            }
        } else {
            $this->load->model("login_model");
        }
    }

    //this is to get the dashboard
    public function index() {
        $this->load->view('login');
    }

    function auth() {
        if (isset($_POST['username']) && isset($_POST['password'])) {
            $username = trim($this->input->post("username"));
            $password = trim($this->input->post("password"));
            $data = $this->login_model->get_login_data($username);
            if (empty($data)) {
                $result = array("result" => "failure", "msg" => "Sorry..! Username or Password is worng..");
            } else if ($data->password != MD5($password)) {
                $result = array("result" => "failure", "msg" => " Sorry..! Wrong Password..");
            } else if ($data->is_deleted == 1) {
                $result = array("result" => "failure", "msg" => "Sorry..! Your account is disabled, Please contact concern person..");
            } else {
                $url = base_url();
                if ($data->user_type == '3') {
                    $url .= "students/upload_students";
                } else {
                    $url .= "dashboard/show_dashboard";
                }
                $data->url = $url;
                $this->session->set_userdata("user_data", $data);
                $result = array("result" => "success", "msg" => "User authenticated", "url" => $url);
            }
        } else {
            $result = array("result" => "failure", "msg" => "Somthing went wrong", "url" => "");
        }
        echo json_encode($result);
    }

}

?>