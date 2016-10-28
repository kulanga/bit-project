<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="col-md-12">
    <h3 class="text-muted">Manage Assignments</h3>

    <div class="dataTable_wrapper">

        <div>
            <form role="form" name="manage_ac_user_form" method="get" action="/staff/assignment" enctype="multipart/form-data">
                
                <div class="row">
                    <div class="form-group col-sm-4">
                        <label for="batch_id">Course</label>
                        <select name="batch_id"  class="form-control">
                            <option value="">All</option>
                        </select>
                    </div>

                    <div class="form-group col-sm-4">
                        <label for="subject_id">Subject</label>
                        <select name="subject_id"  class="form-control">
                            <option value="">All</option>
                        </select>
                    </div>

                    <div class="form-group col-sm-4">
                        <label for="subject_id">Status</label>
                        <select name="subject_id"  class="form-control">
                            <option value="">All</option>
                            <option value="0">Drafted</option>
                            <option value="1">Live</option>
                            <option value="2">Completed</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-sm-4">
                        <label for="due_date_from">Due Date From</label>
                        <input type="text" id="due_date_from" name="due_date_from"  class="form-control">
                    </div>

                    <div class="form-group col-sm-4">
                        <label for="due_date_to">Due Date To</label>
                        <input type="text" id="due_date_to" name="due_date_to"  class="form-control">
                    </div>

                     <div class="form-group col-sm-4">
                        <br/>
                        <button class="btn btn-primary" type="submit" value="submit">View</button>
                    </div>
                </div>

            </form>
        </div>

        <table class="table table-striped table-hover" id="subjects-table">
            <thead>
                <tr>
                    <th>Batch</th>
                    <th>Assignment</th>
                    <th>Subject</th>
                    <th>Due Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach($assignments as $assignment) { ?>
                        <?php
                            //echo '<pre>';print_r($assignment);die;
                        ?>
                    <tr>

                        <td><?=$assignment->course_name , '-' .  date('Y', strtotime($assignment->course_start))?></td>
                        <td><?=$assignment->title?></td>
                        <td><?=$assignment->subject_name?></td>
                        <td><?=date('d-m-Y', strtotime($assignment->due_date))?></td>
                        <td><?=assignment_status_in_text($assignment->status);?></td>
                        <td>
                            <a class="btn btn-sm btn-primary" href="/staff/assignment/edit/<?=$assignment->id?>">Edit&nbsp;&nbsp;<a>
                            <?php if($assignment->status == 1) {?>
                                <a class="btn btn-sm btn-success" href="/staff/staff_assignment/list_submissions/<?=$assignment->id?>">View Submissions</a>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
         
        </table>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
         $('#due_date_from').datetimepicker({
            format: "dd-mm-yyyy",
            minView : 2,
            autoclose: true,
            daysOfWeekDisabled: [0, 6],
            minDate: moment().toString()
        });

         $('#due_date_to').datetimepicker({
            format: "dd-mm-yyyy",
            minView : 2,
            autoclose: true,
            daysOfWeekDisabled: [0, 6],
            minDate: moment().toString()
        });
    });
</script>