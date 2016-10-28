<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="container-fluid">
    <div class="row">

        <h2 class="text-muted admin-page-title">
            Course Settings
        </h2><br/>

        <div class="col-md-8">
            <?php if(validation_errors()) {?>
                <div class="validation-errors">
                    <?php echo validation_errors(); ?>
                </div>
            <?php } ?>
            
            <form role="form" name="manage_ac_user_form" method="post" action="/admin/admin_manage_course/settings/<?=$course->id?>" style="padding-bottom:65px;">
                <div class="form-group">
                    <label for="course_name">Course:</label>
                    <span><?=course_name($course)?></span>
                </div>

                 <div class="form-group">
                    <label for="current_semester_id">Current Semester</label>
                    <select name="current_semester_id" id="current_semester_id" class="form-control">
                        <option>Select</option>
                        <?php foreach($semesters as $sem) {?>
                            <option <?=$course->current_semester_id == $sem->id ? 'selected="selected"' : '';?> value="<?=$sem->id?>">Year <?=$sem->semester_year?> Semester#<?=$sem->semester_number?></option>
                        <?php } ?>
                    </select>
                </div>

                <a type="Back" class="btn btn-danger" href="/admin/course">Exit</a>&nbsp;&nbsp;
                <button type="submit" name="btn_save_settings" value="btn_save_settings" class="btn btn-primary">Save</button>

            </form>
        </div>
    </div>
</div>
