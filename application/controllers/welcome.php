<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends MY_Controller
{
	public $layout_view = 'layout/default';

	public function index()
	{
		$this->layout->view('welcome/index');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */