<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MY_Controller
{
	public $layout_view = 'layout/default';

	function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
	}

	function index()
	{
		
		if ($this->session->userdata('user_id') > 0 ) {
			redirect('/user');
		}

		$this->layout->title('Student Login');
		$data = array('login_as' => 'Student');

		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$this->load->helper(array('form'));

			$this->load->library('form_validation');
	
			$this->form_validation->set_rules('username', 'username', 'trim|required|xss_clean');
			$this->form_validation->set_rules('password', 'password', 'trim|required|xss_clean|callback_check_database');
	
			if ($this->form_validation->run() == true) {
                redirect('user', 'refresh');
			}
		}

		$this->layout->view('login/index', $data);
	}

	function lecturer()
	{
		if ($this->session->userdata('user_id') > 0 ) {
			redirect('/user');
		}

		$data = array('login_as' => 'Lecturer', 'is_lecturer_login' => 1);

		$this->layout->title('Lecturer Login');
		$this->layout->view('login/index', $data);
	}

	function check_database($password)
	{
		//Field validation succeeded.  Validate against database
		$username = $this->input->post('username');

		//query the database
		$result = $this->user_model->login($username, $password);

		if ($result) {
			$session = array();
			foreach ($result as $row) {
				$session = array(
					'user_id' => $row->id,
					'user_type_id' => $row->user_type_id,
					'username' => $row->username,
					'email'   => $row->email,
					'full_name' => $row->full_name
				);
				$this->session->set_userdata($session);
			}

			return true;

		} else {
			$this->form_validation->set_message('check_database', 'Invalid username or password');
			return false;
		}
	}
}