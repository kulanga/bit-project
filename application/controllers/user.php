<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class user extends MY_Controller {
	public function __construct(){
		parent::__construct();
		//$this->module = "student";
	}

	public function index() {
		
	}

	public function student_login() {

		$this->render(array(), 'student/login');
	}

	public function lecturer_login() {

	}

	public function admin_login() {

	}


	public function process_login($account_type) {


		$account_type = $this->input->post('account_type');
		$username = $this->input->post('username');
		$password =  $this->input->post('password');


		if(!in_array($account_type, array('student'))) {
			
		}

		$this->load->model('user_model');
		$this->user_model->process_login($account_type. $username, $password);


		

	}

}