<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Course_semester_model extends CI_Model {

	private $table = 'course_semesters';

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

    public function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete($this->table);
    }

    public function get_by_course($course_id) {

        $query = $this->db->where('course_id', $course_id)
            ->order_by('semester_year')
            ->order_by('semester_number')
            ->get($this->table);

        return $query->result();

    }
}