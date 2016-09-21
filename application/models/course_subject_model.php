<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Course_subject_model extends CI_Model {

	private $table = 'course_subjects';

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

    public function check_exist($subject_id, $course_id, $semester_id) {
        $query = $this->db->select('id')
            ->from($this->table)
            ->where('subject_id', $subject_id)
            ->where('course_id', $course_id)
            ->where('course_semester_id', $semester_id)
            ->get();

        $result = $query->first_row();
        return !empty($result->id) ? true :  false;
    }

    public function get_by_semester($semester_id) { 
        $query = $this->db->select('course_subjects.*, subjects.*')
            ->join('subjects', 'subjects.id = course_subjects.subject_id', 'left')
            ->where('course_subjects.course_semester_id', $semester_id)
            ->get('course_subjects');
        return $query->result();
    }

}