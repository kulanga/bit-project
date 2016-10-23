<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="container-fluid">
    <div class="row">

        <h2 class="text-muted">Add Submission</h2><br/>

        <div class="col-md-8">
            <?php if(validation_errors()) {?>
                <div class="validation-errors">
                    <?php echo validation_errors(); ?>
                </div>
            <?php } ?>
            
            <?php if(is_object($assignment) && $assignment->id  > 0) {?>
                <form role="form" name="manage_ac_user_form" method="post" action="student/student_assignment/submit/<?=$assignment->id?>" enctype="multipart/form-data" style="padding-bottom:65px;">
                 
                    <div class="form-group">
                        <label for="course_name"> <?=$subject->name?> - <?=$assignment->title?></label>
                    </div>
                    
                    <div class="form-group">
                        <label for="ass_submission_file">File <span class="required">*</span></label>
                        <input type="file" class="form-controlx" id="ass_submission_file" name="ass_submission_file" required/>
                    </div>

                    <div class="form-group">
                        <small><i>Supported file format: doc, docx, pdf</i></small>
                    </div>

                    <div class="form-group">
                        <a href="/admin/course" role="button" class="btn btn-danger">&nbsp;&nbsp;Exit&nbsp;&nbsp;</a>&nbsp;&nbsp;

                        <?php if(isset($course->id) && $course->id > 0) {?>
                            <button type="reset" class="btn btn-warning" data-toggle="modal" data-target="#manage_semeter_dialog">Add Semester</button>&nbsp;&nbsp;
                            <button type="submit" class="btn btn-primary" name="btn_start_create_course" value="save">Update</button>
                        <?php } else { ?>
                            <button type="submit" class="btn btn-primary" name="btn_start_create_course" value="save">Create</button>
                        <?php } ?>
                    </div>

                    <?php if(isset($course->id) && $course->id > 0) {?>
                        <div class="form-group">
                            
                        </div>   
                    <?php } ?>

                </form>
            <?php } else {?>
                <div class="red"><h3>Error -  Assignment Not Found.</h3></div>
            <?php }?>
        </div>


    </div>
</div>

