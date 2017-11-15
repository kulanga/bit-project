<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_manage_location extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->set_topnav('location');
    }

    public function add_location() {

        $this->load->model('location_model');
        $this->load->library('form_validation');
        
        $btn = $this->input->post('btn_create');       
        
        if(!empty($btn))
        {
            $this->form_validation->set_rules('location_name', 'Location', 'trim|required|xss_clean');
            $data['name'] = $this->input->post('location_name');
            $this->location_model->insert($data);
        }

        $this->layout->view('/admin/manage_location/add');
    }

    public function list_location() {
        $this->load->model('location_model');
        $data = array();
        $data['list'] = $this->location_model->get_locations(); 

        $this->layout->view('/admin/manage_location/list', $data);
    }

    public function del_location($id)
    {
        if($id > 0) {
            $this->load->model('location_model');
            $this->location_model->delete($id);
            echo '1'; die;
        }
        echo '0'; die;
    }

    public function test() {
        $result = send_mail('ranasinghe.thushan@gmail.com', 'Email Test 3', "xxxs shsjsus");
        show_error($result);
        echo 'D';die;
    }
}