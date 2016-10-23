<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Timetable_model extends CI_Model {

	private $table = 'timetables';

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

    public function get_events($course_id = 0, $lecturer_id = 0) {

        $where_course_id = "1";
        $where_lecturer_id = "1";

        if($course_id > -1) {
            $where_course_id = "t.course_id = '{$course_id}'";
        }

        if($lecturer_id > 0) {
            $where_lecturer_id = "t.lecturer_id = '{$lecturer_id}'";
        }

        $sql  = "SELECT t.*, s.name AS subject_name, l.name AS location_name FROM $this->table t ";
        $sql .= "LEFT JOIN subjects s ON s.id = t.subject_id ";
        $sql .= "LEFT JOIN locations l ON l.id = t.location_id ";
        $sql .= "WHERE $where_course_id AND $where_lecturer_id";
    
        $query = $this->db->query($sql);
        return $query->result();
    }
}