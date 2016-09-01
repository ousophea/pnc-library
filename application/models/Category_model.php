<?php

class Category_model extends CI_Model {
    /*
     * This function for get all categories and label
     */

    public function getCategories() {
        return $this->db->get('categories')->result();
    }

    /*
     * This function for get one row of category
     */

    public function getonerowCat($id) {
        $this->db->where('cat_id', $id);
        $query = $this->db->get('categories');
        return $query->row();
    }

    /*
     * This function for get check category name if exist
     */

    public function check_category($cname) {
        $this->db->where('cat_name', $cname);
        return $this->db->get('categories');
    }

    public function getCategoriesName() {
        $this->db->select('cat_id,cat_name');
        $this->db->from('categories');
        $data = $this->db->get();
        $db_array = array();
        if ($data->num_rows() > 0) { // put value into a array
            foreach ($data->result_array() as $row) {
                $db_array[$row['cat_id']] = $row['cat_name'];
            }
        }
        return $db_array; 
    }

}
