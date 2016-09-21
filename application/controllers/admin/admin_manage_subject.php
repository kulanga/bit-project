<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_manage_subject extends MY_Controller {

	public function __construct() {
		parent::__construct();
        $this->set_topnav('course');
	}

    public function index() {

        $this->load->model('subject_model');
        $data['list'] = $this->subject_model->get_list();
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
        
        $this->form_validation->set_rules('subject_name', 'Subject name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('subject_code', 'Subject code', 'trim|required|xss_clean');

        $subjet_id = $this->input->post('subject_id');

        $return = array('success' => 0);

        if ($this->form_validation->run() == true) {
            $save_data = array();
            $save_data['name'] = $this->input->post('subject_name');
            $save_data['code'] = $this->input->post('subject_code');

            $ret = false;
            if($subjet_id > 0 ) {
                $ret = $this->subject_model->update($subjet_id, $save_data);
                $return['action'] = 'update';
            } else {
                $ret = $this->subject_model->insert($save_data);
                $subjet_id = $ret;
                $return['action'] = 'insert';
            }
            
            if($ret) {
                $return['success'] = 1;
                $return['subject'] = $this->subject_model->get($subjet_id);
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