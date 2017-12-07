<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MY_Controller
{
    public $layout_view = 'layout/default';

    function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
    }

    function index()
    {

        if ($this->session->userdata('user_id') > 0 ) {
            redirect('/user');
        }

        $this->layout->title('Student Login');
        $data = array('login_as' => 'Student', 'panel' => 'login');

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $this->load->helper(array('form'));

            $this->load->library('form_validation');

            $this->form_validation->set_rules('username', 'username', 'trim|required|xss_clean');
            $this->form_validation->set_rules('password', 'password', 'trim|required|xss_clean|callback_check_database');

            if ($this->form_validation->run() == true) {
                redirect('user', 'refresh');
            }
        }

        $this->layout->view('login/index', $data);
    }

    function lecturer()
    {
        if ($this->session->userdata('user_id') > 0 ) {
            redirect('/user');
        }

        $data = array('login_as' => 'Lecturer', 'is_lecturer_login' => 1, 'panel' => 'login');

        $this->layout->title('Lecturer Login');
        $this->layout->view('login/index', $data);
    }

    function forget_password() {

        if ($this->session->userdata('user_id') > 0 ) {
            redirect('/user');
        }

        $data = array('panel' => 'forget_password');

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $email = $this->input->post('email');

            $this->load->model('user_model');
            $user = $this->user_model->recover_password($email);

            if ($user == false) {
            	$this->session->set_flashdata('error_message', 'User could not find.');
            	redirect('/login/forget_password');
            } else {
                $this->session->set_flashdata('success_message', "Recovery email has been sent to {$email}. Click the link in the email to reset your password.");
            	$this->send_password_recovery_email($user);
            	redirect('/login');
            }
        }

        $this->layout->title('Recover Password');
        $this->layout->view('login/index', $data);
    }

    function reset_password() {

    	$this->load->library('form_validation');

    	$key = $this->input->get('key');

    	$this->load->model('user_model');
    	$this->load->model('user_password_recovery_model');

    	$user_id = $this->user_password_recovery_model->get_userid_by_key($key);

    	if($user_id <= 0) {
            $this->session->set_flashdata('error_message', "Invalid password reset link..!");
            redirect('/login');
    	}

    	$user = $this->user_model->get($user_id);

    	if(empty($user)) {
            $this->set_flashdata('error_message', 'Authorization Failed...!');
    		redirect('/login');
            exit;
    	}

    	if ($this->input->server('REQUEST_METHOD') == 'POST') {

            $this->form_validation->set_rules('new_password', 'New Password', 'trim|required|xss_clean');
            $this->form_validation->set_rules('confirm_new_password', 'Re-enter', 'required|matches[new_password]');

            if($this->form_validation->run() == true) {
                $user_id = $user->id;
                $password = md5($this->input->post('new_password'));

                $this->user_model->update($user_id, array('password' => $password));
            	$this->user_password_recovery_model->delete_by_user($user_id);
                $this->session->set_flashdata('success_message', "Your Password has been successfully recovered.");
                redirect('/login');
            }
        }

        //Destroy if there is loged in user in same browser.
    	$this->session->sess_destroy();

    	$this->layout->view('/login/reset_password');


    }

    function check_database($password)
    {
        //Field validation succeeded.  Validate against database
        $username = $this->input->post('username');

        //query the database
        $result = $this->user_model->login($username, $password);

        if ($result) {
            $session = array();
            foreach ($result as $row) {
                $session = array(
                    'user_id' => $row->id,
                    'user_type_id' => $row->user_type_id,
                    'username' => $row->username,
                    'email'   => $row->email,
                    'full_name' => $row->full_name
                );
                $this->session->set_userdata($session);
            }

            return true;

        } else {
            $this->form_validation->set_message('check_database', 'Invalid username or password');
            return false;
        }
    }

    private function send_password_recovery_email($user) {


    	$key = $this->generate_reset_password_key($user);
    	$key = md5($key);
    	$link = base_url() . 'login/reset_password/?key='.$key;

    	$this->load->model('user_password_recovery_model');

    	//delete if exist, before generate new key.
    	$this->user_password_recovery_model->delete_by_user($user->id);
    	$this->user_password_recovery_model->insert(array('user_id' => $user->id, 'reset_key' => $key));

    	$subject = "HNDE Portal - Password Reset";

    	$message  = "<p>Hi {$user->full_name}</p>";
    	$message .=  "<p>To reset your password and access HNDE Portal, Please click on the following link.</p>";
    	$message .= "<p><a href='{$link}'>{$link}</a></p>";

    	$message .= "<p>If you did not forget your password, please ignore this email.</p>";

    	//echo $message;die;

        return send_mail($user->email, $subject, $message);
    }

    private function generate_reset_password_key($user) {
    	return $user->email . ':' . $user->full_name . ':' . $user->user_type_id . ':' . time();

    }
}