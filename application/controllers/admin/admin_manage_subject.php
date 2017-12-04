<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_manage_subject extends MY_Controller {

	public function __construct() {
		parent::__construct();
        $this->set_topnav('course');
	}

    public function index() {

        $this->load->model('subject_model');
        $this->load->model('course_category_model');
        $this->load->model('subject_category_model');
        $this->load->model('staff_subject_model');
        $this->load->model('staff_model');

        $data['list'] = $this->subject_model->get_list();
        $data['course_category'] = $this->course_category_model->get_course_list();
        $data['staff'] = $this->staff_model->get_stffs();

        $subject_list = $this->subject_model->get_list();

        foreach ($subject_list as &$subject) {
            $subject->category = $this->subject_category_model->get_by_subject($subject->id);
            $subject->staff = $this->staff_subject_model->get_by_subject($subject->id);
        }

        $data['list'] = $subject_list;
        $this->layout->view('/admin/manage_subject/index', $data);
    }

    public function create() {
        $data = array();
        $this->layout->view('/admin/manage_subject/create');
    }

    public function edit() {

    }

    public function save() {

        $this->load->model('subject_model');
        $this->load->library('form_validation');
        $this->load->model('subject_category_model');
        $this->load->model('staff_subject_model');

        $this->form_validation->set_rules('subject_name', 'Subject name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('subject_code', 'Subject code', 'trim|required|xss_clean');
        $this->form_validation->set_rules('course_cat[]', 'Course category', 'trim|required|xss_clean');
        $this->form_validation->set_rules('assigned_staff[]', 'Lecturer', 'trim|required|xss_clean');


        $subject_id = $this->input->post('subject_id');
        $return = array('success' => 0);

        if ($this->form_validation->run() == true) {
            $save_data = array();
            $save_data['name'] = $this->input->post('subject_name');
            $save_data['code'] = $this->input->post('subject_code');
            $save_subject_cat = $this->input->post('course_cat');
            $save_subject_staff = $this->input->post('assigned_staff');

            $ret = false;
            if($subject_id > 0 ) {
                $ret = $this->subject_model->update($subject_id, $save_data);
                $return['action'] = 'update';
            } else {
                $ret = $this->subject_model->insert($save_data);
                $subject_id = $ret;
                $return['action'] = 'insert';
            }

            //Delete existing before insert to avoid duplicates.
            $this->subject_category_model->delete($subject_id);

            //Save Subject Category.
            foreach ($save_subject_cat as $cat_id) {
                $sub_cat = array();
                $sub_cat['subject_id'] = $subject_id;
                $sub_cat['course_category_id'] = $cat_id;
                $this->subject_category_model->insert($sub_cat);
            }

            //Delete existing before insert to avoid duplicates.
            $this->staff_subject_model->delete($subject_id);

            //Save assigned staff.
            foreach($save_subject_staff as $staff_id) {
                $staff_subject = array();
                $staff_subject['staff_id'] = $staff_id;
                $staff_subject['subject_id'] = $subject_id;
                $this->staff_subject_model->insert($staff_subject);
            }

            if($ret) {
                $return['success'] = 1;
                $return['subject'] = $this->subject_model->get($subject_id);
            }

        } else {
            $return['errors'] = validation_errors();
        }

        echo json_encode($return);
        exit;
    }

    public function list_subjects() {

    }
}