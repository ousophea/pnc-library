<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AddCategory_model extends CI_Model {

	 public function addCategory($data)
	 {
	 	 $this->db->insert("categories",$data);
	}

}