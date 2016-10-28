<div class="container" style="padding:50px 0;">
    <div class="row">
        <div class="col-md-offset-3 col-md-6">
            
            <h3 class="text-muted">
               Student Signup
            </h3>

            <?php if(validation_errors()) {?>
                <div class="validation-errors">
                    <?php echo validation_errors(); ?>
                </div>
            <?php } ?>

            <form role="form" name="manage_ac_user_form" method="post" action="/student/signup">

                <div class="form-group">
                    <label for="reg_no">Student Reg No.<span class="required">*</span></label>
                    <input type="text" class="form-control" id="reg_no" name="reg_no" value="<?=set_value('full_name')?>"/>
                </div>

                <div class="form-group">
                    <label for="name">Full Name<span class="required">*</span></label>
                    <input type="text" class="form-control" id="name" name="name" value="<?=set_value('full_name')?>"/>
                </div>

                <div class="form-group">
                    <label for="email">Email<span class="required">*</span></label>
                    <input type="email" class="form-control" id="email" name="email" value="<?=set_value('email')?>"/>
                </div>
               
                <div class="form-group">
                    <label for="mobile_no">Mobile No<span class="required">*</span></label>
                    <input type="telephone" class="form-control" id="mobile_no" name="mobile_no" value="<?=set_value('mobile_no')?>"/>
                </div>

                <div class="form-group">
                    <label for="course_id">Course<span class="required">*</span></label>
                    <select name="course_id" id="course_id"  class="form-control">
                        <option value="">Select</option>
                        <?php foreach($courses as $course) {?>
                            <option  value="<?=$course->id?>" <?=$course->id == set_value('course_id') ? 'selected="selected"' : '' ?>>
                                <?=$course->name . ' ' . date('Y', strtotime($course->start_date))?>
                            </option>couse_id
                        <?php } ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="password">Password<span class="required">*</span></label>
                    <input type="password" class="form-control" id="password" name="password" autocomplete="off" />
                </div>

                <div class="form-group">
                    <label for="confirm_password">Confirm Password<span class="required">*</span></label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" autocomplete="off"/>
                </div>
               
                <button type="reset" class="btn btn-danger">Reset</button>&nbsp;&nbsp;
                <button type="submit" name="btn_signup" value="signupcouse_id" class="btn btn-primary">Signup</button>
            </form>
        </div>
    </div>
</div>

