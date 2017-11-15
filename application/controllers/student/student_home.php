<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Student_home extends MY_Controller {

	public function __construct() {
		parent::__construct();
	}

    public function index() {
        $data = array();
        $this->layout->view('/student/home/dashboard', $data);
    }

    public function view_timetable() {
        $data = array();

        $course_id = (int)$this->input->get('filter_course_id');
        $this->load->model('course_model');
        $data['course_id'] = $course_id;
        $this->layout->view('/student/home/view_timetable', $data);
    }

    public function load_events() {

        $this->load->model('timetable_model');
        $this->load->model('student_model');

        $student = $this->student_model->get_by_userid($this->session->userdata('user_id'));
      
        $response =  [];
        $event_data_all = $this->timetable_model->get_events($student->course_id, 0);

        $events = [];
        foreach($event_data_all as $event) {

            $title  = $event->subject_name ;
            $title .= ' ' . $event->location_name;
            $events[] = array(
                'id' => $event->id,
                'title' => $title,
                'start' => $event->date . 'T' . $event->time_from,
                'end' => $event->date . 'T' . $event->time_to,
                'allDay' => false
            );
        }

        $response['events'] = $events;

        echo json_encode($events);
        exit;
    }

    public function welcome() {

        $this->load->model('user_model');
        $user_id =  $this->session->userdata('user_id');

        $user = $this->user_model->get($user_id);

        if(is_object($user) && $user->status == 1) {
            redirect('student/timetable');
        }
        $this->layout->view('/student/home/welcome', array('user' => $user));
    }

    public function my_acc_profile() {

        $this->load->model('student_model');

        $user_id = $this->session->userdata('user_id');
        $res = $this->student_model->get_accedemic_profile($user_id);


        // echo '<pre>';
        // print_r($res);die;

        $this->layout->view('/student/home/acc_profile', array('data' => $res));


    }

}
