<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
	public $layout_view = 'layout/default';
 	//protected $layout = 'default';
 	protected $module = '';

	public function __construct()
	{
		parent::__construct();
		
//		if (!$this->session->userdata('user')) {
//			redirect('login');
//		}

		// Site global resources
		$this->layout->title('HNDE Stduents Portal');
		$this->layout->js('js/jquery.min.js');
		$this->layout->css('css/site.css');
		$this->layout->user($this->session->userdata('user'));

	}

	protected function render($data = array(), $view_path = "")
	{
		//set layout
		if(empty($view_path)) {
			$controller = $this->router->fetch_class();

			$controller_arr = explode("_", $this->router->fetch_class(), 2);

			$controller_view_path = '';

			if(count($controller_arr) > 1) {
				$this->module = strtolower($controller_arr[0]);
				$controller_view_path = strtolower($controller_arr[1]);
			} else {
				$controller_view_path = $controller_arr[0];
			}

			//set layout based module requested.
			if($this->module == 'admin') {
				$data['layout'] = $this->module;
			}

			//override layoout from controller.
			if($this->layout !== 'default') {
				$data['layout'] = $this->layout;
			}

			$view = $this->router->fetch_method();
			$view_path = $this->module . '/' . $controller_view_path . '/' . $view;
		}
		$this->load->view($view_path, $data);
	}
}