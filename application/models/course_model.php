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

    public function get_course_list($params = array()) {

        $where_status = '1';

        if(!empty($params['status'])) {
            $where_status = "courses.status = '{$params['status']}'";
        }

        $sql  = "SELECT courses.* ";
        $sql .= "FROM courses ";
        $sql .= "WHERE $where_status ";
        $sql .= "ORDER BY status, name";

        $query = $this->db->query($sql);
        return $query->result();
    }
}