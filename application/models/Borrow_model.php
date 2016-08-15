<?php

class Borrow_model extends CI_Model {

    function compare_barcode($barcode) {
        // copare barcode when input barcode
        $this->db->select('*');
        $this->db->from('books bo');
        $this->db->join('categories', 'bo.cat_id = categories.cat_id');
        $this->db->join('status', 'bo.sta_id = status.sta_id');
        $this->db->where('b_barcode', $barcode);
        $query = $this->db->get();
        return $query->result();
    }

    function compare_id($id) {
        // compare id when click borrow from button search
        $this->db->select('*');
        $this->db->from('books bo');
        $this->db->join('categories', 'bo.cat_id = categories.cat_id');
        $this->db->join('status', 'bo.sta_id = status.sta_id');
        $this->db->where('b_id', $id);
        $query = $this->db->get();
        return $query->result();
    }

    function insert_data_borrow($data) {
        // check user have or not
        $this->db->where(array('bor_chechin_date' => NULL, 'users_id' => $data['users_id']));
        $check = $this->db->get('Borrows')->result();
        // check this book booked or not
        $this->db->where(array('bor_chechin_date' => NULL, 'books_b_id' => $data['books_b_id']));
        $checkbook = $this->db->get('Borrows')->result();
        if ($check) {
            $this->session->set_flashdata('msg', '<p id="text-color-black">Please return book before you borrow new book.</p>', 'danger');
            redirect('BorrowBook/index');
        } else if ($checkbook) {
            $this->session->set_flashdata('msg', '<p id="text-color-black">This Book is booked.</p>', 'danger');
            redirect('BorrowBook/index');
        } else {
            $this->db->insert('borrows', $data);

            $this->session->set_flashdata('msg', '<p id="text-color-success">You are successful to borrow.</p>', 'success');
            // update status after borrowing
            $this->db->where('b_id', $data['books_b_id']);
            $this->db->update('books', array('sta_id' => 2));
            redirect('BorrowBook/index');
        }
    }

}
