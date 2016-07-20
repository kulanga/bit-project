<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_manage_course extends MY_Controller {

	public function __construct() {
		parent::__construct();
	}

    public function index() {
        
    }

    public function create() {
        $data = array();
        $this->render($data);
    }

    public function edit($course_id) {
        $data = array();

        $data['no_of_semesters'] =  5;
        $data['semsters'] = array(array('id' => 1, ));
        $this->render($data);
    }

    public function list_courses() {

    }

    public function save_subject() {

        $success = 0;

        $semester_id = $this->input->post('semester_id');
        $subject_id = $this->input->post('subject_id');
        $subject_code = $this->input->post('subject_code');
        $subject_name = $this->input->post('subject_name');

        

        $success = 1;
        echo json_encode(array('success' => $success));
    }



    

}