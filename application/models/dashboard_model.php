<?php
/**
 * This model contains all functions for managing books
 * @copyright  Copyright (c) 2016 rady y
 * @license    http://opensource.org/licenses/AGPL-3.0 AGPL-3.0
 * @since      0.1.0
 */
class Dashboard_model extends CI_Model {
	/**
     * Default constructor
     */
    // public function __construct() {
    // }
	/*
	* This function for count the users in system
	*/
	public function countUsers() {
		$this->db->select('count(id) as user');
        $this->db->from('users');
        return $query = $this->db->get()->result();
		
    }
    function book_vacant(){

		   $this->db->where('sta_id',1);
		   return $this->db->count_all_results('books');
		}
	/*
	* This function for count the books in library
	*/
	public function countBooks() {
		$this->db->select('count(b_id) as book');
        $this->db->from('books');
        return $query = $this->db->get()->result();
		
    }
	/*
	* This function for count all borrowing books in library
	*/
	public function getBorrowing(){
			$this->db->where('bor_chechin_date',null);
			return $this->db->count_all_results('borrows');
		}
	/*
	* This function for count broken books 
	*/
	public function getCountBroken() {
		$this->db->select('count(b_id) as broken');
		$this->db->where('sta_id=',3);
        return $this->db->count_all_results('books');
    }
   /*
   * This function for select are book borrowing
   */
   public function getBookborrowing()
   {
	   $this->db->select('*');
	   $this->db->from('borrows');
	   $this->db->join('books','borrows.books_b_id = books.b_id');
	   $this->db->join('status','books.sta_id = status.sta_id');
	   $this->db->join('categories','categories.cat_id = books.cat_id');
	   $this->db->where('bor_chechin_date',null);
	   return $query = $this->db->get()->result();
   }
   /*
    * This function for get all the books varcant in Library
	*/	
	public function getBookVacant() 
	{
		$this->db->select('*');
        $this->db->from('books'); 
        $this->db->join('status','books.sta_id = status.sta_id');  
		$this->db->join('categories','categories.cat_id = books.cat_id');
        $this->db->where('status.sta_id=',1);  
		$this->db->order_by('b_id','desc');
        $query = $this->db->get();
		return $query -> result();
    }
	/*
	* This function display all broken books 
	*/
	public function getBookBroken() {
		$this->db->select('*');
		$this->db->from('books');
		$this->db->join('status','books.sta_id = status.sta_id');  
		$this->db->join('categories','categories.cat_id = books.cat_id');
		$this->db->where('status.sta_id=',3);
		$query = $this->db->get();
		return $query -> result();
    } 
	/*
	* This function display all books in store 
	*/
	public function getBookInstore() {
		$this->db->select('*');
		$this->db->from('books');
		$this->db->join('status','books.sta_id = status.sta_id');  
		$this->db->join('categories','categories.cat_id = books.cat_id');
		$this->db->where('status.sta_id !=',2);
		$query = $this->db->get();
		return $query -> result();
    } 
    // counting for each months
	public function month1(){
		$this->db->where('MONTH(bor_borrow_date)', 1);
		$this->db->where('YEAR(bor_borrow_date)',date('y'));
		 return $this->db->count_all_results('borrows');
	}
	public function month2(){
		$this->db->where('MONTH(bor_borrow_date)', 2);
		$this->db->where('YEAR(bor_borrow_date)=',date('Y'));
		 return $this->db->count_all_results('borrows');
	}
	public function month3(){
		$this->db->where('MONTH(bor_borrow_date)', 3);
		$this->db->where('YEAR(bor_borrow_date)=',date('Y'));
		 return $this->db->count_all_results('borrows');
	}
	public function month4(){
		$this->db->where('MONTH(bor_borrow_date)', 4);
		$this->db->where('YEAR(bor_borrow_date)=',date('Y'));
		 return $this->db->count_all_results('borrows');
	}
	public function month5(){
		$this->db->where('MONTH(bor_borrow_date)', 5);
		$this->db->where('YEAR(bor_borrow_date)=',date('Y'));
		 return $this->db->count_all_results('borrows');
	}
	public function month6(){
		
		$this->db->where('MONTH(bor_borrow_date)', 6);
		$this->db->where('YEAR(bor_borrow_date)=',date('Y'));
		 return $this->db->count_all_results('borrows');
	}
	public function month7(){
		$this->db->where('MONTH(bor_borrow_date)', 7);
		$this->db->where('YEAR(bor_borrow_date)=',date('Y'));
		 return $this->db->count_all_results('borrows');
	}
	public function month8(){
		$this->db->where('MONTH(bor_borrow_date)', 8);
		$this->db->where('YEAR(bor_borrow_date)=',date('Y'));
		 return $this->db->count_all_results('borrows');
	}
	public function month9(){
		$this->db->where('MONTH(bor_borrow_date)', 9);
		$this->db->where('YEAR(bor_borrow_date)=',date('Y'));
		 return $this->db->count_all_results('borrows');
	}
	public function month10(){
		$this->db->where('MONTH(bor_borrow_date)', 10);
		$this->db->where('YEAR(bor_borrow_date)=',date('Y'));
		 return $this->db->count_all_results('borrows');
	}
	public function month11(){
		$this->db->where('MONTH(bor_borrow_date)', 11);
		$this->db->where('YEAR(bor_borrow_date)=',date('Y'));
		 return $this->db->count_all_results('borrows');
	}
	public function month12(){
		$this->db->where('MONTH(bor_borrow_date)', 12);
		$this->db->where('YEAR(bor_borrow_date)=',date('Y'));
		 return $this->db->count_all_results('borrows');
	}
	// duration to return the book
		// return in month----------------------------------//
	public function returnIntimeM(){
		return $this->db->query('select count(bor_id) as intime from borrows b where b.bor_chechin_date<b.bor_return_date and date_format(b.bor_borrow_date, "%m")= date_format(now(), "%m");')->row();
	}
	public function returnOntimeM(){
		return $this->db->query('select count(bor_id) as ontime from borrows b where b.bor_chechin_date=b.bor_return_date and date_format(b.bor_borrow_date, "%m")= date_format(now(), "%m");')->row();
	}
	public function returnLateM(){
		return $this->db->query('select count(bor_id) as late from borrows b where b.bor_chechin_date>b.bor_return_date and date_format(b.bor_borrow_date, "%m")=date_format(now(), "%m");')->row();
	}
		// -----------------------end month-----------------------//
		// return in year----------------------------------------//
	public function returnIntimeY(){
		return $this->db->query('select count(bor_id) as intimey from borrows b where b.bor_chechin_date<b.bor_return_date and date_format(b.bor_borrow_date, "%Y")= date_format(now(), "%Y");')->row();
	}
	public function returnOntimeY(){
		return $this->db->query('select count(bor_id) as ontimey from borrows b where b.bor_chechin_date = b.bor_return_date and date_format(b.bor_borrow_date, "%Y")= date_format(now(), "%Y");')->row();
	}
	public function returnLateY(){
		return $this->db->query('select count(bor_id) as latey from borrows b where b.bor_chechin_date>b.bor_return_date and date_format(b.bor_borrow_date, "%Y")= date_format(now(), "%Y");')->row();
	}
// get borrowed for each categories of each month
	public function categoriesMonth1(){
		return $this->db->query('select cat_name, count(bor_id) as total1 from borrows bor inner join books b on b.b_id=bor.books_b_id inner join categories cat on cat.cat_id=b.cat_id where date_format(bor.bor_borrow_date, "%m")=1 group by cat_name;')->result();
		
	}
	public function categoriesMonth2(){
		return $this->db->query('select cat_name, count(bor_id) as total2 from borrows bor inner join books b on b.b_id=bor.books_b_id inner join categories cat on cat.cat_id=b.cat_id where date_format(bor.bor_borrow_date, "%m")=2 group by cat_name;')->result();
	}
	public function categoriesMonth3(){
		return $this->db->query('select cat_name, count(bor_id) as total3 from borrows bor inner join books b on b.b_id=bor.books_b_id inner join categories cat on cat.cat_id=b.cat_id where date_format(bor.bor_borrow_date, "%m")=3 group by cat_name;')->result();
	}
	public function categoriesMonth4(){
		return $this->db->query('select cat_name, count(bor_id) as total4 from borrows bor inner join books b on b.b_id=bor.books_b_id inner join categories cat on cat.cat_id=b.cat_id where date_format(bor.bor_borrow_date, "%m")=4 group by cat_name;')->result();
	}
	public function categoriesMonth5(){
		return $this->db->query('select cat_name, count(bor_id) as total5 from borrows bor inner join books b on b.b_id=bor.books_b_id inner join categories cat on cat.cat_id=b.cat_id where date_format(bor.bor_borrow_date, "%m")=5 group by cat_name;')->result();
	}	
	public function categoriesMonth6(){
		return $this->db->query('select cat_name, count(bor_id) as total6 from borrows bor inner join books b on b.b_id=bor.books_b_id inner join categories cat on cat.cat_id=b.cat_id where date_format(bor.bor_borrow_date, "%m")=6 group by cat_name;')->result();
	}
	public function categoriesMonth7(){
		return $this->db->query('select cat_name, count(bor_id) as total7 from borrows bor inner join books b on b.b_id=bor.books_b_id inner join categories cat on cat.cat_id=b.cat_id where date_format(bor.bor_borrow_date, "%m")=7 group by cat_name;')->result();
	}
	public function categoriesMonth8(){
		return $this->db->query('select cat_name, count(bor_id) as total8 from borrows bor inner join books b on b.b_id=bor.books_b_id inner join categories cat on cat.cat_id=b.cat_id where date_format(bor.bor_borrow_date, "%m")=8 group by cat_name;')->result();
	}
	public function categoriesMonth9(){
		return $this->db->query('select cat_name, count(bor_id) as total9 from borrows bor inner join books b on b.b_id=bor.books_b_id inner join categories cat on cat.cat_id=b.cat_id where date_format(bor.bor_borrow_date, "%m")=9 group by cat_name;')->result();
	}
	public function categoriesMonth10(){
		return $this->db->query('select cat_name, count(bor_id) as total10 from borrows bor inner join books b on b.b_id=bor.books_b_id inner join categories cat on cat.cat_id=b.cat_id where date_format(bor.bor_borrow_date, "%m")=10 group by cat_name;')->result();
	}
	public function categoriesMonth11(){
		return $this->db->query('select cat_name, count(bor_id) as total11 from borrows bor inner join books b on b.b_id=bor.books_b_id inner join categories cat on cat.cat_id=b.cat_id where date_format(bor.bor_borrow_date, "%m")=11 group by cat_name;')->result();
	}
	public function categoriesMonth12(){
		return $this->db->query('select cat_name, count(bor_id) as total12 from borrows bor inner join books b on b.b_id=bor.books_b_id inner join categories cat on cat.cat_id=b.cat_id where date_format(bor.bor_borrow_date, "%m")=12 group by cat_name;')->result();
	}
	// most books are borrowed
	public function mostBorrow(){
		return $this->db->query('select b_title_en, b_title_kh,count("bor_id") as mostBorrow from borrows bor inner join books b on b.b_id=bor.books_b_id group by b.b_barcode order by mostBorrow desc limit 10;')->result();
	}
}

