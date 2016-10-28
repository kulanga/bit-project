<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Student_signup extends MY_Controller {

	public function __construct(){
		parent::__construct();
	}

	public function signup() {
        $data = array();

        $this->load->library('form_validation');
        $this->load->model('course_model');
        $this->load->model('user_model');
        $this->load->model('student_model');

        $data['courses'] = $this->course_model->get_course_list();

        $cmd_post = $this->input->post('btn_signup');

        if($cmd_post != "") {
           
            $this->form_validation->set_rules('reg_no', 'Student Reg No.', 'trim|required|xss_clean');
            $this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email|is_unique[users.email]');
            $this->form_validation->set_rules('mobile_no', 'Mobile No', 'trim|required|xss_clean|numeric');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|matches[confirm_password]');
            $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|xss_clean');
            $this->form_validation->set_rules('course_id', 'Course', 'trim|required|xss_clean');

            if ($this->form_validation->run()) {

                $user_data = array(
                    'full_name' => $this->input->post('name'),
                    'email' => $this->input->post('email'),
                    'username' => $this->input->post('email'),
                    'mobile_no' => $this->input->post('mobile_no'),
                    'user_type_id' => 3,
                    'status' => 4, //approval is pending
                    'password' => md5($this->input->post('password')),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:d'),
                );

                $user_id = $this->user_model->insert($user_data);

                if($user_id  > 0 ) {
                    $stu_data = array(
                        'user_id' => $user_id,
                        'reg_no' => $this->input->post('reg_no'),
                        'course_id' => $this->input->post('course_id'),

                    );

                    $stu_id = $this->student_model->insert($stu_data);

                    if($stu_id > 0 ) {

                        $session = array(
                            'user_id' => $user_id,
                            'user_type_id' => 3,
                            'username' =>  $user_data['username'],
                            'email'   =>  $user_data['email'],
                            'full_name' =>  $user_data['full_name']
                        );
                        $this->session->set_userdata($session);

                        redirect('user', 'refresh');
                    }
                }
            }
        }

        $this->layout->view('student/signup/signup', $data);
	}

}