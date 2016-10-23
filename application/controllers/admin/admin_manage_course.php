<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_manage_course extends MY_Controller {

    public $layout_view = 'layout/default';

	public function __construct() {
		parent::__construct();

        //check logged in user is a admin
        if($this->session->userdata('user_type_id') != 1 ) {
            die('Access Denied');
        }

        //set selected top nav
        $this->set_topnav('course');

        $this->load->library('form_validation');
	}

    public function index() {

        $data = array();
        $this->load->model('course_model');
        $data['list'] = $this->course_model->get_course_list();
        $this->layout->view('/admin/manage_course/index', $data);
    }

    public function save_course($course_id = 0) {
        $data = array();
        $this->load->model('course_model');
        
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            
            $this->load->helper(array('form'));
   
            $this->form_validation->set_rules('course_name', 'Course name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('course_code', 'Course code', 'trim|required|xss_clean');
            $this->form_validation->set_rules('ccourse_duration_years', 'Years', 'trim|numeric|xss_clean');
            $this->form_validation->set_rules('course_duration_months', 'Months', 'trim|numeric|xss_clean');
            $this->form_validation->set_rules('start_date', 'Start Date', 'trim|required|xss_clean');
    
            if ($this->form_validation->run() == true) {
                $insert['name'] = $this->input->post('course_name');
                $insert['code'] = $this->input->post('course_code');
                $insert['duration'] = $this->input->post('course_duration_years') * 12 + $this->input->post('course_duration_months');
                $insert['start_date'] =  $this->input->post('start_date');

                if($course_id > 0 ) {
                    $ret = $this->course_model->update($course_id, $insert);
                } else {
                    $ret = $this->course_model->insert($insert);
                }

                if($ret) {
                     redirect('/admin/course/edit/' . $ret);
                }
            }
        }

        $data['course'] = $this->course_model->get($course_id);
        //print_r($data['course'] );die;

        $this->layout->view('admin/manage_course/create', $data);
    }

    public function edit($course_id) {
       
        $data = array();
        $this->load->model('course_model');
        $this->load->model('subject_model');

        $data['course'] = $this->course_model->get($course_id);
        $data['subjects'] = $this->subject_model->get_list();

        $data['no_of_semesters'] =  5;
      
        $this->layout->view('/admin/manage_course/create', $data);
    }

    public function save_semster() {

        $response = array('success' => false, 'errors' => '');

        $this->form_validation->set_rules('semester_year', 'Year', 'trim|required|xss_clean');
        $this->form_validation->set_rules('semester_number', 'Semster', 'trim|required|xss_clean');
        $this->form_validation->set_rules('start_date', 'Start Date', 'trim|required|xss_clean');
        $this->form_validation->set_rules('course_id', 'Course id', 'trim|numeric|required|xss_clean');

        if ($this->form_validation->run() == true) {
            $save_data = array();
            $save_data['course_id'] = $this->input->post('course_id');
            $save_data['semester_year'] = $this->input->post('semester_year');
            $save_data['semester_number'] = $this->input->post('semester_number');
            $save_data['start_date'] = $this->input->post('start_date');
            $save_data['start_date'] = date('Y-m-d', strtotime($save_data['start_date']));

            $this->load->model('course_semester_model');
            $this->course_semester_model->insert($save_data);

            $response['success'] = true;
            $response['course_id'] = $save_data['course_id'];
        } else {
            $response['errors'] = validation_errors();
        }

        echo json_encode($response);
        exit;
    }

    public function get_semester_details($course_id) {

        $this->load->model('course_semester_model');
        $this->load->model('course_subject_model');

        $data = array();
        $data['semesters'] = $this->course_semester_model->get_by_course($course_id);

        foreach($data['semesters'] as &$semster) {
            $semster->subjects = $this->course_subject_model->get_by_semester($semster->id);
        }

        $this->load->view('/admin/manage_course/semster_details', $data);
    }

    public function add_subjects_to_semester() {

        $this->load->model('course_subject_model');
        $response = array('success' => false, 'errors' => '');
        
        $course_id = $this->input->post('subject_course_id');
        $semester_id = $this->input->post('subject_semester_id');
        $subjects = $this->input->post('subjects');

        if(is_array($subjects) && count($subjects) > 0 && $semester_id > 0 && $course_id > 0 ) {
            $subjects = array_unique($subjects);
            foreach ($subjects as $subject) {

                $save_data = array();

                $save_data['course_id'] = $course_id;
                $save_data['course_semester_id'] = $semester_id;
                $save_data['subject_id'] = $subject;

                //ignore if exist
                if(!$this->course_subject_model->check_exist($subject, $course_id, $semester_id)) {
                    $this->course_subject_model->insert($save_data);
                }

                $response['success'] = true;

            }
        } else {
            $response['errors'] = "Something went wrong. Please try again.";
        }

        echo json_encode($response);
        exit;
    }

}