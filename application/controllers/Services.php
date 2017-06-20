<?php

class Services extends CI_Controller {
    #private $iv = 'govind0123456789'; #Same as in JAVA
    #private $key = '9876543210dnivog'; #Same as in JAVA

    function __construct() {
        parent::__construct();
        $this->load->model("Services_model");
    }

    public function app_view() {
        $this->load->model('apiview_model', 'api');
        $categories = $this->api->get_categories();
        $this->load->view("api_view", array("categories" => $categories));
    }

    #this method is to authunticate the user by username , password and gcm_id

    function userAuth() {
        $gcm_id = '';
        extract($_REQUEST); //this is very important to make sure the data from request is extracted and use isset to set the data 
        $err = array();
        if (!isset($username) || trim($username) == "")
            $err[] = "User Name is required and Missing";
        if (!isset($password) || trim($password) == "")
            $err[] = "Password is required and Missing";
        if (count($err) > 0) {
            $result = array('result' => 'failure', 'msg' => "Please Check Errors", "data" => $err);
        } else {
            //getting the user data by sending the roll_number 
            $res = $this->Services_model->get_user_data($username, "roll_number");
            if (count($res) == 0) {
                $result = array('result' => 'failure', 'msg' => "Username / Password you used is not correct.Please retry using the correct login details.");
            } else {
                if ($res->password != md5($password))
                    $result = array('result' => 'failure', 'msg' => "Username / Password you used is not correct.Please retry using the correct login details.");
                else if ($res->is_deleted == 1)
                    $result = array('result' => 'failure', 'msg' => "User disabled, Contact Admin Person!");
                else {
                    $data = array();
                    $guid = uniqid();
                    $this->Services_model->update_user_login($res->uid, $guid, $gcm_id);
                    $data['guid'] = $guid;
                    $data['today_date'] = date("Y-m-d");
                    $data['user_data'] = $this->Services_model->user_data($res->uid);
                    $result = array('result' => 'success', 'msg' => "Login Successful", "data" => $data);
                }
            }
        }
        echo json_encode($result);
    }

    #this is to change the password by giving the present password and new password

    function change_password() {
        extract($_REQUEST);
        $err = array();
        isset($old_password);
        if (!isset($guid) || trim($guid) == "")
            $err[] = "Guid is required and Missing";
        if (!isset($password) || trim($password) == "")
            $err[] = "Password  is required and Missing";
        else {
            $user_data = $this->Services_model->get_user_data($guid, "guid");
            if (count($user_data) == 0)
                $err[] = "GUID Not matched";
        }
        if ($user_data->password != md5($old_password)) {
            $result = array('result' => 'failure', 'msg' => "Username / Password you used is not correct.Please retry using the correct login details.");
        } else {
            if (count($err) == 0) {
                $datap = $this->Services_model->change_passowrd($user_data->uid, $password);
                if ($datap == TRUE) {
                    $message = 'Password Changes Successfully';
                } else {
                    $err[] = 'Password not updated';
                }
            }
            if (count($err) > 0)
                $result = array('result' => 'failure', 'msg' => "Please check errors", "errors" => $err);
            else
                $result = array('result' => 'success', 'msg' => $message);
        }
        echo json_encode($result);
    }

