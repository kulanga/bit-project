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
    function assignment_status_in_text($status_id) {
        $status = '';

        if($status_id == 0) {
            $status = "Drafted";

        } elseif($status_id == 1) {
            $status = "Live";

        } elseif($status_id == 2) {
            $status = "Completed";
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
 