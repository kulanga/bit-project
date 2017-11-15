<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Location_model extends CI_Model {

	private $table = 'locations';

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
            //return false;
        }
        return $this->db->insert_id();
	}

	public function update($id, $data = array()) {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
	}

    public function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('locations');
    }

    public function get_locations() {
        $query = $this->db->order_by('name')
            ->get($this->table);
        return $query->result();
    }
}