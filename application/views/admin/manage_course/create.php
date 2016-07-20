<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
apply_layout($layout);
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            
            <h2 class="text-muted admin-page-title">
                Create a New Course
            </h2><br/>

            <form role="form" name="manage_ac_user_form" method="post" action="">
                <div class="form-group">
                    <label for="course_name">Course Name <span class="required">*</span></label>
                    <input type="text" class="form-control" id="course_name" name="course_name"/>
                </div>

                <div class="form-group">
                    <label for="code">Course Code <span class="required">*</span></label>
                    <input type="text" class="form-control" id="code" name="code"/>
                </div>

                <div class="form-group row">
                    <div class="col-md-4">
                        <label for="course_duration">Duration <span class="required">*</span></label>
                        <input type="number"  min="0" max="5" class="form-control" id="course_duration" name="course_duration"/>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-4">
                        <label for="no_of_semesters">No of Semesters <span class="required">*</span></label>
                        <input type="number" min="0" max="10" class="form-control col-md-3" id="no_of_semesters" name="no_of_semesters"/>
                    </div>
                </div>
                
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Continue</button>&nbsp;&nbsp;
                    <button type="submit" class="btn btn-danger">Cancel</button>
                </div>
            </form> 
        </div>
    </div>
</div>