<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ReturnBook extends CI_Controller {

    /**
     * Default constructor
     */
    public function __construct() {
        parent::__construct();
        setUserContext($this);
        /////// Check user autherize to access any methods
        if ($this->session->userdata('is_admin') == "") {
            // Allow some methods?
            $allowed = array(
                'listbook', 'detail_book'
            );
            if (!in_array($this->router->fetch_method(), $allowed)) {
                redirect('authorize');
            }
        }
        /////////=====================================

        $this->load->helper('form');
        $this->load->library('form_validation');
        // $this->load->helper('date');
    }

    /**
     * Displays the borrow of books
     */
    public function index() {
        $data = getUserContext($this);
        $data['title'] = 'Books';
        $this->load->model('Return_model');
        // get borrowing books
        $data['borrowing'] = $this->Return_model->getBookBorrowed();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('books/return_book', $data);
        $this->load->view('templates/footer', $data);
    }

    // doing update table borrows to get book back
    public function getUpdate() {
        $id = $this->input->post('id');
        // get borrowing books
        $this->db->where('bor_id', $id);
        $this->db->join('users', 'borrows.users_id = users.id');
        $this->db->join('rules', 'rules.rul_id=borrows.rules_rul_id');
        $this->db->join('books', 'books.b_id=borrows.books_b_id');
        $data = $this->db->get('borrows')->result();
        // $data['condition'] = $this->db->get('conditions')->result();
        echo json_encode($data);
    }

    // updating table borrows to recorde returning book
    public function doUpdate() {
        $borId = $this->input->post('borrowId');
        $bId = $this->input->post('bookId');
        $comment = $this->input->post('comment');
        $restatus = $this->input->post('restatus');
        $checkin_date = date("Y-m-d");
        $data['bor_chechin_date'] = $checkin_date;
        $data['bor_comment'] = $comment;
        $data['bor_status'] = $restatus;

        // update table borrows to recorde returned
        $this->db->where('bor_id', $borId);
        $this->db->update('borrows', $data);

        // update status to unavailabe if return status broken 
        if ($restatus == 'Need repair') {
            $this->db->where('b_id', $bId);
            $this->db->update('books', array("sta_id" => 3, "con_id" => 3));
            redirect('ReturnBook');
        }
        // update status to vacant if return status Normal 
        else if ($restatus == 'New') {
            $this->db->where('b_id', $bId);
            $this->db->update('books', array("sta_id" => 1, 'con_id' => 1));
            redirect('ReturnBook');
        }
        // update status to vacant and condition to Need repair if return status Need repair 
        else {
            $this->db->where('b_id', $bId);
            $this->db->update('books', array("sta_id" => 1, "con_id" => 2));
            redirect('ReturnBook');
        }
    }

    public function send_mail() {
        $this->load->model('Return_model');
        $data = getUserContext($this);
        $data['title'] = 'Send mail';
        // get id of book to borrow
        $id = $this->uri->segment(3);
        $data['send'] = $this->Return_model->sendMail($id);
        $body = $this->load->view('emails/mailformat', $data, true);
        $address = $this->session->userdata('email');
        $recieveName = $this->session->userdata('name');
        $mailTitle = "Return book to library";
        $send = myEmail($address, $recieveName, $mailTitle, $body);
        if (!$send) {
            $this->session->set_flashdata('msg', "<p id='text-color-black'>The email cannot send</p>", 'danger');
            redirect('ReturnBook');
        } else {
            $this->session->set_flashdata('msg', "<p id='text-color-success'>The email has been sent to $recieveName.</p>", "success");
            redirect('ReturnBook');
        }
    }

}
