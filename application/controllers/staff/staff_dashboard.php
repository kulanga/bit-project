<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Staff_dashboard extends MY_Controller {

	public function __construct() {
		parent::__construct();
        $this->set_topnav('manage_timetable');
	}

    public function index() {
        $data = array();
        
        $this->layout->view('/staff/dashboard/index', $data);
    }
}