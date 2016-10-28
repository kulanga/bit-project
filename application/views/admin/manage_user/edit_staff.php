<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            
            <h3 class="text-muted">
               Update Staff Profile.
            </h3>

            <?php if(validation_errors()) {?>
                <div class="validation-errors">
                    <?php echo validation_errors(); ?>
                </div>
            <?php } ?>

            <form role="form" name="manage_ac_user_form" method="post" action="/admin/staff/update/<?=$staff->user_id?>">

                <div class="form-group">
                    <label for="full_name">Full Name<span class="required">*</span></label>
                    <input type="text" class="form-control" id="full_name" name="full_name" value="<?=set_value('full_name', $staff->full_name)?>"/>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" value="<?=set_value('email', $staff->email)?>" readonly="readonly"/>
                </div>

                <div class="form-group">
                    <label for="mobile_no">Mobile No<span class="required">*</span></label>
                    <input type="telephone" class="form-control" id="mobile_no" name="mobile_no" value="<?=set_value('mobile_no', $staff->mobile_no)?>"/>
                </div>

                <div class="form-group">
                    <label for="staff_type">Designation<span class="required">*</span></label>
                    <select class="form-control" name="designation" id="designation">
                        <option value="0">Select</option>
                        <?php foreach($designations as $desg) {?>
                            <option value="<?=$desg->id?>" <?= $desg->id == set_value('designation', $staff->staff_designation_id) ? 'selected="selected"' : '';?>><?=$desg->designation?></option>
                        <?php } ?>
                    </select>
                </div>
               
                <a href="/admin/staff" class="btn btn-danger">Exit</a>&nbsp;&nbsp;
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>