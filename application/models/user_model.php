<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User_model extends CI_Model
{
	//allowed login types.
	private $login_types = array('student', 'lecturer', 'admin');

	public function __construct()
	{
		parent::__construct();
	}

	function login($username, $password)
	{
		$this->db->select('id, user_type_id, username, password, full_name');
		$this->db->from('users');
		$this->db->where('username', $username);
		$this->db->where('password', md5($password));
		$this->db->limit(1);

		$query = $this->db->get();

		if ($query->num_rows() == 1) {
			return $query->result();
		} else {
			return false;
		}
	}

}