<?php if (! defined('BASEPATH')) exit('no direct script access allowed');

class exam_result_detail_model extends CI_Model {

	private $table = 'exam_result_detail';
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

    public function delete($id) {
        $this->db->where("id", $id);
        $this->db->delete($this->table);
    }
}