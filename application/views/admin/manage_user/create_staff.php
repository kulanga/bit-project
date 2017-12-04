<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<?php
    $titles = array(
        '', 'Prof.', 'Mr.', 'Mrs.', 'Miss'
    );
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">

            <h3 class="text-muted">
                Add New Staff Member
            </h3>

            <?php if(validation_errors()) {?>
                <div class="validation-errors">
                    <?php echo validation_errors(); ?>
                </div>
            <?php } ?>

            <form role="form" name="manage_ac_user_form" method="post" action="/admin/staff/new">

                <div class="form-group">
                    <label for="full_name">Title<span class="required">*</span></label>
                    <select class="form-control" name="title" style="max-width:150px;">
                        <?php foreach($titles as $title) {?>
                            <option value="<?=$title?>" <?php echo set_value('title') == $title ? 'selected="selected"' : '';?>><?=$title?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="full_name">Full Name<span class="required">*</span></label>
                    <input type="text" class="form-control" id="full_name" name="full_name" value="<?=set_value('full_name')?>"/>
                </div>

                <div class="form-group">
                    <label for="staff_type">Designation<span class="required">*</span></label>
                    <select class="form-control" name="designation" id="designation">
                        <option value="0">Select</option>
                        <?php foreach($designations as $desg) {?>
                            <option value="<?=$desg->id?>" <?= $desg->id == set_value('designation') ? 'selected="selected"' : '';?>><?=$desg->designation?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="email">Email (as Username)<span class="required">*</span></label>
                    <input type="email" class="form-control" id="email" name="email" value="<?=set_value('email')?>"/>
                </div>

                <div class="form-group">
                    <label for="password">Password<span class="required">*</span></label>
                    <input type="text" class="form-control" id="password" name="password"/><br/>
                    <a class="btn-sm btn btn-warning" href="javascript:generate_password('#password')">Generate new password</a>
                </div>

                <div class="form-group">
                    <label for="mobile_no">Mobile No<span class="required">*</span></label>
                    <input type="telephone" class="form-control" id="mobile_no" name="mobile_no" value="<?=set_value('mobile_no')?>"/>
                </div>

                <button type="reset" class="btn btn-danger">Cancel</button>&nbsp;&nbsp;
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>
</div><br/></br/>