    function update_user_profile() {
        $user_img = '';
        $app_data = $_REQUEST;
        extract($_REQUEST);
        $err = array();
        if (!isset($guid) || trim($guid) == "")
            $err[] = "GUID is required and Missing";
        if (!isset($full_name) || trim($full_name) == "")
            $err[] = "Name is required and Missing";
        if (!isset($mobile) || trim($mobile) == "")
            $err[] = "Contact number is required and Missing";
        if (!isset($email) || trim($email) == "")
            $err[] = "Email Address is required and Missing";

        if (count($err) > 0) {
            $result = array('result' => 'failure', 'msg' => "Please Check Errors", "data" => $err);
        } else {
            $user = $this->Services_model->get_user_data($guid, "guid");
            $datap = $this->Services_model->update_user_profile($user->uid, $app_data);
            if ($user_img != '')
                $this->Services_model->save_user_image($user_img, $user->uid);

            if ($datap == TRUE) {
                $data = $this->Services_model->get_user_data($user->uid, "uid");
                $result = array('result' => 'success', 'msg' => "Profile is updated", 'data' => $data);
            } else {
                $result = array('result' => 'failure', 'msg' => "Profile is not updated", "data" => array());
            }
        }
        echo json_encode($result);
    }

//    function forgot_password() {
//        $is_app_view_test = 0;
//        extract($_REQUEST);
//        if ($is_app_view_test == 0) {
//            $data = $this->decrypt_request($_REQUEST);
//            extract($data);
//        }
//        $err = array();
//        if (!isset($username) || trim($username) == "")
//            $err[] = "Username is required and Missing";
//        else {
//            $user_data = $this->Services_model->get_user_data($username, "username");
//            if (count($user_data) == 0)
//                $err[] = "Username Not matched";
//        }
//        if (count($err) == 0) {
//            $msgd = $this->Services_model->forgot_password($user_data->uid);
//            if ($msgd == TRUE) {
//                $message = 'Password has been reset to default password.';
//            } else {
//                $err[] = 'Password is not reset';
//            }
//        }
//        $data['app_version'] = $this->db->query("select app_version_name from app_version")->row();
//        if (count($err) > 0)
//            $result = array('result' => 'failure', 'msg' => "Please check errors", "errors" => $err);
//        else
//            $result = array('result' => 'success', 'msg' => $message, 'data' => $data);
//        echo json_encode($result);
//    }

    function get_courses() {
        extract($_REQUEST);
        $err = array();
        if (!isset($guid) || trim($guid) == "")
            $err [] = "GUID is required and Missing. ";
        else {
            $user_data = $this->Services_model->get_user_data($guid, "guid");
            if (count($user_data) == 0)
                $err[] = "GUID Not matched";
        }
        if (count($err) == 0) {
            $data = $this->Services_model->get_courses_val();
            if (count($data) > 0) {
                $message = 'Courses Details';
            } else {
                $message = 'Course List is empty';
            }
        }
        if (count($err) > 0)
            $result = array('result' => 'failure', 'msg' => $message, "errors" => $err);
        else
            $result = array('result' => 'success', 'msg' => $message, 'data' => $data);

        echo json_encode($result);
    }

    function get_marks() {
        extract($_REQUEST);
        $err = array();
        if (!isset($guid) || trim($guid) == "")
            $err[] = "GUID is required and Missing.";
        if (!isset($cid) || trim($cid) == "") {
            $err[] = "Course id is required and Missing.";
        } else {
            $user_data = $this->Services_model->get_user_data($guid, "guid");
            if (count($user_data) == 0)
                $err[] = "GUID Not matched";
        }
        if (count($err) == 0) {
            $data = $this->Services_model->get_marks_val($user_data->uid, $cid);
            if (count($data) > 0)
                $message = 'Courses Details';
            else
                $message = 'There is no record with this';
        }
        if (count($err) > 0)
            $result = array('result' => 'failure', 'msg' => 'Something went wrong', "errors" => $err);
        else
            $result = array('result' => 'success', 'msg' => $message, 'data' => $data);

        echo json_encode($result);
    }

    function get_attendance() {
        extract($_REQUEST);
        $err = array();
        if (!isset($guid) || trim($guid) == "")
            $err[] = "GUID is required and Missing.";
        else {
            $user_data = $this->Services_model->get_user_data($guid, "guid");
            if (count($user_data) == 0)
                $err[] = "GUID Not matched";
        }
        if (count($err) == 0) {
            $data = $this->Services_model->get_attendance_val($user_data->uid);
            if (count($data) > 0)
                $message = 'Attendance Details';
            else
                $message = 'There is no record with this';
        }
        if (count($err) > 0)
            $result = array('result' => 'failure', 'msg' => 'Something went wrong', "errors" => $err);
        else
            $result = array('result' => 'success', 'msg' => $message, 'data' => $data);

        echo json_encode($result);
    }

