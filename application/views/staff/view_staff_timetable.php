<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>


<link rel="stylesheet" href="<?php echo asset_url();?>js/fullcalendar-2.9.1/fullcalendar.min.css">
<script type="text/javascript" src="<?php echo asset_url();?>js/moment.min.js"></script>
<script type="text/javascript" src="<?php echo asset_url();?>js/fullcalendar-2.9.1/fullcalendar.min.js"></script>

<div class="col-md-10">
    <h3 class="text-muted">My Time Table</h3>
    <div>
        <div class="timetable-filters dataTable_wrapper">
            <form method="get" action="/staff/my-timetable">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label>Batch</label>
                        <select name="filter_course_id" id="filter_course_id" class="form-control">
                            <option value="-1">All</option>
                            <?php foreach($courses as $course) {?>
                                <option  value="<?=$course->id?>" <?=$course->id == $course_id ? 'selected="selected"' : '' ?>><?=$course->name . ' ' . date('Y', strtotime($course->start_date))?></option>
                            <?php } ?>
                        </select>
                    </div>
                    
                </div><br/>
            </form>
        </div>

        <div id='calendar'></div>
    </div>
</div>

    
<script type="text/javascript">
    var timetable_course_id = '<?=$course_id?>';

    $(document).ready(function() {
        
        $('#filter_course_id').on('change', function() {
            timetable_course_id = $(this).val();
            reload_events(timetable_course_id);
        });
        
        $('#calendar').fullCalendar({
            customButtons: {
            },
            header: {
                left: 'prev,next today, myCustomButton',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
        
            weekends: false,
            defaultDate: moment().format(),
            defaultView: 'agendaWeek',
            editable: false,

            businessHours: {
                start: '08:30',
                end: '16:15',
            },
        });

        reload_events($('#filter_course_id').val());
    });

    function reload_events(cid) {
        var events = {
            url: '/staff/staff_timetable/load_events',
            type: 'POST',
            data: {
                course_id: cid,
            },
            color: '#AEE6EA',
            textColor: 'black'
        }

        $('#calendar').fullCalendar( 'removeEventSource', events);
        $('#calendar').fullCalendar( 'addEventSource', events);         
        $('#calendar').fullCalendar( 'refetchEvents' );
    }

</script>