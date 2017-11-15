<?php if (! defined('BASEPATH')) exit('no direct script access allowed');

class staff_subject_model extends CI_Model {

	private $table = 'staff_subjects';
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
    }

    public function delete($subject_id) {
        $this->db->where("subject_id", $subject_id);
        $this->db->delete($this->table);
    }

    public function get_by_subject($subject_id = 0) {
        $sql  = "SELECT s.user_id, ss.staff_id, u.full_name "; 
        $sql .= "FROM staff_subjects ss ";
        $sql .= "LEFT JOIN staff s ON s.id = ss.staff_id ";
        $sql .= "LEFT JOIN users u ON u.id = s.user_id ";
        $sql .= "WHERE u.status = 1 AND ss.subject_id = ? ";
        $sql .= "ORDER BY u.full_name";

        $query = $this->db->query($sql, array($subject_id));
        return $query->result();
    }
}