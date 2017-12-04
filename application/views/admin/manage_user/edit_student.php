<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>


<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">

            <h3 class="text-muted">
               Update Student Profile
            </h3>

            <?php if(validation_errors()) {?>
                <div class="validation-errors">
                    <?php echo validation_errors(); ?>
                </div>
            <?php } ?>

            <form role="form" name="manage_ac_user_form" method="post" action="/admin/admin_manage_user/edit_student/<?=$student->user_id?>" enctype="multipart/form-data"/>


                <div class="form-group">
                    <img width="100" src="<?=profile_image($student->user_id)?>">
                </div>

                <div class="form-group">
                    <label for="full_name">Batch</span></label>
                    <select class="form-control" name="course_id" id="course_id">
                        <option value="0">-</option>
                        <?php foreach($courses as $crs) {?>
                            <option value="<?=$crs->id?>" <?= $crs->id == set_value('course_id', $student->course_id) ? 'selected="selected"' : '';?>>
                                <?=$crs->name?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="full_name">Name<span class="required">*</span></label>
                    <input type="text" class="form-control" id="full_name" name="full_name" value="<?=set_value('full_name', $user->full_name)?>"/>
                </div>

                <div class="form-group">
                    <label for="full_name">Reg. No.<span class="required">*</span></span></label>
                    <input type="text" class="form-control" name="reg_no" value="<?=set_value('reg_no', $student->reg_no)?>"/>
                </div>

                <div class="form-group">
                    <label for="full_name">Email<span class="required">*</span></span></label>
                    <input type="email" class="form-control" name="email" value="<?=set_value('email', $user->email)?>"/>
                </div>

                <div class="form-group">
                    <label for="full_name">Phone<span class="required">*</span></span></label>
                    <input type="number" class="form-control" name="phone" value="<?=set_value('phone', $user->mobile_no)?>"/>
                </div>

                <div class="form-group">
                    <label for="status">Status<span class="required">*</span></label>
                    <select class="form-control" name="status" id="status">
                        <option value="1" <?=$user->status == 1 ? 'selected="selected"' : '';?>>Active</option>
                        <option value="2" <?=$user->status == 3 ? 'selected="selected"' : '';?>>Deleted</option>
                    </select>
                </div>

                <a href="/admin/student/list" class="btn btn-danger">Exit</a>&nbsp;&nbsp;
                <button type="submit" class="btn btn-primary">Save</button><br/><br/>
            </form>
        </div>
    </div>
</div>
