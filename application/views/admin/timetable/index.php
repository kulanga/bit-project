<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<link rel="stylesheet" href="<?php echo asset_url();?>js/fullcalendar-2.9.1/fullcalendar.min.css">
<script type="text/javascript" src="<?php echo asset_url();?>js/fullcalendar-2.9.1/fullcalendar.min.js"></script>


<div class="col-md-10">
    <h3 class="text-muted">Time Table</h3>
    <div>
        <div class="timetable-filters dataTable_wrapper">
            <form method="get" action="/admin/timetable">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label>Batch</label>
                        <select name="filter_course_id" id="filter_course_id" class="form-control">
                            <?php foreach($courses as $course) {?>
                                <option  value="<?=$course->id?>" <?=$course->id == $course_id ? 'selected="selected"' : '' ?>><?=$course->name . ' ' . date('Y', strtotime($course->start_date))?></option>
                            <?php } ?>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label>&nbsp;</label><br/>
                        <button class="btn btn-primary">View</button>
                    </div>
                </div><br/>
            </form>
        </div>
        <div id='calendar'></div>
    </div>
</div>


<div class="modal fade" id="add_entries_dialog" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" >Add New Entry</h4>
            </div>

            <div class="modal-body">
                <div class="validation-errors"></div>
                <form id="careate_timetable_event_form" name="careate_timetable_event_form" role="form" method="post" action="/admin/admin_manage_timetable/save_event">
                    <div class="form-group col-md-6 pad-left-0">
                        <label>Batch</label>
                        <select name="batch_id" class="form-control">
                            <?php foreach($courses as $course) {?>
                                <option  value="<?=$course->id?>"><?=$course->name . ' ' . date('Y', strtotime($course->start_date))?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group col-md-6 pad-left-0">
                        <label>Subject</label>
                        <select id="subject_id" name="subject_id" class="form-control">
                            <?php foreach($subjects as $subject) {?>
                                <option value="<?=$subject->id?>"><?=$subject->code . '-' . $subject->name?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group col-md-6 pad-left-0">
                        <label>Lecturer</label>
                        <select id="lecturer_id" name="lecturer_id" class="form-control">
                            <option value="0">-</option>
                            <?php foreach($lecturers as $lecturer) {?>
                                <option value="<?=$lecturer->user_id?>"><?=$lecturer->full_name?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group col-md-6 pad-left-0">
                        <label>Location</label>
                        <select id="location_id" name="location_id" class="form-control">
                            <option value="">-</option>
                            <?php foreach($locations as $location) {?>
                                <option value="<?=$location->id?>"><?=$location->name?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Date</label>
                        <div>
                            <div class='input-group date' id='form_datetime'>
                                <input type='text' id="event_date" name="event_date" class="form-control" />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group" style="overflow:hidden">
                        <label class="col-sm-12 pad-left-0">Time</label>
                        
                        <div class="col-sm-12 pad-left-0">
                            <div class='col-sm-6 pad-left-0 input-groupx datex' id=''>
                                <input type='text' id="event_start_time" name="event_start_time" class="form-control"  placeholder="From"/>
                            </div>

                            <div class='col-sm-6 pad-left-0 input-x datex'>
                                <input type='text' id="event_end_time" data-date-format="DD MMMM YYYY hh:mm A" name="event_end_time" class="form-control" placeholder="To"/>
                            </div>
                        </div>
                    </div>

                    <div class="control-group">
   

                    <div class="form-group">
                        <label class="checkbox-inline"><input type="checkbox" id="is_repeatable" name="is_repeatable" value="1">&nbsp;Is Repeat Event</label>
                    </div>

                    <div class="form-group col-md-6 pad-left-0">
                        <label>Repeat Until</label>
                        <div>
                            <div class='input-group'>
                                <input type='text' id="repeat_end_date" name="repeat_end_date" class="form-control" />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-md-6 pad-left-0">
                        <label>Repeat Frequency</label>
                        <div>
                            <select id="event_repeat_frequency" name="event_repeat_frequency" class="form-control">
                                <option value="">-</option>
                                <option value="daily">Daily</option>
                                <option value="weekly">Weekly</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" id="modal-btn-save-event" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var timetable_course_id = '<?=$course_id?>';
    function save_timetable_event(post_data) {
        $.ajax({
            url: '/admin/admin_manage_timetable/save_event',
            type: 'post',
            dataType: 'json',
            data: post_data,
            success: function(data) {

            }

        });
    }

    $(document).ready(function() {

        $('#modal-btn-save-event').on('click', function() {
            var $content = $('#careate_timetable_event_form');

          
            if($content.find('#subject_code').val() == '') {
                alert("Please enter subject code.");
                return false;
            }
            save_timetable_event($content.serialize());
        });

        $('#form_datetime').datetimepicker({
            format: "dd-mm-yyyy",
            minView : 2,
            autoclose: true,
            daysOfWeekDisabled: [0, 6],
            minDate: moment().toString()
        });

        $('#event_start_time').datetimepicker({
            format : "hh:mm",
           
            autoclose: true
        });
        
        $('#event_end_time').datetimepicker({
           toolbarPlacement:'top',
            showTodayButton:true,
            showClose:true,
            sideBySide:true,
        });

        $('#repeat_end_date').datetimepicker({
            format: "dd-mm-yyyy",
            minView : 2,
            autoclose: true,
            daysOfWeekDisabled: [0, 6]
        });
    
        $('#calendar').fullCalendar({
             customButtons: {
                myCustomButton: {
                    text: 'New Entry',
                    class: 'btn btn-primary',
                    click: function() {
                        $('#add_entries_dialog').modal('show');
                    }
                }
            },
            header: {
                left: 'prev,next today, myCustomButton',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
        
            weekends: false,
            defaultDate: moment().format(),
            defaultView: 'agendaWeek',
            editable: true,

            businessHours: {
                start: '08:30',
                end: '16:15',
            },
            
            eventSources: [
                // your event source
                {
                    url: '/admin/admin_manage_timetable/load_events',
                    type: 'POST',
                    data: {
                        course_id: timetable_course_id,
                    },
                    error: function() {
                        alert('there was an error while fetching events!');
                    },
                    color: '#AEE6EA',   // a non-ajax option
                    textColor: 'black' // a non-ajax option
                }
            ]
       
        });
    });

</script>