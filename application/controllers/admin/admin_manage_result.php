<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_manage_result extends MY_Controller {

     public $layout_view = 'layout/default';

	public function __construct() {
		parent::__construct();
        $this->set_topnav('manage_results');

        if($this->session->userdata('user_type_id') != 1 ) {
            die('Access Denied');
        }

        $this->load->library('form_validation');
	}

    public function index() {

        $data = array();

        //$data['full_page_layout'] = true;

        $this->load->model('exam_result_model');
        $this->load->model('course_model');

        $data['courses'] = $this->course_model->get_course_list();


        $params = $this->input->get();

        $data['data'] = $this->exam_result_model->get_student_results($params);
        $data['filters'] = $params;

        $this->layout->view('admin/manage_result/index', $data);

    }

    public function import_result() {

        $this->load->library('form_validation');
        $this->load->model('course_model');
        $data = array();

        $data['courses'] = $this->course_model->get_course_list();

        $submit  = $this->input->post('btn_submit');

        if(!empty($submit)) {

            $this->form_validation->set_rules('batch_id', 'Batch', 'trim|required|xss_clean');
            $this->form_validation->set_rules('semester_id', 'Semester', 'trim|required|xss_clean');
            $this->form_validation->set_rules('result_sheet', 'Result Sheet', 'callback_check_upload');

            if($this->form_validation->run() == true) {

                //Upload result sheet to the server and get files name
                $result_sheet = $this->upload_result_sheet();

                //Get full path to the  uploaded result sheet.
                $result_sheet_path = RESULT_SHEET_PATH . $result_sheet;

                if(file_exists($result_sheet_path)) {
                    $res_data = $this->extract_result_data($result_sheet_path);
                    $prcessed_data = $this->process_result_data($res_data);

                    if(count($prcessed_data['errors']) > 0 ) {
                        $data['errors'] = $prcessed_data['errors'];

                    } else {

                        //Save results data
                        $ret = $this->save_result_data($prcessed_data['data']);
                        if ($ret) {
                            $this->session->set_flashdata('success_message', 'Results successfully imported.');
                            redirect('/admin/admin_manage_result');
                            exit;
                        } else {
                            $data['errors'][] = "An error occurred while saving results to the database. Please try again";
                        }
                    }
                }
            }
        }

        $this->layout->view('admin/manage_result/import_result', $data);
    }

    function check_upload() {
        if(!empty($_FILES['result_sheet']['name'])) {
            $file_ext = pathinfo($_FILES['result_sheet']['name'], PATHINFO_EXTENSION);

            $expensions = array("xls","xlsx");

            if(!in_array($file_ext, $expensions)) {
                $this->form_validation->set_message('check_upload', 'Invalid file format.');
                return false;
            }

        }
        return true;
    }

    private function upload_result_sheet() {

        $new_filename = $original_file_name = '';

        if(!empty($_FILES['result_sheet']['name'])) {
            $file_name = $_FILES['result_sheet']['name'];
            $file_size = $_FILES['result_sheet']['size'];
            $file_tmp = $_FILES['result_sheet']['tmp_name'];
            $file_type = $_FILES['result_sheet']['type'];

            $file_ext = pathinfo($_FILES['result_sheet']['name'], PATHINFO_EXTENSION);
            $new_filename = 'resultsheet-' . time() .'.' . $file_ext;
            $original_file_name = $file_name;
            move_uploaded_file($file_tmp, RESULT_SHEET_PATH . $file_name);
            rename(RESULT_SHEET_PATH . $file_name, RESULT_SHEET_PATH . $new_filename);
        }
        return $new_filename;
    }

    private function extract_result_data($file) {

        $this->load->library('excel');

        $obj_phpexcel = PHPExcel_IOFactory::load($file);

        $cell_collection = $obj_phpexcel->getActiveSheet()->getCellCollection();
        $header = $arr_data = array();

        foreach($cell_collection as $cell) {
            $column = $obj_phpexcel->getActiveSheet()->getCell($cell)->getColumn();
            $row = $obj_phpexcel->getActiveSheet()->getCell($cell)->getRow();
            $data_value = $obj_phpexcel->getActiveSheet()->getCell($cell)->getValue();

            if ($row == 1) {
                $header[$row][$column] = $data_value;
            } else {
                $arr_data[$row][$column] = $data_value;
            }
        }

        $data = array();
        $data['headers'] = $header;
        $data['values'] = $arr_data;

        return $data;
    }

    private function process_result_data($data) {
        $this->load->model('student_model');
        $this->load->model('subject_model');

        $errors = array();


        $subject_codes =  array();

        foreach($data['headers'] as $header) {

            //validate
            if(strtoupper($header['A']) !== 'NAME') {
                $errors[] = "NAME column could not find in 'A'.";
            }

            if(strtoupper($header['B']) !== 'INDEXNO') {
                $errors[] = "INDEXNO column could not find in 'B'.";
            }

            if(empty($header['C'])) {
                $errors[] = "Result column could not find in 'C'.";
            }

            if(!empty($errors)) {
                continue;
            }

            foreach($header as $key => $cell) {

                //Skip Name & IndexNo columns.
                //Here we need grab grades only.
                if(in_array($key, array('A', 'B'))) {
                    continue;
                }

                $subject = explode('/', $cell);

                if(count($subject) != 2) {
                    $errors[] = "Subject code could not find.";
                    continue;
                }

                $subject_code = $subject[0];

                //check subject code exist in the database.
                $subject_id = $this->subject_model->get_subject_id_by_code($subject_code);
                if($subject_id <= 0) {
                    $errors[] = "Subject code " . $subject_code . " does not exist.";
                    continue;
                }

                $subject_codes[$key] = array('id' => $subject_id, 'code' => $subject_code);

            }
        }

        $result_data = array();

        foreach($data['values'] as $row) {

            $reg_no = $row['B'];

            $student = $this->student_model->get_by_reg_no($reg_no);
            if(empty($student)) {
                $errors[] = "Student with Reg.No " . $reg_no . " not found.";
                continue;
            }

            if($student->course_id != $this->input->post('batch_id')) {
                $errors[] = "Student Reg.No " . $reg_no . " has enrolled in different course.";
                break;
            }

            $result_data[$student->user_id] = array();

            foreach($row as $key => $val) {

                if(in_array($key, array('A', 'B'))) {
                    continue;
                }

                $subject_id = $subject_codes[$key]['id'];
                $result_data[$student->user_id][$subject_id] = $val;
            }
        }
        return array('data' => $result_data, 'errors' => $errors);
    }

    private function save_result_data($data) {

        $this->load->model('exam_result_model');
        $this->load->model('course_semester_model');

        $course_id = $this->input->post('batch_id');
        $semester_id = $this->input->post('semester_id');

        $cs = $this->course_semester_model->get($semester_id);
        $year_semester = $cs->semester_year . '-' . $cs->semester_number;

        $save_data = array();
        foreach($data as $student_user_id => $row) {
            foreach($row as $subject_id => $grade) {
                $save_data[] = array(
                    'subject_id' => $subject_id,
                    'grade' => $grade,
                    'semester_id' => $semester_id,
                    'year_semester' => $year_semester,
                    'course_id' => $course_id,
                    'student_user_id' => $student_user_id,
                );
            }
        }

        $this->exam_result_model->save_result_data($save_data);
        return true;
    }

}