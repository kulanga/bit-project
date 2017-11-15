<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends MY_Controller
{
	public $layout_view = 'layout/default';

	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('user_id')) {
			redirect('/login');
		}
	}

	public function index()
	{	
		if($this->session->userdata('user_type_id') == 1) { //admin
			redirect('/admin/course');

		} elseif($this->session->userdata('user_type_id') == 2) { //Staff
			redirect('/staff/my-timetable');

		} elseif($this->session->userdata('user_type_id') == 3) { //Student
			redirect('/student/timetable');

		} else {
			die('Access Denied');
		}

		$this->layout->view('/user/index');
	}

	public function verify_email($user_id, $input_hash) {
		$this->load->model('user_model');
		$this->load->model('user_email_verification_model');

		$user = $this->user_model->get($user_id);
		$user_verify = $this->user_email_verification_model->get_by_user($user_id);

		if(is_object($user_verify)) {
			$hash = $user_id . $user->username . $user_verify->timestamp;
			$hash = md5($hash);

			if($hash === $input_hash) {
				$this->user_model->update($user->id, array('is_email_verified' => 1));
				$this->user_email_verification_model->update($user_verify->id, array('status' => 1));
				redirect('student/welcome');

			} else {
				show_error("Email verification url is not correct.");
			}
		}
		redirect('/student');
	}

	public function resend_verify_email() {
		$this->load->model('user_model');
		$this->load->model('user_email_verification_model');

		$user_id = $this->session->userdata('user_id');

		$user = $this->user_model->get($user_id);
		$is_verified = $this->user_model->is_verified($user_id);

		$res = 0;
		if (!$is_verified) {
			$ret = $this->user_email_verification_model->send($user_id, true);
			if($ret) {
				$res = 1;
			}
		}
		echo $res; die;
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('user');
	}

}