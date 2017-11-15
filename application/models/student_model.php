<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Student_model extends CI_Model
{
	private $table = 'students';
	
	public function __construct()
	{
		parent::__construct();
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

    public function list_students($params = array()) {

        $where_keyword = "1";
        if(!empty($params['keyword'])) {
            $keyword = $params['keyword'];
            $where_keyword  = " stu.reg_no LIKE '%{$keyword}%' OR u.email LIKE '%{$keyword}%' OR u.full_name LIKE '%{$keyword}%'";
        }

        $where_batch_id = "1";
        if(!empty($params['batch_id'])) {
            $where_batch_id = "stu.course_id = '{$params['batch_id']}'";
        }

        $where_status  = "1";
        if(!empty($params['user_status'])) {
            $where_batch_id = "u.status = '{$params['user_status']}'";
        }

        $sql  = "SELECT stu.*, u.full_name, u.email, u.mobile_no, u.status AS user_status, c.name AS course_name ";
        $sql .= "FROM students stu ";
        $sql .= "LEFT JOIN users u ON u.id =  stu.user_id ";
        $sql .= "LEFT JOIN courses c ON c.id =  stu.course_id ";
        $sql .= "WHERE $where_keyword AND $where_batch_id ";
        $sql .= "ORDER BY u.full_name ASC, u.created_at DESC";
     
        $res = $this->db->query($sql);
        return $res->result();
    }

    public function get_by_userid($user_id) {
        $query = $this->db->where('user_id', $user_id)
            ->get($this->table);
        return $query->first_row();
    }

    public function get_student_count_bycourse($course_id) { 
        $sql = "SELECT COUNT(id) AS student_count FROM students WHERE course_id = ? GROUP BY course_id";

        $res = $this->db->query($sql, array($course_id));
        $st = $res->first_row();
        return is_object($st) ? $st->student_count : 0;
    }

    public function get_accedemic_profile($user_id) {

        $sql  = "SELECT st.course_id, st.user_id, sub.name AS subject, sub.code AS subject_code, ";
        $sql .= "cs.semester_year, cs.semester_number ";
        $sql .= "FROM students st ";
        $sql .= "LEFT JOIN course_semesters cs ON cs.course_id = st.course_id ";
        $sql .= "LEFT JOIN course_subjects csub ON csub.course_semester_id = cs.id ";
        $sql .= "LEFT JOIN subjects sub ON sub.id = csub.subject_id ";
        $sql .= "WHERE st.user_id = ? ";
        $sql .= "ORDER BY semester_year ASC, semester_number ASC";

        $query = $this->db->query($sql, array($user_id));
        $res = $query->result();

        $result = array();
        foreach ($res as $row) {
            $key = $row->semester_year .'-' . $row->semester_number;
            $title = ' Semester ' .  $row->semester_number . " of Year " .$row->semester_year;
            
            $row->title = $title;

            $result[$key]['title'] = $title;
            $result[$key]['rows'][] = $row;
        }
        return $result;
    }
}