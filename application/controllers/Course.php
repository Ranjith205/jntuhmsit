<?php

class Course extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model("course_model");
        $this->load->model("student_model");
        $this->load->model("mentor_model");
    }

    function show_course_list() {
        $courselist = $this->course_model->getCourseList();

        $this->load->view('includes/header');
        $this->load->view('includes/left_nav');
        $this->load->view('courses/course_list', array('courselist' => $courselist));
        $this->load->view('includes/quick_nav');
        $this->load->view('includes/footer');
    }

    function add_course() {
        $this->load->view('includes/header');
        $this->load->view('includes/left_nav');
        $this->load->view('courses/add_course_form');
        $this->load->view('includes/quick_nav');
        $this->load->view('includes/footer');
    }

    function course_enrollment() {
        $this->load->view('includes/header');
        $this->load->view('includes/left_nav');
        $this->load->view('courses/course_enrollment');
        $this->load->view('includes/quick_nav');
        $this->load->view('includes/footer');
    }

    function course_enrollment_list() {
        $is_ajax = 0;
        if (isset($_POST['course_id'])) {
            $course_id = $_POST['course_id'];
            $is_ajax = 1;
        }
        $course_enrollment_list = $this->course_model->get_course_enrollment_list();
        if ($is_ajax == 0) {
            $course_names_list = $this->course_model->getCourseList();
            $this->load->view('includes/header');
            $this->load->view('includes/left_nav');
            $this->load->view('courses/course_enrollment_list', array('course_enrollment_list' => $course_enrollment_list, 'course_names_list' => $course_names_list, 'is_ajax' => $is_ajax));
            $this->load->view('includes/quick_nav');
            $this->load->view('includes/footer');
        } else {
            $string = $this->load->view('courses/course_enrollment_list', array('course_enrollment_list' => $course_enrollment_list, 'is_ajax' => $is_ajax), true);
            echo json_encode(array("result" => "success", "msg" => "course_list", "string" => ""));
        }
    }

    public function save_course() {
        //print_r($_POST);
        // $_POST['email'] <- this is used to get the field entered value from .html file

        $course = array(
            'cid' => $_POST['course_id'],
            'course_name' => $_POST['course_name'],
            'no_of_leaves' => $_POST['no_of_leaves'],
            'from_date' => $_POST['from_date'],
            'to_date' => $_POST['to_date'],
            'credits' => $_POST['credits']
        );
        //sending data as a array to model to enter the data in to database 
        $result = $this->course_model->saveCourseModel($course);
        //handling the result which is from the model 
        if ($result) {
            $this->show_course_list();
        } else {
            echo "fail";
        }
    }

    function file_upload_enrollment() {
        //        print_r($_FILES);
        if (count($_FILES) > 0) {
            $inputFileName = $_FILES["file_upload_enrollment"]["tmp_name"];
            $this->load->library('excel');
            $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
            $objReader = PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($inputFileName);
            $sheet = $objPHPExcel->getSheet(0);
            $highestRow = $sheet->getHighestRow();
            $highestColumn = $sheet->getHighestColumn();
            if ($highestColumn != 'C') {
                echo json_encode(array("result" => "failure", "msg" => "Data Format Worng Please check and try again.."));
            } else {
                $rowData = $sheet->rangeToArray('A2:C' . $highestRow, NULL, TRUE, FALSE);
//                echo '<pre>';
//                print_r($rowData);
//                exit;
                foreach ($rowData as $row) {
                    $sid = $this->student_model->get_student_id($row[0]);
                    $mid = $this->mentor_model->get_mentor_id($row[2]);

//                    echo $sid;
//                    echo $mid;
//                    exit;
                    if ($sid > 0 && $mid > 0) {
                        //dupilicate check and if count is more then dont enter the data in to db
                        $count = $this->course_model->duplicate_check_model($sid, $row[1], $mid);
                        if ($count == 0) {
                            $course_enrollment = array(
                                'sid' => $sid,
                                'cid' => $row[1],
                                'mid' => $mid
                            );
                            //sending data as a array to model to enter the data in to database 
                            $result = $this->course_model->save_course_enrollment($course_enrollment);
                            //}
                        }
                    }
                }
                //after success then redirecting to certain page
                Redirect(base_url('course/course_enrollment_list'));
            }
        }
    }

    function delete_course() {
        if (isset($_POST["cid"])) {
            $this->course_model->delete_course_record($_POST["cid"]);
        }
        redirect(base_url('course/show_course_list'));
    }

    function edit_course() {
        if (isset($_POST["cid"])) {
            $course_data = $this->course_model->get_course_details($_POST["cid"]);
            $this->load->view('includes/header');
            $this->load->view('includes/left_nav');
            $this->load->view('courses/course_edit', array('course_data' => $course_data));
            $this->load->view('includes/quick_nav');
            $this->load->view('includes/footer');
        }
    }

    function update_course() {
        $course = array(
            'cid' => $_POST['course_id'],
            'course_name' => $_POST['course_name'],
            'no_of_leaves' => $_POST['no_of_leaves'],
            'from_date' => $_POST['from_date'],
            'to_date' => $_POST['to_date'],
            'credits' => $_POST['credits']
        );
        //sending data as a array to model to enter the data in to database 
        $result = $this->course_model->update_course_model($course);
        //handling the result which is from the model 
        if ($result) {
            Redirect(base_url('course/show_course_list'));
        } else {
            echo "fail";
        }
    }

    function hide_course() {
        if (isset($_POST["cid"])) {
            $this->course_model->inactive_course_record($_POST["cid"]);
        }
        redirect(base_url('course/show_course_list'));
    }

    function visible_course() {
        if (isset($_POST["cid"])) {
            $this->course_model->active_course_record($_POST["cid"]);
        }
        redirect(base_url('course/show_course_list'));
    }

    function delete_enrollment_course() {
        if (isset($_POST["ce_id"])) {
            $this->course_model->delete_enrollment_course_record($_POST["ce_id"]);
        }
        redirect(base_url('course/course_enrollment_list'));
    }

    function edit_enrollment_course() {
        if (isset($_POST["ce_id"])) {
            $mentors = $this->mentor_model->get_mentor_list();
            $course_details = $this->course_model->get_course_enrollment_row($_POST["ce_id"]);

            $this->load->view('includes/header');
            $this->load->view('includes/left_nav');
            $this->load->view('courses/course_edit_enrollment_list', array('mentors' => $mentors, 'course_details' => $course_details));
            $this->load->view('includes/quick_nav');
            $this->load->view('includes/footer');
        } else {
            redirect(base_url('course/course_enrollment_list'));
        }
    }

    function update_enrollment() {
        if (isset($_POST["ce_id"])) {
            $result = $this->course_model->upload_course_enrollment($_POST["ce_id"], $_POST["mentor_id"]);
        }
        redirect(base_url('course/course_enrollment_list'));
    }
    
    function hide_course_enrollment(){
        if (isset($_POST["ce_id"])) {
            $this->course_model->inactive_course_enrollment($_POST["ce_id"]);
        }
        redirect(base_url('course/course_enrollment_list'));
    }
    
    function visible_course_enrollment() {
        if (isset($_POST["ce_id"])) {
            $this->course_model->active_course_enrollment($_POST["ce_id"]);
        }
        redirect(base_url('course/course_enrollment_list'));
    }
}
?>