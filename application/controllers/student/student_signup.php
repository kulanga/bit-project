<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Student_signup extends MY_Controller {

	public function __construct(){
		parent::__construct();
	}

	public function signup() {
        $data = array();

        $this->load->library('form_validation');
        $this->load->model('course_model');
        $this->load->model('course_category_model');
        $this->load->model('user_model');
        $this->load->model('student_model');

        $data['courses'] = $this->course_model->get_course_list(array('status' => 1));
        //$data['course_category'] = $this->course_category_model->get_course_list();
        //print_r($data['course_category']);die;
        $cmd_post = $this->input->post('btn_signup');

        if($cmd_post != "") {

            $this->form_validation->set_rules('reg_no', 'Student Reg No.', 'trim|required|xss_clean|is_unique[students.reg_no]');
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
                    'username' => $this->input->post('reg_no'),
                    'mobile_no' => $this->input->post('mobile_no'),
                    'user_type_id' => 3,
                    'status' => 4, //approval is pending
                    'password' => md5($this->input->post('password')),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:d'),
                );

                $this->db->trans_start();
                $this->db->trans_strict(true);

                $user_id = $this->user_model->insert($user_data);

                if($user_id  > 0 ) {
                    $stu_data = array(
                        'user_id' => $user_id,
                        'reg_no' => $this->input->post('reg_no'),
                        'course_id' => $this->input->post('course_id'),
                    );

                    $stu_id = $this->student_model->insert($stu_data);

                    $this->db->trans_complete();

                    if ($this->db->trans_status() === false) {
                        $this->db->trans_rollback();

                    } else {

                        $this->db->trans_commit();

                        if($stu_id > 0 ) {
                            $session = array(
                                'user_id' => $user_id,
                                'user_type_id' => 3,
                                'username' =>  $user_data['username'],
                                'email'   =>  $user_data['email'],
                                'full_name' =>  $user_data['full_name']
                            );
                            $this->session->set_userdata($session);

                            //send email verification email
                            $this->load->model('user_email_verification_model');
                            $this->user_email_verification_model->send($user_id);

                            redirect('user', 'refresh');
                        }
                    }
                }
            }
        }

        $this->layout->view('student/signup/signup', $data);
	}

}