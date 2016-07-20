<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User_model extends CI_Model {

	//allowed login types.
	private $login_types = array('student', 'lecturer', 'admin');

	public function __construct() {
		parent::__construct();
	}

	public function process_login($login, $username, $password) {

		//encrypt password.
		$password = sha1($password)

		$return = array();

		switch ($login) {
			case 'student':
				$return = $this->process_student_login($username, $password);
				break;

			case 'lecturer':
				$return = $this->process_lecturer_login($username, $password);
				break;
				
			case 'admin':
				$return = $this->process_admin_login($username, $password);
				break;

			default:
				break;
		}
	}

	private function process_student_login($username, $password) {
		$query = $this->db->where('user_type_id', 3)
			->where('username', $username);
			->where('password', $password)
			->get('user');

		$result = $query->row();

	}

	private function process_lecturer_login($username, $password) {
		$query = $this->db->where('user_type_id', 2)
			->where('username', $username);
			->where('password', $password)
			->get('user');

		$result = $query->row();
	}

	private function process_admin_login($username, $password) {
		$query = $this->db->where('user_type_id', 1)
			->where('username', $username);
			->where('password', $password)
			->get('user');

		$result = $query->row();
	}

}