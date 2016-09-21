<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

?>

<script type="text/javascript" src="/assets/js/admin_course.js"></script>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            
            <h2 class="text-muted admin-page-title">
                Update Course
            </h2><br/>

            <form role="form" name="manage_ac_user_form" method="post" action="">
                <div class="form-group">
                    <label for="course_name">Course Name <span class="required">*</span></label>
                    <input type="text" class="form-control" id="course_name" name="course_name" value="<?php echo set_value('course_name', $course_data->name)?>" />
                </div>

                <div class="form-group">
                    <label for="course_code">Course Code <span class="required">*</span></label>
                    <input type="text" class="form-control" id="course_code" name="course_code" value="<?php echo set_value('course_code', $course_data->code)?>"/>
                </div>

                <div class="form-group row">
                    <div class="col-md-4">
                        <label for="course_duration">Duration <span class="required">*</span></label>
                        <input type="number"  min="0" max="5" class="form-control" id="course_duration" name="course_duration"/>
                    </div>
                </div>

                <div class="form-group row hide">
                    <div class="col-md-4">
                        <label for="no_of_semesters">No of Semesters <span class="required">*</span></label>
                        <input type="number" min="0" max="10" class="form-control col-md-3" id="no_of_semesters" name="no_of_semesters"/>
                    </div>
                </div>
                
                <div class="row col-md-6">
                    <button type="submit" class="btn btn-primary">Update</button>&nbsp;&nbsp;
                    <button type="submit" class="btn btn-danger">Cancel</button>
                </div>

                <div class="row col-md-6">
                    <a href="#" class="btn btn-success">+ Add Semester</a>
                </div>
            </form><br/><br/>

            <h5 class="section-title">Semsters and Subjects Settings</h5>
           
            <fieldset>
                <?php //foreach($semsters as $semester) {?>
                    <?php $semster_id = 1; //@TODO?>
                    <div>
                        <div class="">
                            <label class="form-label">
                                <span class="">Semester 1: </span>
                                <a href="javascript:void(0);" id="btn_edit_semester_name">edit</a>
                                <a href="javascript:void(0);" data-semster-id="<?=$semster_id?>" class="btn-sm btn-success btn-add-subject">+ Add Subject</a>
                            </label><br/><br/>
                        </div>
                       
                        <div class="table-responsive">
                            <table id="semester-subjects-table-<?=$semster_id?>" class="semester-subjects-table table table-hover">
                                <thead>
                                    <tr>
                                        <th>Subject Code</th>
                                        <th>Subject Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php //foreach($semester->subjects as $subject)?>
                                        <tr class="subject-row mode-read">
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    <?php //} ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php //} ?>
            </fieldset>
        </div>
    </div>
</div>

<div id="mymodal"></div>