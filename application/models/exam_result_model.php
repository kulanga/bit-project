<?php if (! defined('BASEPATH')) exit('no direct script access allowed');

class exam_result_model extends CI_Model {

	private $table = 'exam_results';
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

    public function save_result_data($data) {

        foreach($data as $row) {
            $insert_query = $this->db->insert_string($this->table, $row);
            $insert_query = str_replace('INSERT INTO','INSERT IGNORE INTO', $insert_query);
            $this->db->query($insert_query);
        }
    }

    public function get_student_results($params = array()) {

        $course_id = isset($params['course_id']) ? $params['course_id'] : 0;

        $where_course = '1';
        if(!empty($params['course_id'])) {
            $where_course = "er.course_id = '{$params['course_id']}'";
        }

        $where_semester = '1';
        if(!empty($params['semester_id'])) {
            $this->load->model('course_semester_model');
            $cs = $this->course_semester_model->get($params['semester_id']);
            $year_semester = $cs->semester_year . '-' . $cs->semester_number;
            $where_semester = "er.year_semester = '{$year_semester}'";
        }

        $where_student = '1';
        if(!empty($params['keyword_search'])) {
            $keyword_search = trim($params['keyword_search']);
            $where_student = "st.reg_no LIKE '{$keyword_search}'";
        }

        if(empty($params)) {
            $where_course = "er.course_id = '0'";
        }

        $sql  = "SELECT er.*, st.reg_no, u.full_name, sub.name AS subject_name, sub.code AS subject_code,";
        $sql .= "cs.semester_number, cs.semester_year, c.name AS course_name ";
        $sql .= "FROM exam_results er ";
        $sql .= "LEFT JOIN students st ON st.user_id = er.student_user_id ";
        $sql .= "LEFT JOIN users u ON u.id = er.student_user_id ";
        $sql .= "LEFT JOIN course_semesters cs ON cs.id = er.semester_id ";
        $sql .= "LEFT JOIN subjects sub ON sub.id = er.subject_id ";
        $sql .= "LEFT JOIN courses c ON c.id = st.course_id ";
        $sql .= "WHERE $where_course AND $where_semester AND $where_student";

        $query = $this->db->query($sql);
        $result = $query->result();


        foreach($result as &$row) {
            $year_sem = explode('-', $row->year_semester);
            $row->year_semester_text = "Year " . $year_sem[0] . " Semester " . $year_sem[1];
        }

        //echo '<pre>';
        //print_r($result);die;

        return $result;

    }
}