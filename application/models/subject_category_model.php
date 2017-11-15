<?php if (! defined('BASEPATH')) exit('no direct script access allowed');

class subject_category_model extends CI_Model {

	private $table = 'subject_categories';
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
        $sql  = "SELECT cc.name, cc.id, sc.course_category_id "; 
        $sql .= "FROM subject_categories sc ";
        $sql .= "LEFT JOIN course_category cc ON cc.id = sc.course_category_id ";
        $sql .= "WHERE sc.subject_id = ? ";
        $sql .= "ORDER BY cc.name";

        $query = $this->db->query($sql, array($subject_id));
        return $query->result();
    }
}