<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Common extends MY_Controller {
    public function get_subjects_in_current_semester($course_id) {
         
        $this->load->model('course_model');
        $this->load->model('course_semester_model');
        $this->load->model('course_subject_model');
        $this->load->model('course_subject_model');
        
        $course = $this->course_model->get($course_id);

        $subjects = $this->course_subject_model->get_by_semester($course->current_semester_id);

        echo json_encode($subjects);
        exit;
    }
}