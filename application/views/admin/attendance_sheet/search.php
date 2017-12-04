<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<script type="text/javascript" src="/assets/js/admin_course.js"></script>

<div class="col-md-offset-2 col-md-10">
    <h3 class="text-muted" style="text-align:left;">Print Students Attendance Sheet</h3>
    <div class="dataTable_wrapper">
        <div>
            <form role="form" name="manage_ac_user_form" method="post" action="/admin/admin_attendance_sheet/printview">

                <div class="row">

                    <div class="form-group col-sm-3">
                        <label for="batch_id">Cource</label>
                        <select name="batch_id" id="batch_id"  class="form-control" required>
                            <option value="">Select</option>
                            <?php foreach($courses as $course) {?>
                                <option value="<?=$course->id?>"><?=$course->name?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group col-sm-3">
                        <label for="subject_id">Subject<span class="required">*</span></label>
                        <select class="form-control" name="subject_id" id="subject_id">

                        </select>
                    </div>

                    <div class="form-group col-sm-3">
                        <br/>
                        <button class="btn btn-primary" type="submit" value="submit">Print</button>
                    </div>

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
    });
</script>