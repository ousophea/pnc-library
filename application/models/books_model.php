<?php

/**
 * This model contains all functions for managing books
 * @copyright  Copyright (c) 2016 rady y
 * @license    http://opensource.org/licenses/AGPL-3.0 AGPL-3.0
 * @since      0.1.0
 */
class Books_model extends CI_Model {
    /*
     * This function for get all the books
     */

    public function getBooks() {
//        $this->db->where('b.sta_id <>',4 ); // not select delect status
        $this->db->join('categories c', 'b.cat_id = c.cat_id');
        $this->db->join('status s', 'b.sta_id = s.sta_id');
        $this->db->join('conditions con', 'b.con_id = con.con_id');
        $this->db->join('users u', 'b.users_id = u.id');
        $this->db->order_by('b_create_date', 'desc');
        $query = $this->db->get('books b');
        return $query->result();
    }

    public function getBooksForExcel() {
        $this->db->select(
                'b_title_en as "Title",'
                . 'b_title_kh as "Titles in Khmer",'
                . 'b_author as "Author", '
                . 'b_author_kh as "Author(s) in Khmer",'
                . 'b_publisher as "Publisher",'
                . 'b_year as "Year",'
                . 'b_language as "Language",'
                . 'b_isbn as "ISBN",'
                . 'con_name as "Condition (New-Correct)",'
                . 'b_keyword as "Key Words (separeted by;)",'
                . 'cat_name as "Category name",'
                . 'cat.cat_id as "Category ID",'
                . 'b_label as "Label",'
                . 'b_barcode as "Barcode",'
                . 'b_comment as "Comment",'
                . 'b_edition as "Edition"');
        $this->db->from('books boo');
        $this->db->join('categories cat', 'boo.cat_id = cat.cat_id');
        $this->db->join('status sta', 'boo.sta_id = sta.sta_id');
        $this->db->join('conditions con', 'boo.con_id = con.con_id');
        $this->db->join('users use', 'boo.users_id = use.id');
        $query = $this->db->get();
        return $query;
    }

    /*
     * This function for edit the books
     */

    public function editBook($bookId) {
        $this->db->select('*');
        $this->db->join('categories', 'books.cat_id = categories.cat_id');
        $this->db->join('status', 'books.sta_id = status.sta_id');
        $this->db->where('b_id=', $bookId);
        return $this->db->get('books');
    }

    /*
     * This function for update books
     */

    public function updateBook($bookid, $datas) {
        $data = array(
            'b_title_en' => $this->input->post('title_en'),
            'b_title_kh' => $this->input->post('title_kh'),
            'b_language' => $this->input->post('language'),
            'b_barcode' => $this->input->post('barcode'),
            'b_author' => $this->input->post('authors'),
            'b_description' => $this->input->post('description'),
            'b_year' => $this->input->post('years'),
            'b_isbn' => $this->input->post('isbn'),
            'b_publisher' => $this->input->post('publisher'),
            'cat_id' => $this->input->post('categ_id'),
            'con_id' => $this->input->post('condition_id'),
            'sta_id' => $this->input->post('status_id'),
            'b_keyword' => $this->input->post('keyword'),
            'b_label' => $this->input->post('label'),
            'b_comment' => $this->input->post('comment')
        );
        $this->db->where('b_id', $bookid);
        return $this->db->update('books', $datas);
    }

    /**
     * This function for delete book
     * */
    public function deleteBook($bookId) {
        ////==========version 1
//        $this->db->where('b_id', $bookId);
//        $delete = $this->db->get('books')->row();
//        if ($delete->con_id == 3) {
//            $this->db->where('b_id', $bookId);
//            $this->db->delete('books');
//            $this->session->set_flashdata('msg', '<p id="upSuccess">The book has deleted</p>', 'success');
//            redirect('Books/index');
//        } else {
//            $this->session->set_flashdata('msg', '<p id="unSuccess">You cannot delete this book</p>', 'danger');
//            redirect('books/index');
//        }
        //==============
        $data = array(
            'sta_id' => 4 // update to delete status
        );
        $this->db->where('b_id', $bookId);
        $result = $this->db->update('books', $data);
        if ($result) {
            $this->session->set_flashdata('msg', '<p id="upSuccess">The book has deleted</p>', 'success');
        } else {
            $this->session->set_flashdata('msg', '<p id="unSuccess">You cannot delete this book</p>', 'danger');
        }
        redirect('Books/index');
    }

