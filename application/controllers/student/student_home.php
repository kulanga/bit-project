<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Student_home extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->module = "student";
	}

    public function test() {
    	
    	$this->render();
    }
}
