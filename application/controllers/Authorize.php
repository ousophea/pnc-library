<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Authorize extends CI_Controller {
    /*
     * Default constructor
     */

    public function __construct() {
        parent::__construct();
        setUserContext($this);
    }

    /*
     * Displays the list of books
     */

    public function index() {
        $data = getUserContext($this);
        $data['title'] = 'Not Allow';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('authorize/index', $data);
        $this->load->view('templates/footer', $data);
    }

}
