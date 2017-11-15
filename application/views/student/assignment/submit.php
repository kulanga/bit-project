<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="container-fluid">
    <div class="row">

        <h2 class="text-muted">Submit Assignment</h2><br/>

        <div class="col-md-8">
            <?php if(validation_errors()) {?>
                <div class="validation-errors">
                    <?php echo validation_errors(); ?>
                </div>
            <?php } ?>
            
            <?php if(is_object($assignment) && $assignment->id  > 0) {?>
                <form role="form" name="manage_ac_user_form" method="post" action="/student/student_assignment/submit/<?=$assignment->id?>" enctype="multipart/form-data" style="padding-bottom:65px;">
                 
                    <div class="form-group">
                        <label for="course_name"> <?=$subject->name?> - <?=$assignment->title?></label>
                    </div>

                    <div class="form-group">
                        <label for="course_name"> Due Date: <?=date('d-m-Y', strtotime($assignment->due_date));?></label>
                    </div>

                    <?php if(is_object($assignment_submission) > 0 ) {?>
                        <div class="form-group">
                            <span class="label label-success" style="font-size:15px;">
                                You have aready submitted the Assignment   on <?=date('d-m-Y H:i', strtotime($assignment_submission->date_submitted))?> 
                                <a href="<?=  base_url() . 'uploads/assignments/assignments/' . $assignment_submission->file_name?>">(<?=$assignment_submission->original_file_name?>)</a>
                            </span>
                        </div>

                        <div class="form-group">
                            <a href="/student/assignment" role="button" class="btn btn-danger">&nbsp;&nbsp;Back&nbsp;&nbsp;</a>&nbsp;&nbsp;
                        </div>
                    <?php } else { ?>
                    
                        <div class="form-group">
                            <label for="attachment">File <span class="required">*</span></label>
                            <input type="file" class="form-controlx" id="attachment" name="attachment" required/>
                        </div>

                        <div class="form-group">
                            <small><i>Supported file format: doc, docx, pdf</i></small>
                        </div>

                        <div class="form-group">
                            <a href="/student/assignment" role="button" class="btn btn-danger">&nbsp;&nbsp;Back&nbsp;&nbsp;</a>&nbsp;&nbsp;
                            <button type="submit" class="btn btn-primary" name="btn_start_create_course" value="save">Submit</button>
                        </div>

                    <?php } ?>

                   

                   

                </form>
            <?php } else {?>
                <div class="red"><h3>Error -  Assignment Not Found.</h3></div>
            <?php }?>
        </div>




    </div>
</div>

