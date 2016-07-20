<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
apply_layout($layout);
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            
            <h3 class="text-muted">
                Add New Staff Member.
            </h3>

            <form role="form" name="manage_ac_user_form" method="post" action="">
                <div class="form-group">
                    <label for="full_name">Full Name</label>
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
               
                <button type="submit" class="btn btn-primary">Create</button>&nbsp;&nbsp;
                <button type="submit" class="btn btn-danger">Cancel</button>
            </form>
        </div>
    </div>
</div>