<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
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
                <form role="form" name="manage_ac_user_form" method="post" action="/student/student_assignment/submit/<?=$assignment->id?>" enctype="multipart/form-data" style="padding-bottom:65px;">
                 
                    <div class="form-group">
                        <label>Title:</label><br/>
                        <label style="font-weight:normal"><?=$subject->name?> - <?=$assignment->title?></label>
                    </div>

                    <div class="form-group">
                        <label>Due Date:</label><br/>
                        <label><?=date('d-m-Y', strtotime($assignment->due_date));?></label>
                    </div>
                    <div class="form-group">
                        <label style="vertical-align: top;">Description:</label><br/>
                        <label>
                            <?=nl2br($assignment->description)?>
                        </label>
                    </div>

                    <div class="form-group">
                        <label for="attachment">Uploaded Attachments</span></label>
                        <ul>
                            <?php foreach($assignment_attachments as $attachment) { ?>
                                <li><a href="<?=base_url() . 'uploads/assignments/assignments/' . $attachment->file_name?>" title="<?=$attachment->original_file_name?>">Download<a></li>
                            <?php } ?>
                        </ul>
                    </div>

                    <div class="form-group">
                        <a href="/student/assignment" role="button" class="btn btn-danger">&nbsp;&nbsp;Back&nbsp;&nbsp;</a>&nbsp;&nbsp;
                    </div>

                </form>
            <?php } else {?>
                <div class="red"><h3>Error -  Assignment Not Found.</h3></div>
            <?php }?>
        </div>




    </div>
</div>

