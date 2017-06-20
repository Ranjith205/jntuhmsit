<?php
class Post_event extends CI_Controller{
    
    function __construct() {
        parent::__construct();
        $this->load->model("post_event_model");
    }
    
    function post_event(){
        $this->load->view('includes/header');
        $this->load->view('includes/left_nav');
        $this->load->view('post_event/post_event');
        $this->load->view('includes/quick_nav');
        $this->load->view('includes/footer');
    }
    
    function event_list(){
        $eventlist = $this->post_event_model->get_post_event();
        
        $this->load->view('includes/header');
        $this->load->view('includes/left_nav');
        $this->load->view('post_event/event_list',array('eventlist'=> $eventlist));
        $this->load->view('includes/quick_nav');
        $this->load->view('includes/footer');
    }
    
    function save_event(){
        $event = array(
            'title' => $_POST['title'],
            'description'=> $_POST['description'],
            'created_date'=> date('Y-m-d'),
            'event_date' => $_POST['event_date']
        );
        //sending data as a array to model to enter the data in to database 
        $result = $this->post_event_model->save_event($event);
        //handling the result which is from the model 
        if ($result){
            Redirect(base_url('post_event/event_list'));
        }else {
            echo "fail";
        }
        
    }
    
    function delete_event(){
        if (isset($_POST["bid"])){
            $this->post_event_model->delete_event_record($_POST["bid"]);
        }
        redirect(base_url('post_event/event_list'));
    }
    
    function edit_event(){
        if (isset($_POST["bid"])){
            $event_data = $this->post_event_model->get_event_details($_POST["bid"]);
            $this->load->view('includes/header');
            $this->load->view('includes/left_nav');
            $this->load->view('post_event/edit_post_event', array('event_data' => $event_data));
            $this->load->view('includes/quick_nav');
            $this->load->view('includes/footer');
        }
    }
    
    function update_event(){
        $event = array(
            'title' => $_POST['title'],
            'description'=> $_POST['description'],
            'event_date' => $_POST['event_date'],
            'bid' => $_POST['bid']
        );
        //sending data as a array to model to enter the data in to database 
        $result = $this->post_event_model->update_event($event);
        //handling the result which is from the model 
        if ($result){
            Redirect(base_url('post_event/event_list'));
        }else {
            Redirect(base_url('post_event/event_list'));
        }
    }
}