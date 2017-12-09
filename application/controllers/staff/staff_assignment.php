<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Staff_assignment extends MY_Controller {

	public function __construct() {
		parent::__construct();
        $this->set_topnav('manage_assignment');
	}

    public function index() {
        $this->load->model('assignment_model'); 
        $this->load->model('course_model');

         $params = array(
        'status' => $this->input->get('status'),
        'user_id' => $this->session->userdata('user_id')
        );

        $data = array();       
        $data['courses'] = $this->course_model->get_course_list();
        $data['assignments'] = $this->assignment_model->get_assigment_details($params);
        

        //$data['list'] = $this->assignment_model->get_assigment_details($params);

        $this->layout->view('/staff/assignment/list', $data);
    }

    public function list_submissions($assignment_id = 0) {

        $this->load->model('assignment_model');
        $this->load->model('assignment_submission_model');
        $this->load->model('student_model');
        $this->load->model('user_model');

        $data = array();

        $data['assignment'] = $this->assignment_model->get($assignment_id);
        $data['assignment_submissions'] = $this->assignment_submission_model->get_submissions($assignment_id);

        if(count($data['assignment_submissions']) > 0 ) {
            foreach($data['assignment_submissions'] as &$asub) {
                $asub->student = $this->student_model->get_by_userid($asub->student_user_id);
                $asub->student_user = $this->user_model->get($asub->student_user_id);
            }
        }

        $this->layout->view('/staff/assignment/submissions', $data);
    }

    public function add_marks() {
        $id = $this->input->post('id');
        $student_id = $this->input->post('student_id');
        $score = (int)$this->input->post('score');

        $response = array('error' => '', 'success' => '');
        if($score < 0 || $score > 100) {
            $response['error'] =  'Assignment marks should be in between 0 - 100 range';
        }

        if(empty($response['error'])) {
            $this->load->model('assignment_submission_model');
            $this->assignment_submission_model->add_score($id, $score);
            $response['success'] = '1';
        }

        echo json_encode($response);die;

    }

    public function create($assignment_id = 0) {

        $this->load->model('course_model');
        $this->load->model('course_subject_model');
        $this->load->model('assignment_model');
        $this->load->model('assignment_attachment_model');

        $data = [];
        $data['courses'] = $this->course_model->get_course_list();

        $submit = $this->input->post('btn_create');

        $attchments = $this->assignment_attachment_model->get_by_assignment_id($assignment_id);

        if(in_array($submit, array('create', 'update', 'publish'))) {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('batch_id', 'Batch', 'trim|required|xss_clean');
            $this->form_validation->set_rules('subject_id', 'Subject', 'trim|required|xss_clean');
            $this->form_validation->set_rules('description', 'Description', 'trim|required|xss_clean');
            $this->form_validation->set_rules('title', 'Title', 'trim|required|xss_clean');
            $this->form_validation->set_rules('due_date', 'Duedate', 'trim|required|xss_clean');
           // $this->form_validation->set_rules

            if(count($attchments) <= 0 && empty($_FILES['attachment']['name'])) {
                $this->form_validation->set_rules('attachment', 'Attachment', 'required|callback_check_upload');
            }

            $is_repeat_ass = $this->input->post('is_repeat_assignment');
            if($is_repeat_ass == '1') {
                $this->form_validation->set_rules('repeat_of_assignment_id', 'Repeat of', 'trim|required|xss_clean');
            }

            if($this->form_validation->run() === true) {

                $course_data = $this->course_model->get($this->input->post('batch_id'));

                //update
                if($assignment_id > 0) {

                    $save_data = array(
                        'batch_id' => $this->input->post('batch_id'),
                        'subject_id' => $this->input->post('subject_id'),
                        'description' => $this->input->post('description'),
                        'updated_at' => date('Y-m-d H:i:s'),
                        'due_date' => convert_db_date_format($this->input->post('due_date')),
                        'title' => $this->input->post('title'),
                        'semester_id' => $course_data->current_semester_id,
                    );


                    //publish assignent
                    if($submit == 'publish') {
                        $save_data['status'] = 1;
                    }

                    $this->assignment_model->update($assignment_id, $save_data);

                } else { //insert
                    $save_data = array(
                        'batch_id' => $this->input->post('batch_id'),
                        'subject_id' => $this->input->post('subject_id'),
                        'lecturer_id' => $this->session->userdata('user_id'),
                        'description' => $this->input->post('description'),
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                        'due_date' => convert_db_date_format($this->input->post('due_date')),
                        'title' => $this->input->post('title'),
                        'status' => '0',
                        'semester_id' => $course_data->current_semester_id,
                    );

                     if($is_repeat_ass == '1') {
                        $save_data['is_repeat_assignment'] =  1;
                        $save_data['repeat_of_assignment_id'] = $this->input->post('repeat_of_assignment_id');
                    }

                    $assignment_id = $this->assignment_model->insert($save_data);
                }

                //save assignment attachments
                $attachment = $this->upload_attachment($assignment_id);
                if(count($attachment) > 0 ) {
                    $this->assignment_attachment_model->insert(
                        array(
                            'assignment_id'      => $assignment_id,
                            'original_file_name' => $attachment[0],
                            'file_name'          => $attachment[1]
                        )
                    );
                }

                redirect('/staff/assignment/edit/' . $assignment_id );
            }
        }

        $data['assignment'] = null;
        $data['subjects'] = array();

        if($assignment_id > 0 ) {

            $data['assignment'] = $this->assignment_model->get($assignment_id);
            $data['assignment_attachments'] =  $this->assignment_attachment_model->get_by_assignment_id($assignment_id);
            $course = $this->course_model->get($data['assignment']->batch_id);
            $data['subjects']   = $this->course_subject_model->get_by_semester($course->current_semester_id);

            $this->layout->view('/staff/assignment/edit', $data);
        } else {
            $this->layout->view('/staff/assignment/create', $data);
        }
    }

    public function remove_attachment() {
        $assignment_id = $this->input->post('assignment_id');
        $file_id = $this->input->post('file_id');

        $this->load->model('assignment_attachment_model');
        $this->assignment_attachment_model->delete($file_id, $assignment_id);
        echo '1'; die;

    }

    public function get_assignment_list_for_repeat_assignment() {
        $course_id = $this->input->post('course_id');
        $subject_id = $this->input->post('subject_id');

        $this->load->model('assignment_model');
        $result = $this->assignment_model->get_ass_list_for_repeat_ass($course_id, $subject_id);

        $response = array();

        $list = '<option value="">-</option>';
        foreach($result as $row) {
            $list .= '<option value="'.$row->id.'">' .  $row->title . ' - Semester ' . $row->semester_number . ' of Year ' . $row->semester_year . '</option>';
        }

        $response['list'] = $list;

        echo json_encode($response);
        exit;

    }

    function check_upload() {
        if(!empty($_FILES['attachment']['name'])) {
            $file_ext = pathinfo($_FILES['attachment']['name'], PATHINFO_EXTENSION);

            $expensions = array("jpeg","jpg","png", "doc", "pdf", 'docx');


            if(!in_array($file_ext, $expensions)) {
                $this->form_validation->set_message('check_upload', 'Extension not allowed.');
                return false;
            }

            if($_FILES['attachment']['size'] > 2097152) {
                $this->form_validation->set_message('check_upload', 'File size must be excately 2 MB');
                return false;
            }
        }
        return true;
    }

    private function upload_attachment($assignment_id = 0) {

        $new_filename = $original_file_name = '';

        if(!empty($_FILES['attachment']['name'])) {
            $file_name = $_FILES['attachment']['name'];
            $file_size = $_FILES['attachment']['size'];
            $file_tmp = $_FILES['attachment']['tmp_name'];
            $file_type = $_FILES['attachment']['type'];

            $file_ext = pathinfo($_FILES['attachment']['name'], PATHINFO_EXTENSION);
            $new_filename = $assignment_id . '-' . time() . '-' . $file_name;
            $original_file_name = $file_name;

            move_uploaded_file($file_tmp, ASSIGNMENT_FILE_PATH . $file_name);
            rename( ASSIGNMENT_FILE_PATH . $file_name, ASSIGNMENT_FILE_PATH . $new_filename);
        }
        return empty($new_filename) ? array() : array($original_file_name, $new_filename);
    }
}
