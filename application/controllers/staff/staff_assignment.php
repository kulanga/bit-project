<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Staff_assignment extends MY_Controller {

	public function __construct() {
		parent::__construct();
        $this->set_topnav('manage_assignment');
	}
   
    public function index() {
        
    }
    
    public function create($assignment_id = 0 ) {

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
            $this->form_validation->set_rules('due_date', 'Duedate', 'trim|required|xss_clean');

            $this->form_validation->set_rules('attachment', 'Attachment', 'callback_check_upload');


            if (!empty($_FILES['attachment']['name']) || count($attchments) == 0 ) {
                $this->form_validation->set_rules('attachment', 'Attachment', 'required|callback_check_upload');
            }

            if($this->form_validation->run() === true) {

                //update
                if($assignment_id > 0) {

                    $save_data = array(
                        'batch_id' => $this->input->post('batch_id'),
                        'subject_id' => $this->input->post('subject_id'),
                        'description' => $this->input->post('description'),
                        'updated_at' => date('Y-m-d H:i:s'),
                        'due_date' => convert_db_date_format($this->input->post('due_date')),
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
                        'status' => '0',
                    );
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
