<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User_password_recovery_model extends CI_Model
{
	//allowed login types.
	private $table = 'user_password_recoveries';

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

	public function delete_by_user($user_id) {
        $this->db->where('user_id', $user_id);
        $this->db->delete($this->table);
    }

    public function get_userid_by_key($key) {
        $query = $this->db->where('reset_key', $key)
            ->limit(1)
            ->get($this->table);

        $row = $query->row();
        if(is_object($row)) {
            return $row->user_id;
        }
        return 0;
    }

    private function generate_reset_key($user) {
        return $user->email . ':' . $user->full_name . ':' . $user->user_type_id . ':' . time();
    }
}