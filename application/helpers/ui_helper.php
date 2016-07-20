<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('apply_layout')) {
	function apply_layout($layout_file) {
		$layout = VIEWPATH . "/layouts/" . $layout_file . '.php';
		if(!file_exists($layout)) {
			echo  $layout_file . " file not found in " . VIEWPATH . "/layouts/";
			exit;
		}
		include $layout;
	}
}
