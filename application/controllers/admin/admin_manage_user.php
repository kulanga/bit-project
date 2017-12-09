<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_manage_user extends MY_Controller {

	public function __construct() {
		parent::__construct();
        $this->set_topnav('manage_user');

        if($this->session->userdata('user_type_id') != 1 ) {
            die('Access Denied');
        }

        $this->load->library('form_validation');

        $this->load->model('user_model');
        $this->load->model('staff_model');
	}

    public function index() {
        $this->load->model('staff_model');
        $this->load->model('staff_designation_model');

        $data = array();
        $params = array(
        'keyword' => $this->input->get('keyword'),
        'desg' => $this->input->get('designation')
        );

        $data['list'] = $this->staff_model->get_stffs($params);
        $data['designations']=$this->staff_designation_model->get_disgnations_list();

        //print_r($data['designations']);die;
        $this->layout->view('/admin/manage_user/index', $data);
        
    }

	//create/edit accedmic user.
	public function create_staff($user_id = 0) {

        $this->load->model('staff_designation_model');


        $data = array();
        $data['designations'] = $this->staff_designation_model->get_disgnations_list();

		if ($this->input->server('REQUEST_METHOD') == 'POST') {

            $this->form_validation->set_rules('title', 'Title', 'trim|required|xss_clean');
            $this->form_validation->set_rules('full_name', 'Full Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('mobile_no', 'Mobile No', 'trim|required|xss_clean|numeric');
            $this->form_validation->set_rules('designation', 'Designation', 'trim|required|xss_clean|numeric');

            if($user_id <= 0) {
                $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email|is_unique[users.email]');
            }

            if($user_id > 0 ) {
                $this->form_validation->set_rules('status', 'Status', 'trim|required|xss_clean]');
            }

            if ($this->form_validation->run()) {
                $save_data['full_name'] = ucfirst($this->input->post('full_name'));
                $save_data['mobile_no'] = $this->input->post('mobile_no');

                $staff_data = array();
                $staff_data['title'] = $this->input->post('title');
                $staff_data['staff_designation_id'] = $this->input->post('designation');

                if($user_id > 0 ) {
                    $usr = $this->user_model->get($user_id);
                    //check user type before update

                    if($usr->user_type_id == 2) {

                        $staff_data['user_id'] = $user_id;
                        $save_data['status'] = $this->input->post('status');

                        $this->user_model->update($user_id, $save_data);
                        $this->staff_model->update_by_userid($user_id, $staff_data);

                        $this->session->set_flashdata('success_message', "update staff member has been successfully.");
                        redirect('/admin/staff');
                    }
                } else {

                    $save_data['user_type_id'] = 2;
                    $save_data['email'] = $this->input->post('email');
                    $save_data['username'] = $this->input->post('email');
                    $save_data['password'] = md5($this->input->post('password'));

                    $this->db->trans_start();
                    $this->db->trans_strict(true);

                    $user_id = $this->user_model->insert($save_data);
                    $staff_data['user_id'] = $user_id;

                    $this->staff_model->insert($staff_data);

                    if ($this->db->trans_status() === false) {
                        $this->db->trans_rollback();
                    } else {
                        $this->db->trans_commit();
                        $this->notify_to_user($user_id, $this->input->post('password'));

                        $this->session->set_flashdata('success_message', "New staff member has been successfully created.");
                        redirect('/admin/staff');
                    }
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
        $data['staff'] =  $this->staff_model->get_staff_profile($user_id, false);

        $this->layout->view('/admin/manage_user/edit_staff', $data);
    }

    public function edit_student($user_id) {

        $this->set_topnav('manage_student');

        $this->load->model('user_model');
        $this->load->model('student_model');
        $this->load->model('course_model');

        $user = $this->user_model->get($user_id);
        $student = $this->student_model->get_by_userid($user_id);
        //$student_course = $this->course_model->get($student->course_id);
        $courses = $this->course_model->get_course_list();


        $data = array();

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $this->form_validation->set_rules('full_name', 'Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('course_id', 'Batch', 'trim|required|xss_clean');
            $this->form_validation->set_rules('reg_no', 'Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('email', 'Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('phone', 'Name', 'trim|required|number|xss_clean');
            $this->form_validation->set_rules('status', 'Status', 'trim|required|xss_clean]');



            //print_r($_FILES);die;
            if ($this->form_validation->run() == true) {

                $user_data = array(
                    'full_name' => $this->input->post('full_name'),
                    'mobile_no' => $this->input->post('phone'),
                    'email' => $this->input->post('email'),
                    'status' => $this->input->post('status'),
                );

                $student_data = array(
                    'reg_no' => $this->input->post('reg_no'),
                    'course_id' => $this->input->post('course_id')
                );

                $this->user_model->update($user_id, $user_data);
                $this->student_model->update($student->id, $student_data);


                redirect('/admin/admin_manage_user/edit_student/'.$user_id);
            }
        }

        $data['student'] = $student;
        $data['user'] = $user;
        //$data['student_course'] = $student_course;
        $data['courses'] = $courses;
        $this->layout->view('/admin/manage_user/edit_student', $data);
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
        $data['full_page_layout'] = true;

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

    public function update_staff_status() {

        $user_id =  $this->input->post('id');
        $status = $this->input->post('status');

        $response = array('status' => 0);

        $data = array(
            'status' => $status
        );

        $this->load->model('user_model');
        $user = $this->user_model->get($user_id);

        if($user->user_type_id == '2') {
            $this->user_model->update($user_id, $data);
            $response['status'] = 1;
        }

        echo json_encode($response);exit;
    }

    private function notify_to_user($user_id, $plain_password) {

        $user = $this->user_model->get($user_id);
        $staff = $this->staff_model->get_staff_profile($user_id);

        $link = base_url() . 'login';

        $subject  = "Welcome to HNDE Students Portal";
        $message  = "<p>Dear " . $staff->title . ' ' . $user->full_name . '</p>';
        $message .= "<p>You have been added as a " . $staff->designation . " on HNDE Students Portal. Please use below credentials to Login.</p>";
        $message .= "<p>Username: " . $user->username ."<br/>Password: ".  $plain_password ."<br/>Url: <a href='$link'>$link</a><p/>";
        $message .= "<p>Please change your password as soon as logged in.</p>";
        $message .= "<p>If you have any question, please send an email to " . $this->config->item('admin_email') . ".</p>";

        return send_mail($user->email, $subject, $message);
    }
}