    function get_mentors_details() {
        extract($_REQUEST);
        $err = array();
        if (!isset($guid) || trim($guid) == "")
            $err[] = "GUID is required and Missing.";
        else {
            $user_data = $this->Services_model->get_user_data($guid, "guid");
            if (count($user_data) == 0)
                $err[] = "GUID Not matched";
        }
        if (count($err) == 0) {
            $data = $this->Services_model->get_all_mentors_details();
            if (count($data) > 0)
                $message = 'Mentor Details';
            else
                $message = 'There is no record with this';
        }
        if (count($err) > 0) {
            $result = array('result' => 'failure', 'msg' => 'Something went wrong', "errors" => $err);
        } else {
            $result = array('result' => 'success', 'msg' => $message, 'data' => $data);
        }
        echo json_encode($result);
    }

    function get_events() {
        extract($_REQUEST);
        $err = array();
        if (!isset($guid) || trim($guid) == "")
            $err[] = "GUID is required and Missing.";
        else {
            $user_data = $this->Services_model->get_user_data($guid, "guid");
            if (count($user_data) == 0)
                $err[] = "GUID Not matched";
        }
        if (count($err) == 0) {
            $data = $this->Services_model->get_events($event_date);
            if (count($data) > 0)
                $message = 'Events Details';
            else
                $message = 'There are no records';
        }
        if (count($err) > 0)
            $result = array('result' => 'failure', 'msg' => 'Something went wrong', "errors" => $err);
        else
            $result = array('result' => 'success', 'msg' => $message, 'data' => $data);

        echo json_encode($result);
    }

    function get_student_by_course() {
        extract($_REQUEST);
        $err = array();
        if (!isset($guid) || trim($guid) == "")
            $err [] = "GUID is required and Missing. ";
        if (!isset($cid) || trim($cid) == "")
            $err [] = "Course Id is required and Missing. ";
        else {
            $user_data = $this->Services_model->get_user_data($guid, "guid");
            if (count($user_data) == 0)
                $err[] = "GUID Not matched";
        }
        if (count($err) == 0) {
            $data = $this->Services_model->get_students($cid, $user_data->uid);
            if (count($data) > 0) {
                $message = 'Student Details';
            } else {
                $err[] = 'Something went wrong..';
            }
        }
        if (count($err) > 0)
            $result = array('result' => 'failure', 'msg' => $err, "errors" => $err);
        else
            $result = array('result' => 'success', 'msg' => $message, 'data' => $data);

        echo json_encode($result);
    }

    function get_student_data() {
        extract($_REQUEST);
        $err = array();
        if (!isset($guid) || trim($guid) == "")
            $err [] = "GUID is required and Missing. ";
        else {
            $user_data = $this->Services_model->get_user_data($guid, "guid");
            if (count($user_data) == 0)
                $err[] = "GUID Not matched";
        }
        if (count($err) == 0) {
            $data = $this->Services_model->get_all_students();
            if (count($data) > 0) {
                $message = 'Student Details';
            } else {
                $err[] = 'Something went wrong..';
            }
        }
        if (count($err) > 0)
            $result = array('result' => 'failure', 'msg' => $err, "errors" => $err);
        else
            $result = array('result' => 'success', 'msg' => $message, 'data' => $data);

        echo json_encode($result);
    }

