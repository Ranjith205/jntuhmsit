<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Marks extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model("student_model");
        $this->load->model("marks_model");
        $this->load->model("course_model");
    }
    
    
    public function students_marks_list() {
        $student_marks_list = $this->marks_model->get_student_marks_list();

        $this->load->view('includes/header');
        $this->load->view('includes/left_nav');
        $this->load->view('marks/student_marks_list', array('student_marks_list' => $student_marks_list));
        $this->load->view('includes/quick_nav');
        $this->load->view('includes/footer');
    }
    
    public function upload_students_marks() {
        $this->load->view('includes/header');
        $this->load->view('includes/left_nav');
        $this->load->view('marks/marks_upload');
        $this->load->view('includes/quick_nav');
        $this->load->view('includes/footer');
    }
    
    public function delete_student_marks(){
        if (isset($_POST["marks_id"])){
            $this->marks_model->delete_student_marks($_POST["marks_id"]);
        }
        redirect(base_url('marks/students_marks_list'));
    }
    
    public function edit_student_marks(){
        if (isset($_POST["marks_id"])){
            $user_data = $this->marks_model->get_student_marks_details($_POST["marks_id"]);
            $this->load->view('includes/header');
        $this->load->view('includes/left_nav');
        $this->load->view('marks/student_marks_edit', array('user_data' => $user_data));
        $this->load->view('includes/quick_nav');
        $this->load->view('includes/footer');
        }
    }
    
    public function update_student_marks(){
         $marks = array(
            'percentage' => $_POST['percentage'],
            'marks_id' => $_POST['marks_id'],
             'ended_date'=>$_POST['ended_date'],
             'started_date' => $_POST['started_date']
        );
        //sending data as a array to model to enter the data in to database 
        $result = $this->marks_model->update_student_model($marks);
        //handling the result which is from the model 
        if ($result) {
            Redirect(base_url('marks/students_marks_list'));
        } else {
            Redirect(base_url('marks/students_marks_list'));
        }
    }
       #this is to upload the student marks list by excell sheet
    function file_upload_students_marks() {
        if (count($_FILES) > 0) {
            $inputFileName = $_FILES["file_upload_students_marks"]["tmp_name"];//@param1 name of the html tag @param2 temp name 
            $this->load->library('excel');//format of the file uploaded
            $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
            $objReader = PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($inputFileName);
            $sheet = $objPHPExcel->getSheet(0);//@param sheet number in the excell
            $highestRow = $sheet->getHighestRow();//getting the hightest row value in the excell ie A, B , C....
            $highestColumn = $sheet->getHighestColumn();//getting the highestcoloumn value in the excel ie A1,A2,B1,B2.....
            if ($highestColumn != 'F') {
                echo json_encode(array("result" => "failure", "msg" => "Data Format Worng Please check and try again..", "html" => ""));
            } else {
                $rowData = $sheet->rangeToArray('A2:F' . $highestRow, NULL, TRUE, FALSE);//here we need to give the data cells to get the data
//                echo '<pre>';
//                print_r($rowData);
//                exit;
                foreach ($rowData as $row) {
                    # $row[0] = roll_number
                    # $row[1] = course_id
                    # $row[2] = percentage
                    //getting the user_id by the roll_num
                    $sid = $this->student_model->get_student_id($row[0]);
                    if ($sid > 0) {
                        //dupilicate check and if count is more then dont enter the data in to db
                        $count = $this->marks_model->duplicate_check_marks($sid, $row[1], $row[2]);
                        if ($count == 0) {
                            $marks = array(
                                'uid' => $sid,
                                'cid' => $row[1],
                                'percentage' => $row[2],
                                'started_date' => $row[3],
                                'ended_date' => $row[4],
                                'remarks' => $row[5]
                            );
                            //sending data as a array to model to enter the data in to database 
                            $result = $this->marks_model->save_marks($marks);
                            $student_data = $this->student_model->get_student_details($sid);
                            $course_data = $this->course_model->get_course_details($row[1]);
                            $msg = "<h1>Marks of Student ".$student_data->full_name."in course ".$course_data->course_name. " is <strong>".$row[2]."%</strong>.</h1>";
                            $this->send_mail($msg,"MSIT JNTUH Marks List",$student_data->parent_email);
                        }
                    }
                }
                //after success then redirecting to certain page
                Redirect(base_url('marks/students_marks_list'));
            }
        }
    }

    function send_mail($message, $subject,$mail_to) {
        // include phpmailer class
        if (!class_exists("phpmailer")) {
            $this->load->file('./assets/mailer/class.phpmailer.php');
        }
        // creates object
        $mail = new PHPMailer(true);
        // HTML email ends here
        try {
            $mail->IsSMTP();
            $mail->isHTML(true);
            $mail->SMTPDebug = 0;
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = "non-ssl";
            $mail->Host = "mail.monkeycoderz.com";
            $mail->Port = 587;
            $mail->AddAddress($mail_to);
            $mail->Username = "msit@monkeycoderz.com";
            $mail->Password = "msit@2017";
            $mail->SetFrom('msit@monkeycoderz.com', 'MSIT JNTUH');
            $mail->AddReplyTo("msit@monkeycoderz.com", "MSIT JNTUH");
            $mail->Subject = $subject;
            $mail->Body = $message;
            //$mail->AltBody = $message;
            if ($mail->Send()) {
                echo "Success";
            }
        } catch (phpmailerException $ex) {
            print_r($ex->errorMessage());
        }
    }
}