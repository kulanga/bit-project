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

    public function delete($id = 0) {
        $this->db->where('id', $id);
        $this->db->delete($this->table);
        return true;
    }

    public function delete_by_parentid($event_id) {
        $this->db->where('parent_event_id', $event_id);
        $this->db->delete($this->table);
        return true;
    }

	public function update($id, $data = array()) {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
	}

    public function get_events($course_id = 0, $lecturer_id = 0, $semester_id = 0) {

        $where_course_id = "1";
        $where_lecturer_id = "1";
        $where_semester = "1";

        if($course_id > -1) {
            $where_course_id = "t.course_id = '{$course_id}'";
        }

        if($lecturer_id > 0) {
            $where_lecturer_id = "t.lecturer_id = '{$lecturer_id}'";
        }

        if($semester_id > 0) {
            $where_semester = "t.semester_id = '{$semester_id}'";
        }

        $sql  = "SELECT t.*, s.name AS subject_name, l.name AS location_name, c.name AS course_name, c.start_date AS course_start_date, u.full_name 
                 FROM $this->table t ";
        $sql .= "LEFT JOIN courses c ON c.id = t.course_id ";
        $sql .= "LEFT JOIN subjects s ON s.id = t.subject_id ";
        $sql .= "LEFT JOIN locations l ON l.id = t.location_id ";
        $sql .= "LEFT JOIN users u ON u.id = t.lecturer_id ";
        $sql .= "WHERE $where_course_id AND $where_lecturer_id AND $where_semester";

        $query = $this->db->query($sql);
        return $query->result();
    }

    public function chek_is_recurring_event($event_id) {
        $this->db->select('id');
        $this->db->from($this->table);
        $this->db->where('parent_event_id', $event_id);
        $query = $this->db->get();
        return $query->num_rows() > 1 ? true : false;
    }

    public function check_lecturer_is_availeble($lecturer_id, $date, $from_time, $to_time) {
        $query = $this->db->where('date', $date)
            ->where('lecturer_id', $lecturer_id)
            ->limit(1)
            ->get($this->table);

        $row = $query->row();

        if(!is_object($row)) {
            return true;
        }

        $input_from_time_key = strtotime($row->date . ' ' . $from_time);
        $input_to_time_key = strtotime($row->date . ' ' . $to_time);

        $saved_from_time_key = strtotime($row->date . ' ' . $row->time_from);
        $saved_to_time_key = strtotime($row->date . ' ' . $row->time_to);

        if($input_from_time_key >= $saved_from_time_key && $input_to_time_key <= $saved_to_time_key) {
            return false;
        }

        return true;
    }
}