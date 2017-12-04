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

    public function generate_password() {
        $password_string = '!@#$%*&abcdefghijklmnpqrstuwxyzABCDEFGHJKLMNPQRSTUWXYZ23456789';
        $password = substr(str_shuffle($password_string), 0, 6);
        echo $password;die;
    }

    public function get_semesters_in_course($course_id) {

        $this->load->model('course_semester_model');

        $res = $this->course_semester_model->get_by_course($course_id);
        $return = array();

        foreach($res as $row) {
            $return[$row->id] = $row;
        }

        echo json_encode(array('data' => $return));
        exit;
    }
}