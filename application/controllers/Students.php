<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Students extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model("student_model");
    }

    public function students_list() {
        $data = $this->login_user;
        if ($data->user_type == '3') {
            redirect(base_url("students/add_student"));
        } else {
            $studentList = $this->student_model->getStudentList();

            $this->load->view('includes/header');
            $this->load->view('includes/left_nav');
            $this->load->view('students/student_list', array('studentlist' => $studentList));
            $this->load->view('includes/quick_nav');
            $this->load->view('includes/footer');
        }
    }

    public function upload_students() {
        $this->load->view('includes/header');
        $this->load->view('includes/left_nav');
        $this->load->view('students/student_upload');
        $this->load->view('includes/quick_nav');
        $this->load->view('includes/footer');
    }

    public function add_student() {
            $this->load->view('includes/header');
            $this->load->view('includes/left_nav');
            $this->load->view('students/add_student_form');
            $this->load->view('includes/quick_nav');
            $this->load->view('includes/footer');
    }

    function show_parents() {
        $data = $this->login_user;
        if ($data->user_type == '3') {
            redirect(base_url("students/add_student"));
        } else {
            $parent_data = $this->student_model->get_parent_data();

            $this->load->view('includes/header');
            $this->load->view('includes/left_nav');
            $this->load->view('students/show_parents', array('parent_data' => $parent_data));
            $this->load->view('includes/quick_nav');
            $this->load->view('includes/footer');
        }
    }

    function delete_student() {
        if (isset($_POST["uid"])) {
            $this->student_model->delete_student_record($_POST["uid"]);
        }
        redirect(base_url('students/students_list'));
    }

    function edit_student() {
        if (isset($_POST["uid"])) {
            $user_data = $this->student_model->get_student_details($_POST["uid"]);
            $this->load->view('includes/header');
            $this->load->view('includes/left_nav');
            $this->load->view('students/student_edit', array('user_data' => $user_data));
            $this->load->view('includes/quick_nav');
            $this->load->view('includes/footer');
        }
    }

    function save_student() {
        //print_r($_POST);
        // $_POST['email'] <- this is used to get the field entered value from .html file

        $student = array(
            'full_name' => $_POST['name'],
            'email' => $_POST['email'],
            'mobile' => $_POST['mobile'],
            'password' => md5($_POST['password']),
            'roll_number' => $_POST['rollnumber'],
            'parent_name' => $_POST['parent_name'],
            'parent_mobile' => $_POST['parent_mobile'],
            'parent_email' => $_POST['parent_email'],
            'academic_year' => $_POST['academic_year']
        );
        //sending data as a array to model to enter the data in to database 
        $result = $this->student_model->saveStudentModel($student);
        //handling the result which is from the model 
        if ($result) {
            Redirect(base_url('students/students_list'));
        } else {
            echo "fail";
        }
    }

    function update_student() {
        $student = array(
            'full_name' => $_POST['name'],
            'email' => $_POST['email'],
            'mobile' => $_POST['mobile'],
            'roll_number' => $_POST['rollnumber'],
            'parent_name' => $_POST['parent_name'],
            'parent_mobile' => $_POST['parent_mobile'],
            'parent_email' => $_POST['parent_email'],
            'academic_year' => $_POST['academic_year'],
            'uid' => $_POST['uid']
        );
        //sending data as a array to model to enter the data in to database 
        $result = $this->student_model->update_student_model($student);
        //handling the result which is from the model 
        if ($result) {
            Redirect(base_url('students/students_list'));
        } else {
            echo "fail";
        }
    }

    //
    function file_upload_student() {
//        print_r($_FILES);
        if (count($_FILES) > 0) {
            $inputFileName = $_FILES["file_upload_studdent"]["tmp_name"];
            $this->load->library('excel');
            $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
            $objReader = PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($inputFileName);
            $sheet = $objPHPExcel->getSheet(0);
            $highestRow = $sheet->getHighestRow();
            $highestColumn = $sheet->getHighestColumn();
            if ($highestColumn != 'I') {
                echo json_encode(array("result" => "failure", "msg" => "Data Format Worng Please check and try again..", "html" => ""));
            } else {
                $rowData = $sheet->rangeToArray('A2:I' . $highestRow, NULL, TRUE, FALSE);
//                echo '<pre>';
//                print_r($rowData);
//                exit;
                foreach ($rowData as $d) {
                    //dupilicate check and if count is more then dont enter the data in to db
                    $count = $this->student_model->duplicate_check($d[0]);
                    if ($count <= 0) {
                        $student = array(
                            'full_name' => $d[2],
                            'email' => $d[3],
                            'mobile' => $d[4],
                            'password' => md5($d[5]),
                            'roll_number' => $d[0],
                            'academic_year' => $d[1],
                            'parent_name' => $d[6],
                            'parent_mobile' => $d[7],
                            'parent_email' => $d[8],
                        );
                        //sending data as a array to model to enter the data in to database 
                        $result = $this->student_model->saveStudentModel($student);
                    }
                }
                //after success then redirecting to certain page
                Redirect(base_url('students/students_list'));
            }
        }
    }

    function logout() {
        $user_data = $this->session->all_userdata();
        foreach ($user_data as $key => $value) {
            if ($key != 'session_id' && $key != 'ip_address' && $key != 'user_agent' && $key != 'last_activity') {
                $this->session->unset_userdata($key);
            }
        }
        $this->session->sess_destroy();
        redirect(base_url('login'), 'refresh');
    }

}
