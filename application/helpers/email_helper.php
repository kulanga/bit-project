<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('send_mail'))
{
    function send_mail($to, $subject, $message, $from = '') {
        $ci =& get_instance();

        $to   = $to ? $to : die('To email address is required');
        $from = $from ? $from : 'noreply.hndeportal@gmail.com';

        //echo $from;die;
        $ci->load->library('email', $ci->config->item('email'));

        $ci->email->from($from, 'HNDE Portal');
        $ci->email->to($to);
        $ci->email->subject($subject);
        $ci->email->message($message);

        $return = $ci->email->send();
        //show_error($ci->email->print_debugger());

        return $return;
    }
}


 