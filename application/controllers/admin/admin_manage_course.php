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
        $this->load->model('student_model');


        $params = array('status' => $this->input->get('status'));

        $list = $this->course_model->get_course_list($params);

        foreach($list as &$val) {
            $val->student_count = $this->student_model->get_student_count_bycourse($val->id);
        }

        $data['list'] = $list;
        $data['search_params']['status'] = $this->input->get('status');

       $this->layout->view('/admin/manage_course/index', $data);

    }

    public function save_course($course_id = 0) {
        $data = array();
        $this->load->model('course_model');
        $this->load->model('course_category_model');

        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            $this->load->helper(array('form'));

            if($course_id <= 0){
                $this->form_validation->set_rules('course_cat_id', 'Course Category ', 'trim|required|xss_clean');
            }

            $this->form_validation->set_rules('course_duration_years', 'Years in duration', 'trim|required|numeric|xss_clean');
            $this->form_validation->set_rules('course_duration_months', 'Months in duration', 'trim|required|numeric|xss_clean');
            $this->form_validation->set_rules('course_start_date', 'Course Start Date', 'trim|required|xss_clean');

            if($course_id > 0) {
                $this->form_validation->set_rules('current_semester_id', 'Current Semester', 'trim|required|xss_clean');
            }

            if ($this->form_validation->run() == true) {
                $course_cat = $this->course_category_model->get($this->input->post('course_cat_id'));

                $insert['course_category_id'] = $this->input->post('course_cat_id');
                $insert['duration'] = $this->input->post('course_duration_years') * 12 + $this->input->post('course_duration_months');

                $date_int = strtotime($this->input->post('course_start_date'));
                $insert['start_date'] =  date('Y-m-d', $date_int);

                $insert['current_semester_id'] = $this->input->post('current_semester_id');

                $course_year = date('Y', $date_int);
                if($course_id <= 0){
                    $insert['name'] = $course_cat->name  . '-' . $course_year;
                }
                if($course_id > 0 ) {
                    $this->course_model->update($course_id, $insert);
                } else {
                    //set course status as draft when creating a course.
                    $insert['status'] = 2;
                    $course_id = $this->course_model->insert($insert);
                }

                if($course_id > 0 ) {
                     redirect('/admin/course/edit/' . $course_id);
                }
            }
        }

        $data['course'] = $this->course_model->get($course_id);
        $data['course_category'] = $this->course_category_model->get_course_list();
        //print_r($data['course'] );die;

        $this->layout->view('admin/manage_course/create', $data);
    }

    public function edit($course_id) {

        $data = array();
        $this->load->model('course_model');
        $this->load->model('subject_model');
        $this->load->model('course_semester_model');

        $data['course'] = $this->course_model->get($course_id);
        $data['subjects'] = $this->subject_model->get_list();
        $data['course_semesters'] = $this->course_semester_model->get_by_course($course_id);
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

    public function remove_semster($semster_id) {
        $this->load->model('course_semester_model');
        $this->course_semester_model->delete($semster_id);
        echo '1';die;
    }

    public function remove_subject($subject_id) {
        $this->load->model('course_subject_model');
        $this->course_subject_model->delete($subject_id);
        echo '1';die;
    }

    public function settings($course_id) {
        $data = array();

        $this->load->model('course_model');
        $this->load->model('course_semester_model');

        $btn_save = $this->input->post('btn_save_settings');

        if(!empty($btn_save)) {
            $save_data = array();
            $save_data['current_semester_id'] = $this->input->post('current_semester_id');
            $save_data['status'] = $this->input->post('status');
            $this->course_model->update($course_id, $save_data);
            redirect('/admin/course');
        }

        $data['course'] = $this->course_model->get($course_id);
        $data['semesters'] = $this->course_semester_model->get_by_course($course_id);
        $this->layout->view('/admin/manage_course/course_settings', $data);
    }

}