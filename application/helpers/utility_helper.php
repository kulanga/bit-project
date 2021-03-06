<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('asset_url()'))
{
    function asset_url()
    {
        return base_url().'assets/';
    }
}

if (!function_exists('convert_db_date_format'))
{
    function convert_db_date_format($date) {
        return date('Y-m-d', strtotime($date));
    }
}

if (!function_exists('assignment_status_in_text'))
{
    function assignment_status_in_text($status_id, $due_date = '') {
        $status = '';

        if($status_id == 0) {
            $status = "Draft";

        } elseif($status_id == 1) {
            if(time() > strtotime($due_date)) {
                $status = "Closed";
            } else {
                $status = "Live";
            }
        } elseif($status_id == 2) {
            $status = "Closed";
        }

        return $status;
    }

}


if (!function_exists('user_status'))
{
    function user_status($status_id) {
        $status = '';

        if($status_id == 1) {
            $status = "Active";

        } elseif($status_id == 2) {
            $status = "Disabled";

        } elseif($status_id == 3) {
            $status = "Deleted";

        } elseif($status_id == 4) {
            $status = "Pending Approval";
        }

        return $status;
    }

}

if (!function_exists('course_name'))
{
    function course_name($course) {
        return $course->name . ' ' . date('Y', strtotime($course->start_date));
    }
}

if (!function_exists('couser_status'))
{
    function couser_status($status_id = 0) {
        $data = array(
            1 => 'Live',
            2 => 'Draft',
            3 => 'Completed'
        );

        if($status_id > 0 ) {
            return $data[$status_id];
        } else {
            return $data;
        }
    }
}


if (!function_exists('profile_image'))
{
    function profile_image($user_id) {
        $ci =& get_instance();
        $ci->load->model('user_model');

        $user = $ci->user_model->get($user_id);

        if($user->profile_image) {
            $profile_image = base_url().'uploads/profile_images/'.$user->profile_image;
        } else {
            $profile_image = base_url().'uploads/default-profile.png';
        }

        return $profile_image;
    }
}

if (!function_exists('get_student_course_data'))
{
    function get_student_course_data($user_id) {
        $ci =& get_instance();
        $ci->load->model('student_model');
        $data = $ci->student_model->get_course($user_id);
        return $data;
    }
}