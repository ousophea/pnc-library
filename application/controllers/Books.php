<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Books extends CI_Controller {
    /*
     * Default constructor
     */

    public function __construct() {
        parent::__construct();
        setUserContext($this);
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('books_model');
            /////// Check user autherize to access any methods
        if ($this->session->userdata('is_admin')=="") {
            // Allow some methods?
            $allowed = array(
                'listbook','detail_book'
            );
            if (!in_array($this->router->fetch_method(), $allowed)) {
                redirect('authorize');
            }
        }
          /////////=====================================
    }

    /*
     * Displays the list of books
     */

    public function index() {

        $data = getUserContext($this);
        $data['title'] = 'Books';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->model('books_model');
        $data['book_info'] = $this->books_model->getBooks();
        $this->load->view('books/index', $data);
        $this->load->view('templates/footer', $data);
    }

    /*
     * This function for add new book
     */

    public function add() {

        $data = getUserContext($this);
        $data['title'] = 'Add book';
        $this->load->model('Books_model');
        $data['cate_label'] = $this->Books_model->getCategory();
        $data['condition'] = $this->Books_model->getCondition();
        $data['status'] = $this->Books_model->getStatus();
        /*
         * This code to validate form insert books
         */
        $selectBooks = $this->input->post('bookTYpe');
        if ($selectBooks == 1) {
            $this->form_validation->set_rules('title_kh', 'Khmer title', 'min_length[3]|max_length[50]');
            $this->form_validation->set_rules('title_kh', 'Khmer title', 'min_length[3]|max_length[20]');
            $this->form_validation->set_rules('barcode', 'barcode', 'required|min_length[5]');
            $this->form_validation->set_rules('year', 'year', 'required|min_length[4]|max_length[4]|numeric');
            $this->form_validation->set_rules('authors', 'author', 'required|min_length[2]|max_length[15]');
            $this->form_validation->set_rules('publisher', 'publisher', 'required|min_length[2]|max_length[15]');
            $this->form_validation->set_rules('keyword', 'keyword', 'required|min_length[2]|max_length[100]');
            $this->form_validation->set_rules('label', 'label', 'required|min_length[2]|max_length[15]');
        } else if ($selectBooks == 2) {
            $this->form_validation->set_rules('title_kh', 'Khmer title', 'min_length[3]|max_length[50]');
            $this->form_validation->set_rules('title_kh', 'Khmer title', 'min_length[3]|max_length[20]');
            $this->form_validation->set_rules('barcode', 'barcode', 'min_length[5]');
            $this->form_validation->set_rules('year', 'year', 'min_length[4]|max_length[4]|numeric');
            $this->form_validation->set_rules('authors', 'author', 'min_length[2]|max_length[15]');
            $this->form_validation->set_rules('publisher', 'publisher', 'min_length[2]|max_length[15]');
            $this->form_validation->set_rules('keyword', 'keyword', 'min_length[2]|max_length[100]');
            $this->form_validation->set_rules('label', 'label', 'min_length[2]|max_length[15]');
        }
        /*
         * This codition for load view if false
         */
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/menu', $data);
            $this->load->model('books_model');
            $this->load->view('books/add', $data);
            $this->load->view('templates/footer', $data);
        } else {
            /*
             * This code mean the validation is true to do insert
             */
            $barcode = $this->input->post('barcode');
            $value = $this->input->post('bookTYpe');

            $surce['b_title_kh'] = trim($this->input->post('title_kh'), ' ');
            $surce['b_title_en'] = trim($this->input->post('title_en'), ' ');
            $surce['b_language'] = $this->input->post('language');
            $surce['b_barcode'] = trim($this->input->post('barcode'), ' ');
            $surce['b_author'] = trim($this->input->post('authors'), ' ');
            $surce['b_description'] = $this->input->post('description_en');
            $surce['b_year'] = trim($this->input->post('year'), ' ');
            $surce['b_isbn'] = trim($this->input->post('isbn'), ' ');
            $surce['b_publisher'] = $this->input->post('publisher');
            $surce['users_id'] = $this->session->userdata('id');
            $surce['cat_id'] = $this->input->post('categ_id');
            $surce['con_id'] = $this->input->post('condition_id');
            $surce['b_comment'] = $this->input->post('comment');
            $surce['b_keyword'] = $this->input->post('keyword');
            if ($value == 2) {
                $surce['b_label'] = '';
                $surce['sta_id'] = 1;
            } else {
                $surce['b_label'] = $this->input->post('label');
                $surce['sta_id'] = $this->input->post('status_id');
            }
            $check = $this->Books_model->check_barcode($barcode)->num_rows();
            if ($value == 1) {
                if ($check > 0) {
                    $this->session->set_flashdata('msg', '<p id="unSuccess">Unsuccess! This book has the same barcode</p>', 'success');
                    redirect('books/add');
                } else {
                    $this->db->insert('books', $surce);
                    $this->session->set_flashdata('msg', '<p id="upSuccess">You have success to insert</p>', 'success');
                    redirect('books/index');
                }
            } else {
                $this->db->insert('books', $surce);
                $this->session->set_flashdata('msg', '<p id="upSuccess">You have success to insert</p>', 'success');
                redirect('books/index');
            }
        }
    }

    /*
     * Edit an existing book
     * @param int $bookId identifier of the book
     */

    public function edit($bookId) {
        $data = getUserContext($this);
        $data['title'] = 'Edit a book';
        $data['bookid'] = $bookId;
        $data['category'] = $this->db->get('categories')->result();
        $data['status'] = $this->db->get('status')->result();
        $data['condition'] = $this->db->get('conditions')->result();
        if ($_POST) {
            $this->session->set_flashdata('msg', 'The book has been successfully to updated', 'success');
            redirect('books/');
        } else {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/menu', $data);
            $this->load->model('books_model');
            $data['edit_books'] = $this->books_model->editBook($bookId);
            $this->load->view('books/edit', $data);
            $this->load->view('templates/footer', $data);
        }
    }

    public function update($bookid) {
        $myvalue = $this->input->post('categ_id');
        $arr = explode(' ', trim($myvalue));

        $datas['b_title_en'] = $this->input->post('title_en');
        $datas['b_title_kh'] = $this->input->post('title_kh');
        $datas['b_language'] = $this->input->post('language');
        $datas['b_barcode'] = $this->input->post('barcode');
        $datas['b_author'] = $this->input->post('authors');
        $datas['b_description'] = $this->input->post('description');
        $datas['b_year'] = $this->input->post('years');
        $datas['b_isbn'] = $this->input->post('isbn');
        $datas['b_publisher'] = $this->input->post('publisher');
        $datas['cat_id'] = $arr[0];
        $datas['con_id'] = $this->input->post('condition_id');
        $datas['sta_id'] = $this->input->post('status_id');
        $datas['b_keyword'] = $this->input->post('keyword');
        $datas['b_label'] = $this->input->post('label');
        $datas['b_comment'] = $this->input->post('comment');
        $this->load->model('books_model');


        $success = $this->books_model->updateBook($bookid, $datas);
        if ($success) {
            $this->session->set_flashdata('msg', '<p id="upSuccess">This book has edited</p>', 'success');
            redirect('books/index');
        } else {
            $this->session->set_flashdata('msg', '<p id="unSuccess">Unsuccess! this book should not update</p>', 'danger');
            redirect('books/edit');
        }
    }

    /*
     * This function for delet books
     */

    public function delete($bookId) {
//        $this->load->model('books_model');
        $this->books_model->deleteBook($bookId);
    }

    /*
     * This function for list all book in library.
     */

    public function listbook() {
        $data = getUserContext($this);
        $data['title'] = 'Books';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->model('books_model');
        $data['book_info'] = $this->books_model->getBooks();
        $this->load->view('books/list_books', $data);
        $this->load->view('templates/footer', $data);
    }

    function detail_book() {
        $bid = $this->input->post('id');
        $this->load->model('Books_model');
        $get = $this->Books_model->detialBook($bid);
        echo json_encode($get);
    }

    function import_book() {
        $data = getUserContext($this);
        $data['title'] = 'Import book';
        $this->load->model(array('Books_model', 'category_model'));
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('books/import_book', $data);
        $this->load->view('templates/footer', $data);

        if (isset($_POST['btnImport'])) {
            $file = $_FILES['excelFile']['tmp_name'];
            $fileName = $_FILES['excelFile']['name'];
            if (empty($file)) {
                $this->session->set_flashdata('msg', '<p id="unSuccess">You must choose a file!!!</p>', 'danger');
                redirect('books/import_book');
            }
            if (!$this->IsExcel($fileName)) {
                $this->session->set_flashdata('msg', '<p id="unSuccess">You must choose a excel file to import!!!</p>', 'danger');
                redirect('books/import_book');
            }
            $excel_data = $this->readExcel($file);

//            echo $excel_data."Hello"; exit();
            if ($excel_data) {
                $this->session->set_flashdata('msg', '<p id="unSuccess">Can not add data to database...!</p>', 'danger');
            } else {
                $this->session->set_flashdata('msg', '<p id="Success">Data have add to database succefully...!</p>', 'alert-success');
            }

            redirect('books/importbookresult');
        }
    }

    function readExcel($file) {
        //get list cantegory name
        $catName = $this->category_model->getCategoriesName();
        $conditionName = $this->Books_model->getBookCondition();
        $barcodeList = $this->Books_model->getBarcodeList();

        $this->load->library('PHPExcel');
        $objectPHPExcel = PHPExcel_IOFactory::load($file);
        foreach ($objectPHPExcel->getWorksheetIterator() as $worksheet) {
            $highestRow = $worksheet->getHighestRow();
            $data = array(); // for multiple roow insert
            $dataDuplicat = array();
            $i = $countDuplicats = $counter = 0;
            for ($row = 2; $row <= $highestRow; $row++) {
                $title = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                $title_kh = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                $auther = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                $auther_kh = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                $publisher = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                $year = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                $language = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                $isbn = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                //replace name category by a id get from db;
                $condition = array_search($worksheet->getCellByColumnAndRow(8, $row)->getValue(), $conditionName);
                $keywords = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
                //replace name category by a id get from db
                $category_id = array_search($worksheet->getCellByColumnAndRow(10, $row)->getValue(), $catName);
                $label = $worksheet->getCellByColumnAndRow(12, $row)->getValue();
                $barcode = $worksheet->getCellByColumnAndRow(13, $row)->getValue();
                $comment = $worksheet->getCellByColumnAndRow(14, $row)->getValue();

                $setArray = array(
                    'b_title_en' => $title,
                    'b_title_kh' => $title_kh,
                    'b_author' => $auther,
                    'b_author_kh' => $auther_kh,
                    'b_publisher' => $publisher,
                    'b_year' => $year,
                    'b_language' => $language,
                    'b_isbn' => $isbn,
                    'con_id' => $condition,
                    'b_keyword' => $keywords,
                    'cat_id' => $category_id,
                    'sta_id' => 1,
                    'users_id' => $this->session->userdata('id'),
                    'b_label' => $label,
                    'b_barcode' => $barcode,
                    'b_comment' => $comment
                );
                if ($title != "" && $title_kh != "") {
                    if (array_search($barcode, $barcodeList) > 0) {
                        $countDuplicats++;
                        $dataDuplicat[$i] = $setArray;
                    } else {
                        $counter++;
                        $data[$i] = $setArray;
                    }
                }
                $i++;
            }
            $this->session->set_userdata('dataDuplicat', $dataDuplicat);
            $this->session->set_userdata('dataInserted', $data);

//            echo count($data);exit();
            if (count($data) > 0) {
                //insert books list to db
                $result = $this->Books_model->importBook($data);
                return $result;
//                return TRUE;
            }
            return FALSE;
            //End loop
        }
    }

    public function exportExcel() {
//        $this->load->library('iof_actory');
        $this->load->library('PHPExcel');
        $query = $this->books_model->getBooksForExcel();
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setTitle("export")->setDescription("none");

        $objPHPExcel->setActiveSheetIndex(0);
        $fileName = "Book_List_";
        // Field names in the first row
        $fields = $query->list_fields();
        $col = 0;
        foreach ($fields as $field) {
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, $field);
            $col++;
        }
        // Fetching the table data
        $row = 2;
        foreach ($query->result() as $data) {
            $col = 0;
            foreach ($fields as $field) {
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $data->$field);
                $col++;
            }
            $row++;
        }
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');

        // Sending headers to force the user to download the file
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $fileName . date('dMy') . '.xls"');
        header('Cache-Control: max-age=0');

        $objWriter->save('php://output');
    }

    public function IsExcel() {
        $fileName = explode(".", $_FILES['excelFile']['name']);
        $fileExtantion = $fileName[1];
        if ($fileExtantion == 'xlsx' || $fileExtantion == 'xls') {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function importbookresult() {
        $data = getUserContext($this);
        $data['title'] = 'Import book';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('books/importbookresult', $data);
        $this->load->view('templates/footer', $data);
    }

    function download_file() {
        $file_name = "Book1.xls";
        $this->load->helper('download');
        $data = file_get_contents(base_url() . 'books/' . $file_name); // Read the file's contents
        $name = $file_name;
        force_download($name, $data);
    }

    /// Use sample reader to get data from CSV file it note work with unicode value
    function import_book_csv_file() {
        $data = getUserContext($this);
        $data['title'] = 'Import book';
        $this->load->model(array('Books_model', 'category_model'));
        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu', $data);
        $this->load->view('books/import_book', $data);
        $this->load->view('templates/footer', $data);
        //get list cantegory name
        $catName = $this->category_model->getCategoriesName();
        $conditionName = $this->Books_model->getBookCondition();

        if (isset($_POST['btnImport'])) {

            if (!empty($_FILES['excelFile']['tmp_name'])) {
                $fileName = explode(".", $_FILES['excelFile']['name']);
                if ($fileName[1] == 'csv') {
//                    echo "Procecing!!!";
                    $file = $_FILES['excelFile']['tmp_name'];
                    $openFile = fopen($file, 'r');

                    $data = array(); // for multiple roow insert
                    $i = 0;
                    while ($dataFile = fgetcsv($openFile, 3000, ",")) {
                        if ($i > 0) {
                            $title = $dataFile[0];
                            $title_kh = $dataFile[1];
                            $auther = $dataFile[2];
                            $auther_kh = $dataFile[3];
                            $publisher = $dataFile[4];
                            $year = $dataFile[5];
                            $language = $dataFile[6];
                            $isbn = $dataFile[7];
                            $condition = array_search($dataFile[8], $conditionName); //replace name category by a id get from db;
                            $keywords = $dataFile[9];
                            $category_id = array_search($dataFile[10], $catName); //replace name category by a id get from db
                            $label = $dataFile[12];
                            $barcode = $dataFile[13];
                            $comment = $dataFile[14];

                            $data[$i] = array(
                                'b_title_en' => $title,
                                'b_title_kh' => $title_kh,
                                'b_author' => $auther,
                                'b_auther_kh' => $auther_kh,
                                'b_publisher' => $publisher,
                                'b_year' => $year,
                                'b_language' => $language,
                                'b_isbn' => $isbn,
                                'con_id' => $condition,
                                'b_keyword' => $keywords,
                                'cat_id' => $category_id,
                                'sta_id' => 1,
                                'users_id' => $this->session->userdata('id'),
                                'b_label' => $label,
                                'b_barcode' => $barcode,
                                'b_comment' => $comment
                            );
                        }
                        $i++;
                    }
//                    var_dump($data);
//                    exit();
                    $this->Books_model->importBook($data); // insert books list to db
                } else {
                    echo "You must choose a csv file to import!!!";
                }
            } else {
                echo " You must choose a file!!!";
            }
        }
    }

}