    function post_event() {
        extract($_REQUEST);
        $err = array();
        if (!isset($guid) || trim($guid) == "")
            $err [] = "GUID is required and Missing. ";
        if (!isset($title) || trim($title) == "")
            $err [] = "title is required and Missing. ";
        if (!isset($desc) || trim($desc) == "")
            $err [] = "desc is required and Missing. ";
        if (!isset($event_date) || trim($event_date) == "")
            $err [] = "Event Date is required and Missing. ";
        else {
            $user_data = $this->Services_model->get_user_data($guid, "guid");
            if (count($user_data) == 0)
                $err[] = "GUID Not matched";
        }
        if (count($err) == 0) {
            $data = $this->Services_model->post_event($user_data->uid, $title, $desc, $event_date);
            if ($data == TRUE) {
                $message = 'Event Posted';
            } else {
                $err[] = 'Something went wrong..';
            }
        }
        if (count($err) > 0)
            $result = array('result' => 'failure', 'msg' => $err, "errors" => $err);
        else
            $result = array('result' => 'success', 'msg' => $message, 'data' => $data);

        echo json_encode($result);
    }

    function get_marks_by_student() {
        extract($_REQUEST);
        $err = array();
        if (!isset($guid) || trim($guid) == "")
            $err [] = "GUID is required and Missing. ";
        if (!isset($student_id) || trim($student_id) == "")
            $err [] = "Student id is required and Missing. ";
        else {
            $user_data = $this->Services_model->get_user_data($guid, "guid");
            if (count($user_data) == 0)
                $err[] = "GUID Not matched";
        }
        if (count($err) == 0) {
            $data = $this->Services_model->get_student_marks($student_id);
            if (count($data) > 0) {
                $message = 'Student Marks Details';
            } else {
                $message = 'No records Found...';
            }
        }
        if (count($err) > 0)
            $result = array('result' => 'failure', 'msg' => $err, "errors" => $err);
        else
            $result = array('result' => 'success', 'msg' => $message, 'data' => $data);

        echo json_encode($result);
    }

    function apply_leave() {
        extract($_REQUEST);
        $err = array();
        if (!isset($guid) || trim($guid) == "")
            $err [] = "GUID is required and Missing. ";
        if (!isset($reason) || trim($reason) == "")
            $err [] = "reason is required and Missing. ";
        if (!isset($from_date) || trim($from_date) == "")
            $err [] = "form date is required and Missing. ";
        if (!isset($to_date) || trim($to_date) == "")
            $err [] = "to date is required and Missing. ";
        else {
            $user_data = $this->Services_model->get_user_data($guid, "guid");
            if (count($user_data) == 0)
                $err[] = "GUID Not matched";
        }
        if (count($err) == 0) {
            $cid = $this->Services_model->get_course_by_date($from_date);
            $mid = $this->Services_model->get_mentor_id($user_data->uid,$cid->cid);
            $data = $this->Services_model->insert_apply_leave($user_data->uid, $reason, $from_date, $to_date,$cid->cid,$mid->mid);
            if ($data == TRUE) {
                $message = 'Leave Applyed';
            } else {
                $message = 'Something went wrong..';
            }
        }
        if (count($err) > 0)
            $result = array('result' => 'failure', 'msg' => $message, "errors" => $err);
        else
            $result = array('result' => 'success', 'msg' => $message, 'data' => $data);

        echo json_encode($result);
    }
    
    function get_leave_history(){
        extract($_REQUEST);
        $err = array();
        if (!isset($guid) || trim($guid) == "")
            $err [] = "GUID is required and Missing. ";
        else {
            $user_data = $this->Services_model->get_user_data($guid, "guid");
            if (count($user_data) == 0)
                $err[] = "GUID Not matched";
        }
        if (count($err) == 0) {
            $data = $this->Services_model->get_applied_leave($user_data->uid);
            if ($data == TRUE) {
                $message = 'Leave Applyed';
            } else {
                $message = 'No records..';
            }
        }
        if (count($err) > 0)
            $result = array('result' => 'failure', 'msg' => $message, "errors" => $err);
        else
            $result = array('result' => 'success', 'msg' => $message, 'data' => $data);

        echo json_encode($result);
    }
    
