<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends MY_Controller
{
	public $layout_view = 'layout/default';

	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('user')) {
			redirect('login');
		}
	}

	public function index()
	{
		$this->layout->view('user/index');
	}

	function logout()
	{
		$this->session->sess_destroy('user');
		redirect('user');
	}

}