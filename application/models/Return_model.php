<?php 
class Return_model extends CI_Model {
	public function getBookBorrowed(){
	$this->db->select('*');
        $this->db->from('borrows'); 
        $this->db->join('users','borrows.users_id = users.id');
        $this->db->join('books','books.b_id=borrows.books_b_id');
        $this->db->join('conditions','books.con_id=conditions.con_id');
        $this->db->join('status','status.sta_id=books.sta_id');
        $this->db->join('rules','rules.rul_id=borrows.rules_rul_id');
         $this->db->where('bor_chechin_date=',null);
        return $this->db->get()->result();
	}
        public function getUpdateStatus($id){
            $this->db->query("select * from books bo
            inner join borrows b on bo.b_id=b.books_b_id
            inner join status s on s.sta_id=bo.sta_id
            where bor_id=$id");
        }
        public function sendMail($id){
            $this->db->select('*')
                     ->from('borrows')
                     ->join('users','borrows.users_id = users.id')
                     ->join('books','borrows.books_b_id = books.b_id')
                     ->where('bor_id',$id);
            return $this->db->get()->result();
        }

}