    /*
     * This function for get all the categories
     */

    function getCategory() {
        return $this->db->get('categories')->result();
    }

    /*
     * This function for get all condition
     */

    function getCondition() {
        return $this->db->get('conditions')->result();
    }

    /*
     * This function for get all status
     */

    function getStatus() {
        return $this->db->get('status')->result();
    }

    /*
     * This function ford checking barcode if exist
     */

    public function check_barcode($barcode) {
        $this->db->where('b_barcode', $barcode);
        return $this->db->get('books');
    }

    /*
     * This function for search all (global search in application)
     */

    function search($title, $keyword, $barcode, $category, $status) {
        $isSreached = FALSE;
        $this->db->select('*');
        $this->db->from('books bo');
        $this->db->join('categories', 'bo.cat_id = categories.cat_id');
        $this->db->join('status', 'bo.sta_id = status.sta_id');
        /*
         * This codition for  show category not exists 
         */
        if ($category == -1) {
            
        } else
            $this->db->where('categories.cat_id', $category);
        /*
         * This codition for  show khmer title not equal ''
         */
        if ($title != '') {
            $this->db->like('bo.b_title_kh', $title);
            $this->db->or_like('bo.b_title_en', $title);
            $isSreached = TRUE;
        }
        /*
         * This codition for  show english title not equal ''
         */
        if ($keyword != '') {
            if ($isSreached) {
                $this->db->or_like('bo.b_keyword', $keyword);
                $this->db->or_like('categories.categoryId', $keyword);
                $this->db->or_like('bo.b_label', $keyword);
            } else {
                $this->db->like('bo.b_keyword', $keyword);
                $this->db->or_like('categories.categoryId', $keyword);
                $this->db->or_like('bo.b_label', $keyword);
                $isSreached = TRUE;
            }
        }
        /*
         * This codition for  show barcode not equal ''
         */
        if ($barcode != '') {
            if ($isSreached) {
                $this->db->or_like('bo.b_barcode', $barcode);
            } else {
                $this->db->like('bo.b_barcode', $barcode);
                $isSreached = TRUE;
            }
        }
        if ($status != '') {
            if ($isSreached) {
                $this->db->or_like('status.sta_id', $status);
            } else {
                $this->db->like('status.sta_id', $status);
            }
        }
        /*
         * This code for geting value back.
         */
        $this->db->group_by('bo.b_id');
        $query = $this->db->get();
        return $query->result();
    }

    function detialBook($id) {
        $this->db->where('b_id', $id);
        $this->db->join('categories', 'books.cat_id = categories.cat_id');
        $this->db->join('status', 'books.sta_id = status.sta_id');
        $this->db->join('conditions', 'books.con_id = conditions.con_id');
        return $this->db->get('books')->result();
    }

    public function getBookCondition() {
        $this->db->select('con_id,con_name');
        $this->db->from('conditions');
        $data = $this->db->get();
        $db_array = array();
        if ($data->num_rows() > 0) { // put value into a array
            foreach ($data->result_array() as $row) {
                $db_array[$row['con_id']] = $row['con_name'];
            }
        }
        return $db_array;
    }

    public function getBarcodeList() {
        $this->db->select('b_id,b_barcode');
        $this->db->from('books');
        $data = $this->db->get();
        $db_array = array();
        if ($data->num_rows() > 0) { // put value into a array
            foreach ($data->result_array() as $row) {
                $db_array[$row['b_id']] = $row['b_barcode'];
            }
        }
        return $db_array;
    }

    public function importBook($data) {
        $this->db->insert_batch('books', $data);
    }

}
