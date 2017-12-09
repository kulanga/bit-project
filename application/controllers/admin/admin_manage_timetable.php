<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_manage_timetable extends MY_Controller {

	public function __construct() {
		parent::__construct();
        $this->set_topnav('manage_timetable');

	}

    public function index() {
        $data = array();

        $course_id = (int)$this->input->get('filter_course_id');
        $semester_id = (int)$this->input->get('semester_id');
        $sem_id =  (int)$this->input->get('filter_semester_id');
        $filter_lecturer_id = (int)$this->input->get('filter_lecturer_id');

        $this->load->model('course_model');
        $this->load->model('course_semester_model');
        $this->load->model('course_subject_model');
        $this->load->model('staff_model');
        $this->load->model('location_model');

        $data['locations'] = $this->location_model->get_locations();
        $data['courses'] = $this->course_model->get_course_list();

        if((int)$course_id <= 0 && count($data['courses']) > 0 ) {
            $first_course = reset($data['courses']);
            $course_id = $first_course->id;
        }

        $data['course_id'] = $course_id;

        if($course_id > 0 ) {
            $data['course'] = $this->course_model->get($course_id);
            $data['lecturers'] = $this->staff_model->get_stffs();
            $data['semesters'] = $this->course_semester_model->get_by_course($course_id);

            $data['current_semester_id'] = 0;

            if(is_object($data['course'])) {

                $data['current_semester_id'] = $sem_id > 0 ? $sem_id : $data['course']->current_semester_id;
                $data['semester'] = $this->course_semester_model->get($data['current_semester_id']);
                if(is_object($data['semester'])) {
                    $data['subjects'] = $this->course_subject_model->get_by_semester($data['semester']->id);
                }
            }
        }

        $data['params'] = $this->input->get();

        $this->layout->view('/admin/timetable/index', $data);

    }

    public function load_events() {

        $this->load->model('timetable_model');

        $response =  [];
        $course_id = $this->input->post('course_id');
        $sem_id = $this->input->post('sem_id');
        $lecturer_id = $this->input->post('lecturer_id');

        $event_data_all = $this->timetable_model->get_events($course_id, $lecturer_id, $sem_id);

        $events = [];
        foreach($event_data_all as $event) {

            $is_recurring = $this->timetable_model->chek_is_recurring_event($event->id);

            $title  = $event->subject_name ;
            $title .= ' ' . $event->location_name;
            $title .= ' Lecturer:' . $event->full_name;
            $events[] = array(
                'id' => $event->id,
                'title' => $title,
                'start' => $event->date . 'T' . $event->time_from,
                'end' => $event->date . 'T' . $event->time_to,
                'allDay' => false,
                'borderColor' => $is_recurring ? 'red' : '',
                'has_child_events' => $is_recurring ?  1 : 0,
            );
        }

        $response['events'] = $events;

        echo json_encode($events);
        exit;
    }

    public function save_event() {

        $this->load->library('form_validation');
        $this->load->model('timetable_model');

        $data = [];

        $this->form_validation->set_rules('batch_id', 'Batch', 'trim|required|xss_clean');
        //$this->form_validation->set_rules('semester_id', 'Semester', 'trim|required|xss_clean');
        $this->form_validation->set_rules('subject_id', 'Subject', 'trim|required|xss_clean');
        $this->form_validation->set_rules('lecturer_id', 'LecturerX', 'trim|required|xss_clean|numeric');
        $this->form_validation->set_rules('location_id', 'Location', 'trim|required|xss_clean');
        $this->form_validation->set_rules('event_date', 'Date', 'trim|required|xss_clean');
        $this->form_validation->set_rules('event_start_time', 'Start Time', 'trim|required|xss_clean');
        $this->form_validation->set_rules('event_end_time', 'End Time', 'trim|required|xss_clean|callback_event_end_time');


        $is_repeatable = $this->input->post('is_repeatable');
        $is_repeatable_event  = false;
        if(!empty($is_repeatable) && $is_repeatable == '1') {
            $this->form_validation->set_rules('repeat_end_date', 'Repeat Until', 'trim|required|xss_clean');
            $this->form_validation->set_rules('event_repeat_frequency', 'Frequency', 'trim|required|xss_clean');
            $is_repeatable_event = true;

        }

        if($this->form_validation->run() === true) {

            $event_date = convert_db_date_format($this->input->post('event_date'));
            $event_start_time = $this->input->post('event_start_time');
            $event_end_time = $this->input->post('event_end_time');

            $save_events =  [];
            $save_event = array(
                'course_id' => $this->input->post('batch_id'),
                'subject_id' => $this->input->post('subject_id'),
                'date' => $event_date,
                'time_from' => $this->input->post('event_start_time'),
                'time_to' => $this->input->post('event_end_time'),
                'lecturer_id' => $this->input->post('lecturer_id'),
                'location_id' => $this->input->post('location_id'),
                'semester_id' => $this->input->post('semester_id'),
                'parent_event_id' => 0,
            );

            $save_events[0] = $save_event;

            if($is_repeatable_event) {
                $repeat_end_date = convert_db_date_format($this->input->post('repeat_end_date'));
                $event_repeat_frequency = $this->input->post('event_repeat_frequency');

                $next_date = $event_date;
                do {

                    if($event_repeat_frequency == 'daily') {
                        $next_date = date('Y-m-d', strtotime("$next_date +1 Day"));

                    } elseif($event_repeat_frequency == 'weekly') {
                        $next_date = date('Y-m-d', strtotime("$next_date +7 Day"));

                    } else {
                        $next_date = $repeat_end_date;
                    }

                    //ignore if next day is a weekend.
                    if($event_repeat_frequency == 'daily' && in_array(date('w', strtotime($next_date)), array(0, 6))) {
                        continue;
                    }

                    $save_event['date'] = $next_date;
                    $save_event['parent_event_id'] = -1;
                    $save_events[] = $save_event;

                } while ($next_date < $repeat_end_date);
            }

            $validation_errors = $this->validate_events_before_save($save_events);
            $parent_event_id = 0;

            if($validation_errors == '') {

                foreach($save_events as $key => $event) {

                    $event['parent_event_id'] = $parent_event_id;
                    $eid = $this->timetable_model->insert($event);

                    //parent event
                    if($key == 0) {
                        $parent_event_id = $eid;
                    }
                }
            } else {
               $data['success'] = 0;
               $data['errors'] = $validation_errors;
            }

            if($parent_event_id > 0 ) {
                $data['success'] = 1;
            }
        } else {
            $data['errors'] = validation_errors();
        }

        echo json_encode($data);
        exit;
    }

    public function delete($event_id = 0, $remove_childs = 0) {

        if($event_id > 0 ) {
            $this->load->model('timetable_model');
            $this->timetable_model->delete($event_id);

            //Delete all repeat events
            if($remove_childs == 1 ) {
                $this->timetable_model->delete_by_parentid($event_id);
            }
            echo '1'; die;
        }
        echo '0'; die;
    }

    function event_end_time($event_endtime) {
        $event_starttime = date('Y-m-d') . ' '. $this->input->post('event_start_time') . ':00';
        $event_endtime = date('Y-m-d') . ' '. $event_endtime . ':00';
        $event_starttime_int = strtotime($event_starttime);
        $event_endtime_int = strtotime($event_endtime);

        if ($event_endtime_int <= $event_starttime_int) {
            $this->form_validation->set_message('event_end_time', 'End Time should be greater than Start Time');
            return false;
        }
        return true;
    }

    private function validate_events_before_save($events) {

        $this->load->model('timetable_model');

        $error = '';

        foreach($events as $event) {

            $ret = $this->timetable_model->check_lecturer_is_availeble($event['lecturer_id'], $event['date'], $event['time_from'], $event['time_to']);
            if(!$ret) {
                $error = "<p>Selected Lecturer is not available from {$event['time_from']} to {$event['time_to']} on {$event['date']}</p>";
                break;
            }



        }

        return $error;

    }
}