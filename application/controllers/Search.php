<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Search extends CI_Controller {
    /**
    * Default constructor
    */
    public function __construct() {
        parent::__construct();
        setUserContext($this);
    }
    /**
    * Displays the search page
    */
    public function index() {
        $data = getUserContext($this);
        $data['title'] = 'Search Books';
        $this->load->model('Books_model');
        $this->load->helper('form');
        $data['category'] = $this->Books_model->getCategory();
        $data['datastatus'] = $this->Books_model->getStatus();
		    /*
			*  This code for get data from button search 
			*/
                $data['title'] = $this->input->post('title');
                $data['keyword'] = $this->input->post('keyword');
                $data['barcode'] =  $this->input->post('barcode');
                $data['categories'] = $this->input->post('category');
                $data['status'] = $this->input->post('status');
                $data['search'] = $this->Books_model->search($data['title'],$data['keyword'],$data['barcode'],$data['categories'],$data['status']);
				/*
				* This codition if result search not exists
				*/
                if(empty($data['search'])){
                    $data['search_index'] = 'No result!';
                }
                $this->load->view('templates/header', $data);
                $this->load->view('templates/menu', $data);
                $this->load->view('search/searchpage', $data);
                $this->load->view('templates/footer', $data);
            
            }
    }

