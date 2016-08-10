<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once APPPATH . 'third_party/Google/Service.php';

class G_Service extends Google_Service {
    function __construct($params = array()) {
        parent::__construct();
    }
}