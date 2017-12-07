<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User_model extends CI_Model
{
	//allowed login types.
	private $login_types = array('student', 'lecturer', 'admin');
	private $table = 'users';

	public function __construct()
	{
		parent::__construct();
	}

	public function get($id = 0) {
        $this->db->where('id', $id);
        $query = $this->db->get($this->table);
        return $query->first_row();
    }

	public function insert($data = array()) {
		if (!$this->db->insert($this->table, $data)) {
            return false;
        }
        return $this->db->insert_id();
	}

	public function update($id, $data = array()) {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
	}

	public function is_verified($user_id) {

		$this->db->where('id', $user_id);
		$query = $this->db->get($this->table);

		$row = $query->first_row();
		return $row->is_email_verified || 0;

	}

    public function recover_password($email) {
        $this->db->where('email', $email);
        $this->db->where_in('status', array(1, 4));
        $this->db->limit(1);

        $query = $this->db->get($this->table);

        if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            return false;
        }
    }

	function login($username, $password)
	{
		$this->db->select('id, user_type_id, username, password, full_name, email');
		$this->db->from('users');
		$this->db->where('username', $username);
		$this->db->where('password', md5($password));
        $this->db->where_in('status', array(1, 4));
		$this->db->limit(1);

		$query = $this->db->get();

		if ($query->num_rows() == 1) {
			return $query->result();
		} else {
			return false;
		}
	}
}