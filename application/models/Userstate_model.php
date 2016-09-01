<?php
/**
 * This model contains all functions for managing users
 * @copyright  Copyright (c) 2016 Benoit Pitet
 * @license    http://opensource.org/licenses/AGPL-3.0 AGPL-3.0
 * @since      0.1.0
 */
class Userstate_model extends CI_Model {
    /**
     * Default constructor
     */
    public function __construct() {
    }
	/*
	* This function for get the user that borrow book
	*/
	public function getUsersborrowbook() {
		$this->db->select('id,firstname,bor_borrow_date,bor_return_date,
            bor_chechin_date, sum(bor_chechin_date is NULL) as count_borrowing, sum(bor_chechin_date!="NULL") as count_return');
        $this->db->from('users');
        $this->db->join('borrows','borrows.users_id = users.id');
        $this->db->group_by('users.id');
        return $query = $this->db->get()->result();
		
    }
}