<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Bookcategory extends CI_Controller {
    /*
     * Default constructor 
     */

    public function __construct() {
        parent::__construct();
        setUserContext($this);
        if ($this->session->userdata('is_admin') == "") {
            redirect('authorize');
            // Allow some methods?
//            $allowed = array(
//                'listbook', 'detail_book'
//            );
//            if (!in_array($this->router->fetch_method(), $allowed)) {
//                redirect('authorize');
//            }
        }

        $this->load->model('Category_model');
        $this->load->library('form_validation');
    }

    // managing labels
    public function index() {
        $data = getUserContext($this);
        $data['title'] = 'Book Category';
        $data['result'] = $this->Category_model->getCategories();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('bookcategory/index', $data);
        $this->load->view('templates/footer', $data);
    }

    /*
     * This function for add categories
     * get label name
     * valiation form
     */

    public function addcategory() {
        $data = getUserContext($this);
        $data['title'] = 'Book Category';
        $this->form_validation->set_rules('catname', 'category', 'required|min_length[3]|max_length[100]');
        $this->form_validation->set_rules('categoryid', 'category Id', 'required|min_length[3]|max_length[25]');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/menu', $data);
            $this->load->view('bookcategory/add_category', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $cname = trim($this->input->post('catname'), ' ');
            $comment = trim($this->input->post('comment'), ' ');
            $categoryid = trim($this->input->post('categoryid'), ' ');
            $data = array(
                'cat_name' => $cname,
                'categoryId' => $categoryid,
                'cat_comment' => $comment
            );
            /*
             * check name category if exist
             */
            $check = $this->Category_model->check_category($cname)->num_rows();
            /*
             * This condition set message to flushdata
             */
            if ($check > 0) {
                $this->session->set_flashdata('msg', '<p id="unSuccess" class="text-center">Unsuccess! this category is exist</p>', 'danger');
                redirect("BookCategory/addcategory");
            } else {
                $this->db->insert('categories', $data);
                $this->session->set_flashdata('msg', '<p id="upSuccess" class="text-center">You have success to insert</p>', 'success');
                redirect('BookCategory/index');
            }
        }
    }

    /*
     * This function for select value to form edit
     */

    public function edit($id) {
        $data = getUserContext($this);
        $data['title'] = 'Book Category';
        $row = $this->Category_model->getonerowCat($id);
        $data['result'] = $row;
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('bookcategory/edit_category', $data);
        $this->load->view('templates/footer', $data);
    }

    /*
     * This function for update category
     */

    public function update() {
        $id = $this->input->post('id');
        $data = array(
            'cat_name' => trim($this->input->post('catname'), ' '),
            'categoryId' => $this->input->post('categoryid'),
            'cat_comment' => trim($this->input->post('comment'), ' '),
        );
        $this->db->where('cat_id', $id);
        $doUpdate = $this->db->update('categories', $data);
        /*
         * This codition for show message update success
         */
        if ($doUpdate) {
            $this->session->set_flashdata('msg', '<p id="upSuccess">You have updated successful</p>', 'success');
            redirect("BookCategory/index");
        } else {
            /*
             * This code for show message not update
             */
            $this->session->set_flashdata('msg', '<p id="unSuccess">You have not updated!</p>', 'danger');
            redirect("BookCategory/edit");
        }
    }

    /*
     * This function for delete category
     */

    public function delete() {
        $catid = $this->uri->segment(3);
        /*
         * This code to compare category id in table books if exist cannot delete
         */
        $this->db->where('cat_id', $catid);
        $comId = $this->db->get('books')->num_rows();
        if ($comId > 0) {
            $this->session->set_flashdata('msg', '<p id="unSuccess">You cannot delete this category! It stored book(s).</p>', 'danger');
        } else {
            $id = $this->db->where('cat_id', $catid);
            $this->db->delete('categories', $id);
            $this->session->set_flashdata('msg', '<p id="upSuccess">You have deleted successful</p>', 'success');
        }
        redirect("BookCategory/index");
    }

}
