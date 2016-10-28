<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Assignment_submission_model extends CI_Model {

	private $table = 'assignment_submissions';

	public function __construct() {
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

    public function get_by_assignment_id($assignment_id, $user_id) {
        $query = $this->db->where('assignment_id', $assignment_id)
            ->where('student_user_id', $user_id)
            ->get($this->table);
        return $query->first_row();
    }

    public function get_submissions($assignment_id) {
        $query = $this->db->where('assignment_id', $assignment_id)
                ->get($this->table);
        return $query->result();
    }
}