<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Subject_model extends CI_Model
{

	private $table = 'subjects';

	public function __construct() {
		parent::__construct();
	}

	public function get($id = 0) {

        if (is_array($id)) {
            if (count($id) <= 0) {
                return array();
            }
            $this->db->where_in('id', $id);
        } elseif ($id > 0) {
            $this->db->where('id', $id);
        }

        $query = $this->db->get($this->table);

        if ($query->num_rows() <= 0) {
            return array();
        }

        if (!is_array($id) && $id > 0) {
            return $query->first_row();
        }

        foreach ($query->result() as $k => $row) {
            $rows[$row->id] = $row;
        }

        return $rows;
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

	public function get_list() {
		$this->db->where('is_deleted', '0');
		$this->db->order_by('code', 'ASC');
		$query = $this->db->get($this->table);
		return $query->result();
	}

    public function get_subject_id_by_code($subject_code) {

        $query = $this->db->where('code', $subject_code)
            ->get($this->table);

        $res = $query->first_row();
        return count($res) == 1 ? $res->id : 0;
    }


}