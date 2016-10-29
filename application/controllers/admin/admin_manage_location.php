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
}