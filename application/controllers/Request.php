<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Request extends CI_Controller {
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
                'requestBook', 'showAllrequest','index'
            );
            if (!in_array($this->router->fetch_method(), $allowed)) {
                redirect('authorize');
            }
        }
        /////////=====================================

		$this->load->model('Book_request_model');
	}
	/*
	* This function for display form request new book
	*/
	public function index() {
		$data = getUserContext($this);		
		$data['title'] = 'Home page';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/menu', $data);
		$data['numberRequest'] = $this->Book_request_model->numberBooks();
		$data['status'] = $this->Book_request_model->status_request();
		$this->load->view('books/book_request', $data);
		$this->load->view('templates/footer', $data);
	}
	/*
	* This function for display list all new books request for user
	*/
			// request book of user
		public function requestBook(){
			$data = getUserContext($this);
			$data['title'] = 'Request Book';

			$this->form_validation->set_rules('description_en', 'description', 'required');
				
				if ($this->form_validation->run()==false) {

				$this->load->view('templates/header', $data);
				$this->load->view('templates/menu', $data);
				$this->load->view('books/book_request', $data);
				$this->load->view('templates/footer', $data);
			}else{
				$soure['re_title_en']=$this->input->post('title_en');
				$soure['re_title_kh']=$this->input->post('title_kh');
				$soure['re_description']=$this->input->post('description_en');
				$soure['re_author']=$this->input->post('authors');
				$soure['re_language']=$this->input->post('language');
				$soure['re_user_id']= $this->session->userdata('id');
				$soure['re_status_re_id']=1;
				if ($data) {
					$this->db->insert('books_request',$soure);
					$this->session->set_flashdata('msg', '<p id="upSuccess">Your request has sent </p>','success');
					redirect('Request/showAllrequest');
				}else{
					$this->session->set_flashdata('msg', '<p id="unSuccess">Your request cannot send</p>','danger');
					redirect('Request/index');
				}
		
			}
	}
	function showAllrequest(){
		$data = getUserContext($this);		
		$data['title'] = 'Request BOOK';
		$data['request'] = $this->Book_request_model->requestNewBook();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/menu', $data);
		$this->load->view('books/list_book_request', $data);
		$this->load->view('templates/footer', $data);
	}
	function updateagreeBook(){
		$requestid = $this->input->post('requestId');
		$reqiesttype = $this->input->post('requestType');
		$comment = $this->input->post('comment');

		$this->db->where('re_id',$requestid);
		$data = $this->db->update('books_request',array('re_comment'=>$comment,'re_status_re_id'=>$reqiesttype));
		if($data){
			$this->session->set_flashdata('msg', '<p id="upSuccess">Your status are change </p>','success');
			redirect('Request/showAllrequest');
		}
	}
	
}