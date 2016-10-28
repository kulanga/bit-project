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

    public function get_assigment_details($lecturer_id) {
        $sql  = "SELECT a.*, aa.file_name, s.name subject_name, c.name course_name, c.start_date course_start FROM assignments a ";
        $sql .= "LEFT JOIN assignment_attachments aa ON aa.assignment_id = a.id "; 
        $sql .= "LEFT JOIN subjects s ON s.id = a.subject_id ";
        $sql .= "LEFT JOIN courses c ON c.id =  a.batch_id ";
        $sql .= "WHERE a.lecturer_id = ? ";
        
        $query = $this->db->query($sql, array($lecturer_id));

        return $query->result();
    }
 
    public function get_by_student($student_user_id) {

        $sql = "SELECT course_id FROM students WHERE user_id = ?  LIMIT 1";
        $query = $this->db->query($sql, array($student_user_id));
        $stu = $query->row();
        
        if(is_object($stu)) {
            $sql  = "SELECT ass.*, sub.name AS subject_name, sub.code AS subject_code FROM assignments AS ass ";
            $sql .= "LEFT JOIN subjects sub ON sub.id = ass.subject_id ";
            $sql .= "WHERE ass.status IN (1,2) AND ass.batch_id = ? ";
            $sql .= "ORDER BY ass.due_date DESC ";
            
            $query = $this->db->query($sql, array($stu->course_id));

            return $query->result();
        }
        return array();
    }

}