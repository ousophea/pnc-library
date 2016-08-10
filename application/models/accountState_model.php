<?php 
	class AccountState_model extends CI_Model {

		function getBorrowing(){
			$this->db->where('bor_chechin_date',null);
			$this->db->where('users_id',$this->session->userdata('id'));
			return $this->db->count_all_results('borrows');
		}
		// counting number of borrowing
		function getAllBorrow(){
			$this->db->where('users_id',$this->session->userdata('id'));
			return $this->db->count_all_results('borrows');
		}
		function getLate(){
			$now = date('Y-m-d');
			$this->db->where('users_id',$this->session->userdata('id'));
			$this->db->where('bor_return_date<',$now);
			return $this->db->count_all_results('borrows');
		}
		function getReuturned(){
			$this->db->where('users_id',$this->session->userdata('id'));
			$this->db->where('bor_chechin_date!=','NUll');
			return $this->db->count_all_results('borrows');
		}
		// all data to view
		function allBorrows(){
			$this->db->select('*');
			$this->db->from('borrows');
			$this->db->join('books','books.b_id=borrows.books_b_id');
			$this->db->where('borrows.users_id',$this->session->userdata('id'));
			return $this->db->get()->result();
		}
		
	}