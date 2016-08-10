<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Account extends CI_Controller {
	/**
	* Default constructor
	*/
	public function __construct() {
		parent::__construct();
		setUserContext($this);
		$this->load->model('AccountState_model');
	}
	/*
	* This function for show account of user and adminstrator.
	*/
	public function index() {
		$data = getUserContext($this);		
		$data['title'] = 'Home page';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/menu', $data);
		$this->load->view('account/index', $data);
		$this->load->view('templates/footer', $data);
	}
	/*
	* This function for show account state
	*/
	public function accountState()
	{
		$data = getUserContext($this);		
		$data['title'] = 'Home page';
		$data['borrwing'] = $this->AccountState_model->getBorrowing();
		$data['allBorrow'] = $this->AccountState_model->getAllBorrow();
		$data['late'] = $this->AccountState_model->getLate();
		$data['returned'] = $this->AccountState_model->getReuturned();
		$data['allBorrows'] = $this->AccountState_model->allBorrows();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/menu', $data);
		$this->load->view('account/acount_state', $data);
		$this->load->view('templates/footer', $data);
	}
}