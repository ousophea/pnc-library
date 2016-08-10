<?php
/**
 * This model contains all functions for managing books
 * @copyright  Copyright (c) 2016 rady y
 * @license    http://opensource.org/licenses/AGPL-3.0 AGPL-3.0
 * @since      0.1.0
 */
class Book_request_model extends CI_Model {
	/*
    * This function for request new books
	*/	
	public function requestNewBook(){

		$this->db->select('*');
        $this->db->from('books_request request'); 
	 	$this->db->join('status_request','request.re_status_re_id = status_request.status_re_id');
		$query = $this->db->get();
		return $query->result();
	}
	 function numberBooks(){
          return $this->db->count_all_results('books_request');
        }
	public function status_request()
	{
		return $this->db->get('status_request')->result();
	}
	
}