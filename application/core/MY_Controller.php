<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
	public $layout_view = 'layout/default';
 	//protected $layout = 'default';
 	protected $module = '';

	public function __construct()
	{
		parent::__construct();

		// Site global resources
		$this->layout->title('HNDE Stduents Portal');

		$check_session = true;
		if($this->uri->segment(1) == 'login') {
			$check_session = false;
		}

		if($this->uri->uri_string() == 'student/signup') {
			$check_session = false;
		}


		if($check_session && (int)$this->session->userdata('user_id') <= 0) {
			redirect('/login');
		}

		$this->layout->user($this->session->userdata);
	}

	protected function set_topnav($top_nav) {
		$this->layout->top_nav($top_nav);
	}
	
}