<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Assignment_model extends CI_Model {

	private $table = 'assignments';

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
    
    public function get_assigment_details($assignment_id) {
        $sql  = "SELECT a.*, aa.file_name FROM assignments a ";
        $sql .= "LEFT JOIN assignment_attachments aa ON aa.assignment_id = a.id "; 
        $sql .= "WHERE a.id = ? ";
        $query = $this->db->query($sql, array($assignment_id));
        return $query->result();
    }
}