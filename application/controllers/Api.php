<?php
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}
class Api extends CI_Controller {
	/**
	* Default constructor
	* @author Benoit Pitet
	*/
		public function __construct() {
		parent::__construct();
	}
	/**
	* REST End Point : Display the list of 
	* @author Benoit Pitet
	*/
    public function getBooks() {
		$this->expires_now();
		header("Content-Type: application/json");
		// 		Fake data for now
		    $teams = [
		    '1' => "Book1",
		    '2' => "Book2",
		    ];
		echo json_encode($teams);
	}
	/**
	* Internal utility function
	* make sure a resource is reloaded every time
	*/
	private function expires_now() {
		//Date in the past
		header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		//always modified
		header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
		//HTTP/1.1
		header("Cache-Control: no-store, no-cache, must-revalidate");
		header("Cache-Control: post-check=0, pre-check=0", false);
		//HTTP/1.0
		header("Pragma: no-cache");
	}
}