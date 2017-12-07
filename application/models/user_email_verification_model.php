<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User_email_verification_model extends CI_Model
{
    //allowed login types.
    private $table = 'user_email_verifications';
    
    public function __construct()
    {
        parent::__construct();
    }

    public function get($id = 0) {
        $this->db->where('id', $id);
        $query = $this->db->get($this->table);
        return $query->first_row();
    }

    public function insert($data = array()) {
        if (!$this->db->insert($this->table, $data)) {
            return false;
        }
        return $this->db->insert_id();
    }

    public function update($id, $data = array()) {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    public function get_by_user($user_id) {
    	$query = $this->db->where('user_id', $user_id)
    				->where('status', 0)
    				->order_by('timestamp', 'desc')
    				->get($this->table);

		return $query->first_row();
    }

    public function delete_by_user($user_id) {
        $this->db->where('user_id', $user_id);
        $this->db->where('status', '0');
        return $this->db->delete($this->table);
    }

    public function send($user_id, $is_resend = 0) {

    	$this->load->model('user_model');
        $user = $this->user_model->get($user_id);

        //already verified.
        if($user->is_email_verified == 1) {
        	return false;
        }

        $timestamp = time();

        if($is_resend) {
        	$this->delete_by_user($user_id);
        }

        $this->insert( array(
            'user_id' => $user_id,
            'timestamp' => $timestamp
            )
        );

        $hash = $user_id . $user->username . $timestamp;
        $hash = md5($hash);

        $url = base_url() . "user/verify_email/$user_id/$hash";

        $subject  = 'Welcome to HNDE Students Portal';

        $message  = "<p>Hello " . $user->full_name . "</p>";
        $message .= "<p>You have been successfully sign up to HNDE Students Portal.</p>";
        $message .= "<p>We want to verify that you are indeed '" . $user->full_name . "'. If you wish to continue, please follow the link below:</p>";
        $message .= "<p/><a href='$url'>$url</a></p>";
        $message .= "If you're not ".  $user->full_name ." or didn't request verification, you can ignore this email.";

        return send_mail($user->email, $subject, $message);

    }

}