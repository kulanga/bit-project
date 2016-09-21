<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Course_model extends CI_Model {

	private $table = 'courses';

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

    public function get_course_list() {
        $sql  = "SELECT courses.* ";
        $sql .= "FROM courses ";
        $sql .= "WHERE status = 1 ";
        $sql .= "ORDER BY name, code";

        $query = $this->db->query($sql);
        return $query->result();
    }
}