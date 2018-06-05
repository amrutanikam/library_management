<?php

/**
 *
 * @author - Amruta Nikam
 * @created on - 03 Jun 2018
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Books extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('BookModel');
    }

    function index() {
                
        $result['book_list']=$this->BookModel->get_book_list();
        $this->load->view('issueBook', $result);
    }
    
    function issue_book() {
                
       $book_id = $this->input->post('id');  
       $issue_book_result =$this->BookModel->check_book_availability($book_id);
       if(count($issue_book_result) > 0){
            $issue_book_result = $this->BookModel->issue_book($book_id);
            if($issue_book_result){
                echo json_encode(array("message"=>"Book issued!"));
            }
        }else{
            $msg= "Book issued already!";
            echo json_encode(array("message"=>$msg));
        }
    }
    function return_book() {
                
        $book_id = $this->input->post('id');  
        $ret_book =$this->BookModel->return_book($book_id);
        if($ret_book){
            echo json_encode(array("message"=>"Book returned!"));
        }else{
              echo json_encode(array("message"=>"Try again later!"));
        }
        
    }
    
    

}
