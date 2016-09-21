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

 