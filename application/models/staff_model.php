<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Staff_model extends CI_Model
{
	//allowed login types.

	private $table = 'staff';

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

    public function update_by_userid($user_id, $data = array()) {
        $this->db->where('user_id', $user_id);
        return $this->db->update($this->table, $data);
    }

    public function get_staff_profile($user_id, $status = 1) {
        $this->db->select('staff.*, user.full_name, user.email, user.mobile_no, sd.designation, user.status')
            ->join('users user', 'staff.user_id =  user.id', 'inner')
            ->join('staff_designations sd', 'sd.id = staff.staff_designation_id', 'left')
            ->where('user.user_type_id', 2)
            ->where('staff.user_id', $user_id);

        if($status > 0) {
            $this->db->where('user.status', 1);
        }

        $query = $this->db->get($this->table);
        return $query->row();
    }

    public function get_stffs($params = array()) {

        $where_keyword = "1";
        
        $this->db->select('staff.*, user.full_name, user.email, user.mobile_no, sd.designation, user.status')
            ->from($this->table)
            ->join('users user', 'staff.user_id =  user.id', 'inner')
            ->join('staff_designations sd', 'sd.id = staff.staff_designation_id', 'left')
            ->where('user.user_type_id', 2)
            ->where('user.status', 1);
            

            //echo $params['desg'];die;


            if(!empty($params['keyword'])) {
                $keyword = $params['keyword'];
                $this->db->where('user.mobile_no LIKE', "%{$keyword}%");
                $this->db->or_where('user.email LIKE', "%{$keyword}%");
                $this->db->or_where('user.full_name LIKE', "%{$keyword}%");
 
            }

            if(!empty($params['desg'])){
                $this->db->where('staff.staff_designation_id', $params['desg']);
            }
            

            $this->db->order_by('user.full_name');
            $query = $this->db->get();
            


            //echo $this->db->last_query();die;

        return $query->result();
    }
}