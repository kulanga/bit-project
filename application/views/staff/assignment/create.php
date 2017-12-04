<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<link rel="stylesheet" href="<?php echo asset_url();?>js/jquery-file-upload/css/jquery.fileupload.css">
<link rel="stylesheet" href="<?php echo asset_url();?>js/jquery-file-upload/css/jquery.fileupload-ui.css">
<!-- CSS adjustments for browsers with JavaScript disabled -->
<noscript><link rel="stylesheet" href="<?php echo asset_url();?>js/jquery-file-upload/css/jquery.fileupload-noscript.css"></noscript>
<noscript><link rel="stylesheet" href="<?php echo asset_url();?>js/jquery-file-upload/css/jquery.fileupload-ui-noscript.css"></noscript>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">

            <h2 class="text-muted admin-page-title">
                Create a Assignment
            </h2><br/>

            <?php if(validation_errors()) {?>
                <div class="validation-errors">
                    <?php echo validation_errors(); ?>
                </div>
            <?php } ?>

            <form role="form" name="manage_ac_user_form" method="post" action="/staff/assignment/create" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="course_id">Batch<span class="required">*</span></label>
                    <select class="form-control" name="batch_id" id="batch_id">
                        <option value="">Select</option>
                        <?php foreach($courses as $course) {?>
                            <option value="<?=$course->id?>"
                            <?php echo set_value('batch_id') == $course->id ? "selected='selected'" : ''?>><?=$course->name;?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="subject_id">Subject<span class="required">*</span></label>
                    <select class="form-control" name="subject_id" id="subject_id">

                    </select>
                </div>

                <div class="form-check">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" value="1" id="is_repeat_assignment" name="is_repeat_assignment">
                      Is Repat Assignment
                    </label>
                </div><br/>

                <div id="row-repeat-of" class="form-group row hide">
                    <div class="col-md-8">
                        <label for="repeat_of_assignment_id">Repeat of <span class="required">*</span></label>
                        <select class="form-control" name="repeat_of_assignment_id" id="repeat_of_assignment_id" >
                            <option>-</option>

                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-12">
                        <label for="title">Title<span class="required">*</span></label>
                        <input type="text" class="form-control col-md-3" id="title" name="title" placeholder="Assignment 1"  value="<?=set_value('title')?>"/>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-4">
                        <label for="due_date">Due Date<span class="required">*</span></label>
                        <input type="text" class="form-control col-md-3" id="due_date" name="due_date"
                        value="<?=set_value('due_date')?>" autocomplete="off"/>
                    </div>
                </div>

                <div class="form-group">
                    <label for="description">Description<span class="required">*</span></label>
                    <textarea class="form-control" rows="10" id="description" name="description"><?=set_value('description')?></textarea>
                </div>

                <div class="form-group">
                    <label for="attachment">Attachments<span class="required">*</span></label>
                    <input type="file" id="attachment"  name="attachment">
                </div>

                <div class="form-group">
                    <button type="reset" class="btn btn-default">Reset</button>&nbsp;&nbsp;
                    <button type="submit" class="btn btn-primary" name="btn_create" value="create">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {

        $('#batch_id').on('change', function() {
            var semesters = get_subjects_in_curret_semster($(this).val());

            $('#subject_id option').remove();

            var options = '<option value="">-</option>';
            $.each(semesters, function(i, v) {
                options += '<option value="'+v.subject_id+'">'+v.name+'</option>';
            });
            $('#subject_id').html(options);
        });

        $('#batch_id').trigger('change');


        $('#due_date').datetimepicker({
            format: "dd-mm-yyyy",
            minView : 2,
            autoclose: true,
            startDate: new Date()
        });

        $('#is_repeat_assignment').on('click', function(){
            if($(this).is(':checked')) {
                $('#row-repeat-of').removeClass('hide');
            } else {
                $('#row-repeat-of').addClass('hide');
            }
        });

        $('#repeat_of_assignment_id').on('focus', function(){
            //Alert when there are no main Assignments.
            if ($('#repeat_of_assignment_id option').length <= 0 ) {
                bootbox.alert("There are no main Assignments found for selected criteria.");
                $('#is_repeat_assignment').click();
            }
        });

        $('#subject_id').on('change', function(){
            var subject_id = $(this).val();
            var course_id = $('#batch_id').val();

            if(!course_id || !subject_id) {
                return false;
            }

            $.ajax({
                url: '/staff/staff_assignment/get_assignment_list_for_repeat_assignment',
                type: 'post',
                data: {'course_id': course_id, 'subject_id': subject_id},
                dataType: 'json',
                success: function(res) {
                    $('#repeat_of_assignment_id').html(res.list);
                },
                error: function(err) {
                    alert('An error occurred. Please try again later.');
                }
            });


        });
    })
</script>
