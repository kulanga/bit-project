<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>


<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 col-md-offset-4">

            <h3 class="text-muted">
               Reset Your Password.
            </h3>

            <?php if(validation_errors()) {?>
                <div class="validation-errors">
                    <?php echo validation_errors(); ?>
                </div>
            <?php } ?>

            <form role="form" method="post" action=""/>
                <div class="form-group">
                    <label for="new_password">New Password</span></label>
                    <input type="password" class="form-control" name="new_password" id="new_password"/>
                </div>

                <div class="form-group">
                    <label for="confirm_new_password">Confirm New Password</span></label>
                    <input type="password" class="form-control" name="confirm_new_password" id="confirm_new_password"/>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="/login" style="float:right;">Go to login</a>
            </form>
        </div>
    </div>
</div>
