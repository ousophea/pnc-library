<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class BorrowBook extends CI_Controller {

    /**
     * Default constructor
     */
    public function __construct() {
        parent::__construct();
        setUserContext($this);
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('Borrow_model');
    }

    /**
     * Displays the borrow of books
     */
    public function index() {
        $this->session->unset_userdata('barcode');
        $data = getUserContext($this);
        $data['title'] = 'Books';
        $this->form_validation->set_rules('com_barcode', '', 'trim');
        
        if ($this->form_validation->run() == TRUE) {
                // get id of book to borrow
                $data['rule'] = $this->db->get('rules')->result();
                $barcode = $this->input->post('com_barcode');
                $data['gbarcode'] = $this->Borrow_model->compare_barcode($barcode);
        }
//        $result = $data['gbarcode'];
//         var_dump($result);exit();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('books/borrow', $data);
        $this->load->view('templates/footer', $data);
    }

    function borrowById() {
        $data = getUserContext($this);
        $data['title'] = 'Books';
        // get id of book to borrow
        $id = $this->uri->segment(3);
        $data['rule'] = $this->db->get('rules')->result();
        $data['gbarcode'] = $this->Borrow_model->compare_id($id);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('books/borrow', $data);
        $this->load->view('templates/footer', $data);
    }

    function insert_borrow() {
        $id = $this->input->post('bar_id');
        $ruleId = $this->input->post('ruleId');
        $numDay = $this->input->post('numDay');
        $userid = $this->session->userdata('id');
        $time_borrow = date("Y-m-d");
        $deatline = date('Y-m-d', strtotime(date('Y-m-d') . " + $numDay days"));
        // $time_returen =  ?
        $data = array(
            'bor_borrow_date' => $time_borrow,
            'books_b_id' => $id,
            'users_id' => $userid,
            'rules_rul_id' => $ruleId,
            'bor_return_date' => $deatline
        );
        $this->Borrow_model->insert_data_borrow($data);
    }

    /*
     * This function for show borrow list book of user
     */

    public function borrowlist() {
        $data = getUserContext($this);
        $data['title'] = 'Books';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->model('borrow_book_model');
        $data['borrow_info'] = $this->borrow_book_model->getBorrowlist();
        $this->load->view('users/borrow_list', $data);
        $this->load->view('templates/footer', $data);
    }

}
