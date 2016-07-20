<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_manage_timetable extends MY_Controller {

	public function __construct() {
		parent::__construct();
	}

    public function index() {
        
    }

    public function create() {
        $data = array();
        $this->render($data);
    }

}