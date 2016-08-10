<?php
/**
 * This model contains all functions for managing books
 * @copyright  Copyright (c) 2016 rady y
 * @license    http://opensource.org/licenses/AGPL-3.0 AGPL-3.0
 * @since      0.1.0
 */
class Borrow_book_model extends CI_Model {
	/*
    * This function for get all borrows books
	*/	
	public function getBorrowlist() {
		$this->db->select('id,b_barcode,b_title_kh,b_title_en,bor_comment,bor_borrow_date,bor_chechin_date,bor_return_date,con_name');
        $this->db->from('borrows'); 
        $this->db->join('books','books.b_id = borrows.books_b_id');   
       $this->db->join('conditions','books.con_id = conditions.con_id');  
        $this->db->join('users','borrows.users_id = users.id');  
		$this->db->order_by('b_id','desc');
        $query = $this->db->get();
		return $query -> result();
    }
}