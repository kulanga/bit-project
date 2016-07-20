<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
apply_layout($layout);
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            
            <h3 class="text-muted">
                Create / Update Academic member profile.
            </h3>

            <form role="form" name="manage_ac_user_form" method="post" action="">
                <div class="form-group">
                    <label for="full_name">Full Name with Initials</label>
                    <input type="text" class="form-control" id="full_name" name="full_name"/>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email"/>
                </div>

                <div class="form-group">
                    <label for="staff_type">Designation</label>
                    <select class="form-control" name="staff_type" id="staff_type">
                        <option value="0">Select</option>
                        <?php foreach($designations as $desg) {?>
                            <option value="<?=$desg->id?>"><?=$desg->designation?></option>
                        <?php } ?>
                    </select>
                </div>
            
                <div class="form-group">
                    <label for="profile_image">Profile Picture</label>
                    <input type="file" id="profile_image" />
                    <p class="help-block">Max files size is 2MB.</p>
                </div>

                <div class="form-group">
                    <label for="email">Phone No.</label>
                    <input type="phone" class="form-control" id="phone_no" name="phone_no"/>
                </div>

                <div class="checkbox form-group">
                    <label>
                        <input type="checkbox" /> Check me out
                    </label>
                </div>
                
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Submit</button>&nbsp;&nbsp;
                    <button type="submit" class="btn btn-danger">Cancel</button>
                </div>
            </form> 
        </div>
    </div>
</div>