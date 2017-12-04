<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>


<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">

            <h3 class="text-muted">
               Update Profile
            </h3>

            <?php if(validation_errors()) {?>
                <div class="validation-errors">
                    <?php echo validation_errors(); ?>
                </div>
            <?php } ?>

            <form role="form" name="manage_ac_user_form" method="post" action="/student/student_manage/edit_profile" enctype="multipart/form-data"/>

                <div class="form-group">
                    <label for="full_name">Reg. No.</span></label>
                    <input type="text" class="form-control" readonly="readonly" value="<?=$student->reg_no?>"/>
                </div>

                <div class="form-group">
                    <label for="full_name">Batch</span></label>
                    <input type="text" class="form-control" readonly="readonly" value="<?=$course->name?>"/>
                </div>

                <div class="form-group">
                    <label for="full_name">Name<span class="required">*</span></label>
                    <input type="text" class="form-control" id="full_name" name="full_name" value="<?=set_value('full_name', $user->full_name)?>"/>
                </div>

                <div class="form-group">
                    <label for="full_name">Profile Picture</label>
                    <input type="file" class="form-control" id="profile_image" name="profile_image"/>
                </div>

                <?php /*-- <div class="form-group">
                    <label for="staff_type">Designation<span class="required">*</span></label>
                    <select class="form-control" name="designation" id="designation">
                        <option value="0">Select</option>
                        <?php foreach($designations as $desg) {?>
                            <option value="<?=$desg->id?>" <?= $desg->id == set_value('designation', $staff->staff_designation_id) ? 'selected="selected"' : '';?>><?=$desg->designation?></option>
                        <?php } ?>
                    </select>
                </div> */?>

                <a href="/student/student_manage/change_password" class="btn btn-info">Change Password</a><br/><br/>

                <a href="/" class="btn btn-danger">Exit</a>&nbsp;&nbsp;
                <button type="submit" class="btn btn-primary">Save</button>

            </form>
        </div>
    </div>
</div>
