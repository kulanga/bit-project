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
		//$this->layout->js('js/jquery.min.js');
		//$this->layout->css('css/site.css');
		$this->layout->user($this->session->userdata);

	}

	protected function set_topnav($top_nav) {
		$this->layout->top_nav($top_nav);
	}
}