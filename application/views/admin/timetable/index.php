<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<link rel="stylesheet" href="<?php echo asset_url();?>js/fullcalendar-2.9.1/fullcalendar.min.css">
<link rel="stylesheet" href="<?php echo asset_url();?>js/bootstrap-slider/bootstrap-slider.min.css">

<script type="text/javascript" src="<?php echo asset_url();?>js/fullcalendar-2.9.1/fullcalendar.min.js"></script>
<script type="text/javascript" src="<?php echo asset_url();?>js/bootstrap-slider/bootstrap-slider.min.js"></script>


<div class="col-md-10">
    <h3 class="text-muted">View Time Table</h3>
    <div>
        <div class="timetable-filters dataTable_wrapper">
            <form name="timetable_fileters_form" id="timetable_fileters_form" method="get" action="/admin/timetable">
                <div class="row">
                    <div class="form-group col-md-3">
                        <label>Batch</label>
                        <select name="filter_course_id" id="filter_course_id" class="form-control">
                            <?php foreach ($courses as $cs) {?>
                                <?php if (in_array($cs->status, array(1,2))) {?>
                                    <option  value="<?=$cs->id?>" <?=$cs->id == $course_id ? 'selected="selected"' : '' ?>>
                                    <?=$cs->name;?></option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group col-md-3">
                        <label>Semester</label>
                        <select name="filter_semester_id" id="filter_semester_id" class="form-control">
                            <option  value="0">-</option>
                            <?php foreach ($semesters as $sem) {?>
                                <option  value="<?=$sem->id?>"
                                <?=$sem->id == $current_semester_id ? 'selected="selected"' : '' ?>>
                                <?= 'Year ' . $sem->semester_year . ' Semester#' . $sem->semester_number;?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group col-md-3 pad-left-0">
                        <label for="filter_lecturer_id">Lecturer <span class="required">*</span></label>
                        <select id="filter_lecturer_id" name="filter_lecturer_id" class="form-control">
                            <option value="0">-</option>
                            <?php foreach($lecturers as $lecturer) {?>
                                <option <?php echo isset($params['filter_lecturer_id']) && $params['filter_lecturer_id'] == $lecturer->user_id ? 'selected="selected"' : '';?>  value="<?=$lecturer->user_id?>"><?=$lecturer->full_name?></option>
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
                <div class="validation-errors" style="display:none;"></div>
                <form id="careate_timetable_event_form" name="careate_timetable_event_form" role="form" method="post" action="/admin/admin_manage_timetable/save_event">

                    <div class="form-group col-md-6 pad-left-0">
                        <label>Batch:</label><br/>
                        <input type="hidden" name="batch_id" value="<?=$course_id?>">
                        <span><?=$course->name?></span>
                    </div>

                    <div class="form-group col-md-6 pad-left-0">
                        <label>Subject <span class="required">*</span></label>
                        <select id="subject_id" name="subject_id" class="form-control">
                            <?php foreach($subjects as $subject) {?>
                                <option value="<?=$subject->id?>"><?=$subject->code . '-' . $subject->name?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group col-md-6 pad-left-0">
                        <label>Lecturer <span class="required">*</span></label>
                        <select id="lecturer_id" name="lecturer_id" class="form-control">
                            <option value="">-</option>
                            <?php foreach($lecturers as $lecturer) {?>
                                <option value="<?=$lecturer->user_id?>"><?=$lecturer->full_name?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group col-md-6 pad-left-0">
                        <label>Location <span class="required">*</span></label>
                        <select id="location_id" name="location_id" class="form-control">
                            <option value="">-</option>
                            <?php foreach($locations as $location) {?>
                                <option value="<?=$location->id?>"><?=$location->name?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Date <span class="required">*</span></label>
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
                        <label class="col-sm-6 pad-left-0">Start Time <span class="required">*</span></label>
                        <label class="col-sm-6 pad-left-0">End Time <span class="required">*</span></label>

                        <div class="col-sm-12 pad-left-0">
                            <div class='col-sm-6 pad-left-0 input-groupx' id=''>
                                <input type='text' id="event_start_time" name="event_start_time" class="form-control"  readonly="readonly" />

                                &nbsp; &nbsp;<input id="event_start_time_picker" data-slider-id='event_start_time_slider' type="text" data-slider-min="510" data-slider-max="975" data-slider-step="15" data-slider-value="510"/>
                            </div>

                            <div class='col-sm-6 pad-left-0 input-x'>
                                <input type='text' id="event_end_time" name="event_end_time" class="form-control" readonly="readonly" />

                                &nbsp;<input id="event_end_time_picker" data-slider-id='event_end_time_slider' type="text" data-slider-min="510" data-slider-max="975" data-slider-step="15" data-slider-value="510"/>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="checkbox-inline"><input type="checkbox" id="is_repeatable" name="is_repeatable" value="1">&nbsp;Is Repeat Event</label>
                    </div>

                    <div class="form-group col-md-6 pad-left-0 event-repeat-settings hide">
                        <label>Repeat Until <span class="required">*</span></label>
                        <div>
                            <div class='input-group'>
                                <input type='text' id="repeat_end_date" name="repeat_end_date" class="form-control" />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-md-6 pad-left-0 event-repeat-settings hide">
                        <label>Repeat Frequency <span class="required">*</span></label>
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
    var filter_semester_id = '<?php if(isset($params['filter_semester_id'])) { echo $params['filter_semester_id']; } else {echo $current_semester_id;}?>'
    var filter_lecturer_id = '<?=isset($params['filter_lecturer_id']) ? $params['filter_lecturer_id'] : 0?>'

    function save_timetable_event(post_data) {

        post_data.push({name:'semester_id', value:filter_semester_id});
        $.ajax({
            url: '/admin/admin_manage_timetable/save_event',
            type: 'post',
            dataType: 'json',
            data: post_data,
            success: function(data) {
                if(data.errors) {
                    $('#add_entries_dialog').find('.validation-errors').show();
                    $('#add_entries_dialog').find('.validation-errors').html(data.errors);
                } else {
                    //$('#calendar').fullCalendar('refetchEvents');
                    window.location.href = window.location.href;
                }
            }

        });
    }

    $(document).ready(function() {

        $('#filter_course_id').on('change', function(){
            $('#timetable_fileters_form').submit();
        })

        $('#modal-btn-save-event').on('click', function() {
            var $content = $('#careate_timetable_event_form');

            if($content.find('#subject_code').val() == '') {
                alert("Please enter subject code.");
                return false;
            }
            save_timetable_event($content.serializeArray());
        });

        $('#form_datetime').datetimepicker({
            format: "dd-mm-yyyy",
            minView : 2,
            autoclose: true,
            daysOfWeekDisabled: [0, 6],
            minDate: moment().toString()
        });

        $('#repeat_end_date').datetimepicker({
            format: "dd-mm-yyyy",
            minView : 2,
            autoclose: true,
            daysOfWeekDisabled: [0, 6]
        });

        $('#is_repeatable').on('click', function() {
            if($(this).is(':checked') && $(this).val() == '1') {
                $('.event-repeat-settings').removeClass('hide');
            } else {
                $('.event-repeat-settings').addClass('hide');
            }
        });

        $('#event_start_time_picker').slider({
            formatter: function(value) {
                var hour = Math.floor(value/60);
                var mins =  (value%60);
                if(hour < 10) {
                    hour = '0' + hour;
                }
                if(mins == 0) {
                    mins = '00';
                }
                var val = hour + ':' + mins;
                $('#event_start_time').val(val);
                return val;
            }
        });

        $('#event_end_time_picker').slider({
            formatter: function(value) {
                var hour = Math.floor(value/60);
                var mins =  (value%60);
                if(hour < 10) {
                    hour = '0' + hour;
                }
                if(mins == 0) {
                    mins = '00';
                }
                var val = hour + ':' + mins;

                $('#event_end_time').val(val);
                return  val;
            }
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
                        sem_id: filter_semester_id,
                        lecturer_id: filter_lecturer_id

                    },
                    error: function() {
                        alert('there was an error occurred while fetching events!');
                    },
                    color: '#AEE6EA',   // a non-ajax option
                    textColor: 'black' // a non-ajax option
                }
            ],

            eventRender: function(event, element) {
                element.find('.fc-content').prepend("<span style='float:right;margin:2px;' class='delete-event label label-danger'>X</span>" );
                element.find(".delete-event").click(function() {

                    var is_parent = event.has_child_events;

                    var confirm_popup_html = "Are you sure, You want to delete this from timetable ?";
                    if(is_parent == 1) {
                        confirm_popup_html  = "<p>Are you sure, You want to delete this from timetable ?</p>";
                        confirm_popup_html += "<p>Please note that, this event has repeat events.</p>";
                        confirm_popup_html += "<p><input type='checkbox' value='1' id='delete_all'/> <strong>Delete all repeate event of this event.</strong></p>"
                    }

                    bootbox.confirm(confirm_popup_html, function(confirm) {
                        if(confirm) {
                            delete_timetable_event(event._id);
                        }
                    });
                });
            }
        });
    });

    function delete_timetable_event(id) {
        var remove_childs = $('#delete_all').is(':checked') ? 1 : 0;
        $.ajax({
            url: '/admin/admin_manage_timetable/delete/' + id + '/' + remove_childs,
            type: 'get',
            success: function(data) {
                if(data == '1') {
                    $('#calendar').fullCalendar( 'refetchEvents' );
                    //$('#calendar').fullCalendar('removeEvents', id);
                } else {
                    bootbox.alert('An error occured. Please reload page the page and try again.')
                }
            }
        });
    }

</script>