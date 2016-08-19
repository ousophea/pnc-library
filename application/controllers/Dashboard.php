<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends CI_Controller {
	/**
	* Default constructor
   */
	public function __construct() {
		parent::__construct();
		setUserContext($this);
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('form_validation');$this->load->model('Dashboard_model');

	}
	/**
	* Displays the information books and users
   */
	public function index() {
		$data = getUserContext($this);
		$data['title'] = 'Books';
		$data['vacant'] = $this->Dashboard_model->book_vacant();
		$data['count_users'] = $this->Dashboard_model->countUsers();
		$data['count_books'] = $this->Dashboard_model->countBooks();
		$data['count_borrowing'] = $this->Dashboard_model->getBorrowing();
		$data['book_broken'] = $this->Dashboard_model->getCountBroken();
		// counting for each months
		$data['month1']=$this->Dashboard_model->month1();
		$data['month2']=$this->Dashboard_model->month2();
		$data['month3']=$this->Dashboard_model->month3();
		$data['month4']=$this->Dashboard_model->month4();
		$data['month5']=$this->Dashboard_model->month5();
		$data['month6']=$this->Dashboard_model->month6();
		$data['month7']=$this->Dashboard_model->month7();
		$data['month8']=$this->Dashboard_model->month8();
		$data['month9']=$this->Dashboard_model->month9();
		$data['month10']=$this->Dashboard_model->month10();
		$data['month11']=$this->Dashboard_model->month11();
		$data['month12']=$this->Dashboard_model->month12();
		// counting for return duration
			// for a month
		$data['intime_m']=$this->Dashboard_model->returnIntimeM();
		
		$data['ontime_m']=$this->Dashboard_model->returnOntimeM();
		$data['late_m']=$this->Dashboard_model->returnLateM();
		
			// for a year
		$data['intime_y']=$this->Dashboard_model->returnIntimeY();
		$data['ontime_y']=$this->Dashboard_model->returnOntimeY();
		$data['late_y']=$this->Dashboard_model->returnLateY();
		// counting for books are borrowed of each categories and month
		$data['cat_m1']=$this->Dashboard_model->categoriesMonth1();
		$data['cat_m2']=$this->Dashboard_model->categoriesMonth2();
		$data['cat_m3']=$this->Dashboard_model->categoriesMonth3();
		$data['cat_m4']=$this->Dashboard_model->categoriesMonth4();
		$data['cat_m5']=$this->Dashboard_model->categoriesMonth5();
		$data['cat_m6']=$this->Dashboard_model->categoriesMonth6();
		$data['cat_m7']=$this->Dashboard_model->categoriesMonth7();
		$data['cat_m8']=$this->Dashboard_model->categoriesMonth8();
		$data['cat_m9']=$this->Dashboard_model->categoriesMonth9();
		$data['cat_m10']=$this->Dashboard_model->categoriesMonth10();
		$data['cat_m11']=$this->Dashboard_model->categoriesMonth11();
		$data['cat_m12']=$this->Dashboard_model->categoriesMonth12();
		$data['mostBorrow']=$this->Dashboard_model->mostBorrow();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/menu', $data);
		$this->load->view('dashboard/dashboard', $data);
		$this->load->view('templates/footer', $data);	
	}
	/*
	* This function for display all borrowing book
	*/
	public function borrowing()
	{
		$data = getUserContext($this);
		$data['title'] = 'Books';
		$data['borrowing'] = $this->Dashboard_model->getBookborrowing();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/menu', $data);
		$this->load->view('dashboard/borrowing', $data);
		$this->load->view('templates/footer', $data);	
	}
	/*
	* This function for display all users in library
	*/
	public function usersInLibrary()
	{
		$data = getUserContext($this);
		$data['title'] = 'Books';
		$this->load->model('users_model');
		$data['users'] = $this->users_model->getUsers();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/menu', $data);
		$this->load->view('dashboard/users', $data);
		$this->load->view('templates/footer', $data);	
	}
	/*
	* This function for display all books in library
	*/
	public function allBookInLibrary()
	{
		$data = getUserContext($this);
		$data['title'] = 'Books';
		$this->load->model('books_model');
		$data['book_info']=$this->books_model->getBooks();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/menu', $data);
		$this->load->view('dashboard/all_books', $data);
		$this->load->view('templates/footer', $data);	
	}
	/*
	* This function for display all books vacant in library
	*/
	public function bookVacant()
	{
		$data = getUserContext($this);
		$data['title'] = 'Books';
		$data['book_info']=$this->Dashboard_model->getBookVacant();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/menu', $data);
		$this->load->view('dashboard/book_vacant', $data);
		$this->load->view('templates/footer', $data);	
	}
	/*
	* This function for display all books vacant in library
	*/
	public function bookBroken()
	{
		$data = getUserContext($this);
		$data['title'] = 'Books';

		$this->load->model('Borrow_book_model');
		$data['book_info']=$this->Dashboard_model->getBookBroken();
		$data['book_infos']=$this->Borrow_book_model->getBorrowlist();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/menu', $data);
		$this->load->view('dashboard/book_broken', $data);
		$this->load->view('templates/footer', $data);	
	}
	/*
	* This function for display all books vacant in library
	*/
	public function bookInStore()
	{
		$data = getUserContext($this);
		$data['title'] = 'Books';
		$data['book_info']=$this->Dashboard_model->getBookInstore();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/menu', $data);
		$this->load->view('dashboard/book_in_store', $data);
		$this->load->view('templates/footer', $data);	
	}
}