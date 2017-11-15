<?php if (! defined('BASEPATH')) exit('no direct script access allowed');

class course_category_model extends CI_Model {

	private $table = 'course_category';

	public function __construct() {
		parent::__construct();
	}

	public function get($id = 0) {
        $this->db->where('id', $id);
        $query = $this->db->get($this->table);
        return $query->first_row();
    }

    public function get_course_list() {

        $sql  = "SELECT * ";
        $sql .= "FROM course_category ";
		$sql .= "ORDER BY name";      
        $query = $this->db->query($sql);
        return $query->result();
    }

}