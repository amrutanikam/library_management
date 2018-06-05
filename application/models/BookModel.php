<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class BookModel extends CI_Model{    

    function get_book_list(){
        $this->db->select("id, book_name, is_issued");
        $this->db->from('books_master');
        $this->db->where(array("is_deleted"=>0));
        $query = $this->db->get();
        if (0 < $query->num_rows()) {
            $data = $query->result_array();
            return (array) $data;
        } else {
            return array(); 
       }
    }
    
    function check_book_availability($book_id){
        $this->db->select("id,book_name");
        $this->db->from('books_master');
        $this->db->where(array("is_deleted"=>0,"id"=>$book_id, "is_issued"=>0));
        $query = $this->db->get();
        return $query->row_array();
    } 
    
    function return_book($book_id){
        $this->db->where(array("id"=>$book_id));
        $updateArray= array("is_issued"=>0, "modified_by"=>1, "modified_date"=>date("Y-m-d H:i:s"));
        $query = $this->db->update("books_master",$updateArray);
        return $query;
    } 
    function issue_book($book_id){
        $this->db->where(array("id"=>$book_id));
        $updateArray= array("is_issued"=>1, "modified_by"=>1, "modified_date"=>date("Y-m-d H:i:s"));
        $query = $this->db->update("books_master",$updateArray);
        return $query;
    } 
}

