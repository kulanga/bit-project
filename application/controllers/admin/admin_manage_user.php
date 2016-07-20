<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_manage_user extends MY_Controller {

	public function __construct() {
		parent::__construct();
	}

    public function create_staff() {
        $data = array();
        
        $this->render($data);
    }

	//create/edit accedmic user.
	public function staff($id = 0) {

        $this->load->model('staff_designation_model');

        $data = array();

        $data['designations'] = $this->staff_designation_model->get_disgnations_list();

		if($id > 0 ) {
			$this->load->model('');
		}

		$this->render($data);
	}


}