<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once APPPATH . 'third_party/PHPExcel.php';

class importExcel extends PHPExcel {

    function __construct($params = array()) {
        parent::__construct();
    }

}
