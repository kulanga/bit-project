<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Staff_timetable extends MY_Controller {

	public function __construct() {
		parent::__construct();
        $this->set_topnav('manage_timetable');
	}

    public function index() {
        $data = array();
        $course_id = (int)$this->input->get('filter_course_id');
        $this->load->model('course_model');
        $data['courses'] = $this->course_model->get_course_list();
        $data['course_id'] = $course_id;
        $this->layout->view('/staff/view_staff_timetable', $data);
    }

    public function load_events() {

        $this->load->model('timetable_model');
        
        $response =  [];
        $course_id = $this->input->post('course_id');
        $event_data_all = $this->timetable_model->get_events($course_id, $this->session->userdata('user_id'));

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
}