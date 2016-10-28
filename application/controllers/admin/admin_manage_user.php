<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_manage_user extends MY_Controller {

	public function __construct() {
		parent::__construct();
        $this->set_topnav('manage_user');

        if($this->session->userdata('user_type_id') != 1 ) {
            die('Access Denied');
        }

        $this->load->library('form_validation');
	}

    public function index() {
        $this->load->model('staff_model');
        $data = array();
        $data['list'] = $this->staff_model->get_stffs();
        $this->layout->view('/admin/manage_user/index', $data);
    }


	//create/edit accedmic user.
	public function create_staff($user_id = 0) {

        $this->load->model('staff_designation_model');
        $this->load->model('user_model');
        $this->load->model('staff_model');

        $data = array();
        $data['designations'] = $this->staff_designation_model->get_disgnations_list();

		if ($this->input->server('REQUEST_METHOD') == 'POST') {
            
            $this->form_validation->set_rules('full_name', 'Full Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email');
            $this->form_validation->set_rules('mobile_no', 'Mobile No', 'trim|required|xss_clean|numeric');
            $this->form_validation->set_rules('designation', 'Designation', 'trim|required|xss_clean|numeric');

            if($user_id <= 0) {
                 $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email|is_unique[users.email]');
                $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|matches[confirm_password]');
                $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|xss_clean|');
            }

            if ($this->form_validation->run()) {
                $save_data['full_name'] = ucfirst($this->input->post('full_name'));
                $save_data['email'] = $this->input->post('email');
                $save_data['username'] = $this->input->post('email');
                $save_data['mobile_no'] = $this->input->post('mobile_no');

                $save_data['user_type_id'] = 2;
                
                $staff_data = array('staff_designation_id' => $this->input->post('designation'), 'user_id' => $user_id);

                if($user_id > 0 ) {
                    $this->user_model->update($user_id, $save_data);
                    $this->staff_model->update_by_userid($user_id, $staff_data);

                } else {
                    $save_data['password'] = md5($this->input->post('password'));
                    $user_id = $this->user_model->insert($save_data);
                    $this->staff_model->insert($staff_data);
                }

                redirect('/admin/staff/edit/' .  $user_id);
            }
        }
        
        $this->layout->view('/admin/manage_user/create_staff', $data);
	}

    public function edit_staff($user_id) {

        $this->load->model('staff_model');
        $this->load->model('staff_designation_model');

        $data = array();
        $data['designations'] = $this->staff_designation_model->get_disgnations_list();
        $data['staff'] =  $this->staff_model->get_staff_profile($user_id);
        $this->layout->view('/admin/manage_user/edit_staff', $data);
    }

    public function list_students() {
        $this->set_topnav('manage_student');
        $this->load->model('student_model');
        $this->load->model('course_model');
        $data = array();

      $data['courses'] = $this->course_model->get_course_list();

        $params = array(
            'keyword' => $this->input->get('keyword'),
            'batch_id' => $this->input->get('batch_id'),
            'user_status' => $this->input->get('user_status')
        );

        $data['students'] = $this->student_model->list_students($params);
        $data['search_params'] = $params;
        $this->layout->view('/admin/manage_user/list_students', $data);
    }

    public function update_user_status() {

        $user_id =  $this->input->post('id');
        $status = $this->input->post('status');

        $response = array('status' => 0);

        $data = array(
            'status' => $status
        );

        $this->load->model('user_model');
        $user = $this->user_model->get($user_id);

        if($user->user_type_id == '3') {
            $this->user_model->update($user_id, $data);
            $response['status'] = 1;
        }

        echo json_encode($response);exit;
    }
}