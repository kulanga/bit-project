<div class="container" style="padding:50px 0;background-color: #F5F5F5">
    <div class="row">
        <div class="col-md-offset-3 col-md-6">

            <h3 class="text-muted">
                Student Sign Up
            </h3>

            <?php if(validation_errors()) {?>
                <div class="validation-errors">
                    <?php echo validation_errors(); ?>
                </div>
            <?php } ?>

            <form role="form" class="form-horizontal" name="manage_ac_user_form" method="post" action="/student/signup">

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
                    <label for="reg_no">Student Reg No.<span class="required">*</span></label>
                    <input type="text" class="form-control" placeholder="The Reg.no, that mentioned on your student id card"id="reg_no" name="reg_no" value="<?=set_value('reg_no')?>"/>
                </div>

                <div class="form-group">
                    <label for="course_id">Course<span class="required">*</span></label>
                    <select name="course_id" id="course_id"  class="form-control">
                        <option value="">Select</option>
                        <?php foreach($courses as $course) {?>
                            <option  value="<?=$course->id?>" <?=$course->id == set_value('course_id') ? 'selected="selected"' : '' ?>>
                                <?=$course->name?>
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

                <div class="row"></div>

                <div class="form-group float-right">
                    <a href="/" class="btn btn-lg btn-default">Cancel</a>&nbsp;&nbsp;
                    <button type="submit" name="btn_signup" value="signupcouse_id" class="btn btn-lg btn-primary">Signup</button>
                </div>
            </form>
        </div>
    </div>
</div> <br/><br/>