    function get_students_by_present_course(){
        extract($_REQUEST);
        $err = array();
        if (!isset($guid) || trim($guid) == "")
            $err [] = "GUID is required and Missing. ";
        else {
            $user_data = $this->Services_model->get_user_data($guid, "guid");
            if (count($user_data) == 0)
                $err[] = "GUID Not matched";
        }
        if (count($err) == 0) {
            $date = date('Y-m-d');
            $course_id = $this->Services_model->get_course_by_date($date);
            $data = $this->Services_model->present_course_wise_student_list($course_id->cid,$user_data->uid);
            if ($data == TRUE) {
                $message = 'student Records Found';
            } else {
                $message = 'No records..';
            }
        }
        if (count($err) > 0)
            $result = array('result' => 'failure', 'msg' => 'something went...', "errors" => $err);
        else
            $result = array('result' => 'success', 'msg' => $message, 'data' => $data);

        echo json_encode($result);
    }
    
    function get_applied_leaves_for_mentor(){
        extract($_REQUEST);
        $err = array();
        if (!isset($guid) || trim($guid) == "")
            $err [] = "GUID is required and Missing. ";
        else {
            $user_data = $this->Services_model->get_user_data($guid, "guid");
            if (count($user_data) == 0)
                $err[] = "GUID Not matched";
        }
        if (count($err) == 0) {
            $date = date('Y-m-d');
            $course_id = $this->Services_model->get_course_by_date($date);
            $data = $this->Services_model->present_course_wise_student_list($course_id->cid,$user_data->uid);
            if ($data == TRUE) {
                $message = 'student Records Found';
            } else {
                $message = 'No records..';
            }
        }
        if (count($err) > 0)
            $result = array('result' => 'failure', 'msg' => $message, "errors" => $err);
        else
            $result = array('result' => 'success', 'msg' => $message, 'data' => $data);

        echo json_encode($result);
    }
    
    function get_student_attendance(){
        extract($_REQUEST);
        $err = array();
        if (!isset($guid) || trim($guid) == "")
            $err [] = "GUID is required and Missing. ";
        else {
            $user_data = $this->Services_model->get_user_data($guid, "guid");
            if (count($user_data) == 0)
                $err[] = "GUID Not matched";
        }
        if (count($err) == 0) {
            $taken_leaves = $this->Services_model->total_leaves_taken($user_data->uid);
            $data = $this->Services_model->get_student_attendance($user_data->uid);
            if ($data == TRUE) {
                $message = 'student Records Found';
            } else {
                $message = 'No records..';
            }
        }
        if (count($err) > 0)
            $result = array('result' => 'failure', 'msg' => $message, 'total_taken_leaves' => $taken_leaves->total_leaves_taken,"errors" => $err);
        else
            $result = array('result' => 'success', 'msg' => $message, 'total_taken_leaves' => $taken_leaves->total_leaves_taken,'data' => $data);

        echo json_encode($result);
    }
    
    function get_my_team(){
        extract($_REQUEST);
        $err = array();
        if (!isset($guid) || trim($guid) == "")
            $err [] = "GUID is required and Missing. ";
        if (!isset($cid) || trim($cid) == "")
            $err [] = "course id is required and Missing. ";
        else {
            $user_data = $this->Services_model->get_user_data($guid, "guid");
            if (count($user_data) == 0)
                $err[] = "GUID Not matched";
        }
        if (count($err) == 0) {
            $data = $this->Services_model->get_student_my_team_data($user_data->uid,$cid);
            if ($data != null || $data  > 0) {
                $message = 'student Records Found';
            } else {
                $message = 'No records..';
            }
        }
        if (count($err) > 0)
            $result = array('result' => 'failure', 'msg' => 'failure', 'errors' => $err);
        else
            $result = array('result' => 'success', 'msg' => $message, 'data' => $data);

        echo json_encode($result);
    }

