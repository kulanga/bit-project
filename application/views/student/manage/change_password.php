<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>


<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">

            <h3 class="text-muted">
               Change Your Password.
            </h3>

            <?php if(validation_errors()) {?>
                <div class="validation-errors">
                    <?php echo validation_errors(); ?>
                </div>
            <?php } ?>

            <form role="form" method="post" action="/student/student_manage/change_password"/>

                <div class="form-group">
                    <label for="current_password">Current Password</span></label>
                    <input type="password" class="form-control" name="current_password" id="current_password"/>
                </div>

                <div class="form-group">
                    <label for="new_password">New Password</span></label>
                    <input type="password" class="form-control" name="new_password" id="new_password"/>
                </div>

                <div class="form-group">
                    <label for="confirm_new_password">Confirm New Password</span></label>
                    <input type="password" class="form-control" name="confirm_new_password" id="confirm_new_password"/>
                </div>

                <a href="/" class="btn btn-danger">Exit</a>&nbsp;&nbsp;
                <button type="submit" class="btn btn-primary">Update</button>

            </form>
        </div>
    </div>
</div>
