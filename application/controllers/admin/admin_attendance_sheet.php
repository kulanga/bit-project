<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_attendance_sheet extends MY_Controller {

    public $layout_view = 'layout/default';

	public function __construct() {
		parent::__construct();
        $this->set_topnav('attendance_sheet');

        if(!in_array($this->session->userdata('user_type_id'), array(1,2))) {
            die('Access Denied');
        }

        $this->load->library('form_validation');
	}

    public function search() {
        $this->load->model('course_model');

        $data = array();
        $data['courses'] = $this->course_model->get_course_list(array('status' => 1));

        $this->layout->view('/admin/attendance_sheet/search', $data);
    }

    public function printview() {

        $course_id = $this->input->post('batch_id');
        $subject_id = $this->input->post('subject_id');

        $this->load->model('student_model');
        $this->load->model('subject_model');
        $this->load->model('course_model');
        $this->load->model('course_semester_model');

        $subject = null;
        if($subject_id > 0 ) {
            $subject = $this->subject_model->get($subject_id);
        }

        $students = $this->student_model->list_students(array('batch_id' => $course_id));
        $course = $this->course_model->get($course_id);
        $semester = $this->course_semester_model->get($course->current_semester_id);

        $data['students'] = $students;
        $data['subject'] = $subject;
        $data['course'] = $course;
        $data['semester'] = $semester;

        $this->load->view('/admin/attendance_sheet/printview', $data);
    }



}