    function post_attendance() {
        extract($_REQUEST);
        $date = date("Y-m-d");
        $err = array();
        if (!isset($guid) || trim($guid) == "")
            $err [] = "GUID is required and Missing. ";
        if (!isset($attendance) || trim($attendance) == "")
            $err [] = "Attendance is required and Missing. ";
        else {
            $user_data = $this->Services_model->get_user_data($guid, "guid");
            if (count($user_data) == 0)
                $err[] = "GUID Not matched";
        }
        if (count($err) == 0) {
            //getting the cid from the date
            $course_data = $this->Services_model->get_course_by_date($date);
            $json = json_decode($attendance, true);
            //print_r($json);exit;
            $yummy = TRUE;
            foreach ($json as $key => $value) {
                //inserting the attendance in the table
                $count = $this->Services_model->insert_student_attendance($course_data->cid, $date, $value['uid'], $value['status']);
                //need to change the no of leave taken by the user 
                $no_of_leaves = $this->Services_model->get_student_leaves($value['uid'])->total_leaves_taken;
                if ($value['status'] == "0") {
                    $no_of_leaves = $no_of_leaves + 1;
                } else if ($value['status'] == "1") {
                    $no_of_leaves = $no_of_leaves + 0.25;
                } else if ($value['status'] == "2") {
                    $no_of_leaves = $no_of_leaves + 0.5;
                }
                $this->Services_model->update_leaves_count($no_of_leaves, $value['uid']);
                if ($count != true)
                    $yummy = false;
            }
            if ($yummy == TRUE) {
                $message = 'Student Attendance Records inserted';
            } else {
                $message = 'Student Attendance Records not inserted';
            }
        }
        if (count($err) > 0)
            $result = array('result' => 'failure', 'msg' => 'Something went wrong...', 'errors' => $err);
        else
            $result = array('result' => 'success', 'msg' => $message, 'data' => $yummy);
        echo json_encode($result);
    }
    
    function leave_approve() {
        extract($_REQUEST);
        $err = array();
        if (!isset($guid) || trim($guid) == "")
            $err [] = "GUID is required and Missing. ";
        if (!isset($approve_status) || trim($approve_status) == "")
            $err [] = "approved status is required and Missing. ";
        if (!isset($lid) || trim($lid) == "")
            $err [] = "lid is required and Missing. ";
        else {
            $user_data = $this->Services_model->get_user_data($guid, "guid");
            if (count($user_data) == 0)
                $err[] = "GUID Not matched";
        }
        if (count($err) == 0) {
            $data = $this->Services_model->update_leave_status($user_data->uid,$approve_status,$lid);
            if ($data == TRUE) {
                $message = 'Leave Status Approved';
            } else {
                $message = 'No records..';
            }
        }
        if (count($err) > 0){
            $result = array('result' => 'failure', 'msg' => $message, 'errors' => $err);
        }else{
            $result = array('result' => 'success', 'msg' => $message, 'data' => $data);
        }
        echo json_encode($result);
    }

    function leaves_applied(){
        extract($_REQUEST);
        $err = array();
        if (!isset($guid) || trim($guid) == "")
            $err [] = "GUID is required and Missing. ";
        else {
            $user_data = $this->Services_model->get_user_data($guid, "guid");
            if (count($user_data) == 0)
                $err[] = "GUID Not matched";
        }
        if (count($err) == 0) {
            $data = $this->Services_model->getLeavesApplied($user_data->uid);
            if ($data == TRUE) {
                $message = 'Applied Leaves by Student Data';
            } else {
                $message = 'No records..';
            }
        }
        if (count($err) > 0){
            $result = array('result' => 'failure', 'msg' => "failure", 'errors' => $err);
        }else{
            $result = array('result' => 'success', 'msg' => $message, 'data' => $data);
        }
        echo json_encode($result);
    }
}