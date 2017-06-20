<?php

class Download_excel extends CI_Controller {

    function __construct() {
        parent::__construct();
         $this->load->library('excel');
         
    }

    function download_student_upload() {
        $this->excel->getActiveSheet()->setCellValue('A1', 'Roll Number');
        $this->excel->getActiveSheet()->setCellValue('B1', 'Academic Year');
        $this->excel->getActiveSheet()->setCellValue('C1', 'Student Full Name');
        $this->excel->getActiveSheet()->setCellValue('D1', 'Student email');
        $this->excel->getActiveSheet()->setCellValue('E1', 'mobile');
        $this->excel->getActiveSheet()->setCellValue('F1', 'password');
        $this->excel->getActiveSheet()->setCellValue('G1', 'Parent Full Name');
        $this->excel->getActiveSheet()->setCellValue('H1', 'Parent Mobile Number');
        $this->excel->getActiveSheet()->setCellValue('I1', 'Parent Email');

        $filename = 'StudentUploadExcel.xlsx'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
        $objWriter->save('php://output');
    }
    
    function download_course_upload() {
        $this->excel->getActiveSheet()->setCellValue('A1', 'Roll Number');
        $this->excel->getActiveSheet()->setCellValue('B1', 'Academic Year');
        $this->excel->getActiveSheet()->setCellValue('C1', 'Student Full Name');
        $this->excel->getActiveSheet()->setCellValue('D1', 'Student email');
        $this->excel->getActiveSheet()->setCellValue('E1', 'mobile');
        $this->excel->getActiveSheet()->setCellValue('F1', 'password');
        $this->excel->getActiveSheet()->setCellValue('G1', 'Parent Full Name');
        $this->excel->getActiveSheet()->setCellValue('H1', 'Parent Mobile Number');
        $this->excel->getActiveSheet()->setCellValue('I1', 'Parent Email');

        $filename = 'StudentUploadExcel.xlsx'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
        $objWriter->save('php://output');
    }
    
}