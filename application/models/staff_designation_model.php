<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Staff_designation_model extends CI_Model {

	private $table = 'staff_designations';

	public function __construct() {
		parent::__construct();
	}

	public function get_disgnations_list() {
		$query = $this->db->order_by('designation', 'ASC')
			->get($this->table);

		return $query->result();
	}

	public function get_by_id($id) {
		$query = $this->db->where('id', $id)
			->get($this->table);

		return $query->row();
	}



	

}