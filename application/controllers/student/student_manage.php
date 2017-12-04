<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Student_manage extends MY_Controller {

	public function __construct() {
		parent::__construct();
        $this->set_topnav('assignment');

        //check logged in user is a student
        if($this->session->userdata('user_type_id') != 3 ) {
            die('Access Denied');
        }

        $this->load->library('form_validation');

        $this->load->model('user_model');
        $this->load->model('student_model');
        $this->load->model('course_model');

	}

    public function edit_profile() {

        $user_id = $this->session->userdata('user_id');

        $user = $this->user_model->get($user_id);
        $student = $this->student_model->get_by_userid($user_id);
        $course = $this->course_model->get($student->course_id);

        $data = array();

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $this->form_validation->set_rules('full_name', 'Name', 'trim|required|xss_clean');

            $has_profile_image = false;
            if(!empty($_FILES['profile_image']['name'])) {
                $this->form_validation->set_rules('profile_image', 'Profile Piture', 'callback_check_upload');
                $has_profile_image = true;
            }

            //print_r($_FILES);die;
            if ($this->form_validation->run() == true) {

                $img = '';
                if($has_profile_image) {
                    $img = $this->save_profile_image();
                }

                $user_data = array(
                    'full_name' => $this->input->post('full_name'),
                );

                if(!empty($img)) {
                    $user_data['profile_image'] = $img;
                }

                $this->user_model->update($user_id, $user_data);

                redirect('/student/student_manage/edit_profile');
            }
        }

        $data['student'] = $student;
        $data['user'] = $user;
        $data['course'] = $course;
        $this->layout->view('/student/manage/edit_profile', $data);
    }

    public function change_password() {

        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            $this->form_validation->set_rules('current_password', 'Current Password', 'trim|required|xss_clean|callback_check_password');
            $this->form_validation->set_rules('new_password', 'New Password', 'trim|required|xss_clean');
            $this->form_validation->set_rules('confirm_new_password', 'Re-enter', 'required|matches[new_password]');

            if($this->form_validation->run() == true) {
                $user_id = $this->session->userdata('user_id');
                $password = md5($this->input->post('new_password'));
                $this->user_model->update($user_id, array('password' => $password));
            }
        }
        $this->layout->view('/student/manage/change_password');
    }

    function check_upload() {
         if(!empty($_FILES['profile_image']['name'])) {
            $file_ext = pathinfo($_FILES['profile_image']['name'], PATHINFO_EXTENSION);

            $expensions = array("jpg", "png", 'jpeg');

            if(!in_array($file_ext, $expensions)) {
                $this->form_validation->set_message('check_upload', 'Extension not allowed.');
                return false;
            }

            if($_FILES['profile_image']['size'] > 2097152) {
                $this->form_validation->set_message('check_upload', 'File size must be excately 2 MB');
                return false;
            }
        }
        return true;
    }

    function check_password($password) {
        $username = $this->session->userdata('username');
        $result = $this->user_model->login($username, $password);

        if (!$result) {
            $this->form_validation->set_message('check_password', 'Incorrect current password');
            return false;
        }
        return true;
    }

    private function save_profile_image() {
        $stu_user_id = $this->session->userdata('user_id');

         $new_filename = $original_file_name = '';

        if(!empty($_FILES['profile_image']['name'])) {
            $file_name = $_FILES['profile_image']['name'];
            $file_size = $_FILES['profile_image']['size'];
            $file_tmp = $_FILES['profile_image']['tmp_name'];
            $file_type = $_FILES['profile_image']['type'];

            $file_ext = pathinfo($_FILES['profile_image']['name'], PATHINFO_EXTENSION);
            $new_filename = $stu_user_id . '-' . time();
            $original_file_name = $file_name;
            move_uploaded_file($file_tmp, PROFILE_IMAGE_PATH . $file_name);
            rename( PROFILE_IMAGE_PATH . $file_name, PROFILE_IMAGE_PATH . $new_filename);
        }

        return $new_filename;
    }
}
