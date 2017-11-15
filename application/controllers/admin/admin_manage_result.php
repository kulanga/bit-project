<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_manage_result extends MY_Controller {

	public function __construct() {
		parent::__construct();
        $this->set_topnav('manage_result');

        if($this->session->userdata('user_type_id') != 1 ) {
            die('Access Denied');
        }

        $this->load->library('form_validation');
	}

    public function index() {
        
    }

    public function import_result() {
        
    }

}