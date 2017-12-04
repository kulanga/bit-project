<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Student_assignment extends MY_Controller {

	public function __construct() {
		parent::__construct();
        $this->set_topnav('assignment');

        //check logged in user is a student
        if($this->session->userdata('user_type_id') != 3 ) {
            die('Access Denied');
        }
	}

    public function index() {

        $this->load->model('assignment_model');
        $this->load->model('assignment_submission_model');


        $data = array();
        $user_id = $this->session->userdata('user_id');

        $assignments = $this->assignment_model->get_by_student($user_id);

        foreach($assignments as &$ass) {
            if($ass->is_repeat_assignment == 1) {

                $main_assignment_submission = $this->assignment_submission_model->get_by_assignment_id($ass->repeat_of_assignment_id, $user_id);

                //Check student is pass assignment
                //Display repeat assignmnet who are failed the main assignmnet.
                if(is_object($main_assignment_submission) && $main_assignment_submission->score < ASSIGNMENT_PASS_SCORE) {
                    $ass->show_repeat_assignment = 1;
                } else {
                    $ass->show_repeat_assignment = 0;
                }
            }
        }
        $data['assignments'] = $assignments;
        $this->layout->view('/student/assignment/index', $data);
    }

    public function submit($assignment_id = 0) {
        $this->load->model('assignment_model');
        $this->load->model('assignment_submission_model');
        $this->load->model('subject_model');
        $this->load->model('student_model');

        $data = array();

        //save submission.
        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            $attachment = $this->save_ass_submission($assignment_id);

            $user_id = $this->session->userdata('user_id');
            $student = $this->student_model->get_by_userid($user_id);

            if(count($attachment) > 0 ) {
                $this->assignment_submission_model->insert(
                    array(
                        'assignment_id'      => $assignment_id,
                        'student_user_id'    => $user_id,
                        'student_id'         => $student->id,
                        'original_file_name' => $attachment[0],
                        'file_name'          => $attachment[1],
                        'date_submitted'     => date('Y-m-d H:i:s')
                    )
                );
            }
        }

        $data['assignment'] = $this->assignment_model->get($assignment_id);
        $data['assignment_submission'] = $this->assignment_submission_model->get_by_assignment_id($assignment_id, $this->session->userdata('user_id'));

        if(is_object($data['assignment'])) {
            $data['subject'] = $this->subject_model->get($data['assignment']->subject_id);
        }

        $this->layout->view('/student/assignment/submit', $data);

    }

    public function view($assignment_id) {
        $stu_user_id = $this->session->userdata('user_id');
        $data = array();

        $this->load->model('assignment_model');
        $this->load->model('assignment_attachment_model');
        $this->load->model('subject_model');

        $data['assignment'] = $this->assignment_model->get($assignment_id);
        $data['assignment_attachments'] = $this->assignment_attachment_model->get_by_assignment_id($assignment_id);
        $data['subject'] = $this->subject_model->get($data['assignment']->subject_id);

        $this->layout->view('/student/assignment/view', $data);
    }


    private function save_ass_submission($assignment_id) {
        $stu_user_id = $this->session->userdata('user_id');

         $new_filename = $original_file_name = '';

        if(!empty($_FILES['attachment']['name'])) {
            $file_name = $_FILES['attachment']['name'];
            $file_size = $_FILES['attachment']['size'];
            $file_tmp = $_FILES['attachment']['tmp_name'];
            $file_type = $_FILES['attachment']['type'];

            $file_ext = pathinfo($_FILES['attachment']['name'], PATHINFO_EXTENSION);
            $new_filename = $assignment_id . '-' . $stu_user_id . '-' . time() . '-' . $file_name;
            $original_file_name = $file_name;

            move_uploaded_file($file_tmp, ASSIGNMENT_FILE_PATH . $file_name);
            rename( ASSIGNMENT_FILE_PATH . $file_name, ASSIGNMENT_FILE_PATH . $new_filename);
        }
        return empty($new_filename) ? array() : array($original_file_name, $new_filename);
    }


    function check_upload() {
         if(!empty($_FILES['attachment']['name'])) {
            $file_ext = pathinfo($_FILES['attachment']['name'], PATHINFO_EXTENSION);

            $expensions = array("doc", "pdf", 'docx');

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

}
