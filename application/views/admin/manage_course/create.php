<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>


<script type="text/javascript" src="/assets/js/admin_course.js"></script>

<div class="container-fluid">
    <div class="row">

        <h2 class="text-muted admin-page-title">
            <?php echo isset($course->id) && $course->id > 0  ? 'Update Course' : 'Create a New Course'?>

            
        </h2><br/>

        <div class="col-md-8">
            <?php if(validation_errors()) {?>
                <div class="validation-errors">
                    <?php echo validation_errors(); ?>
                </div>
            <?php } ?>
            
            <form role="form" name="manage_ac_user_form" method="post" action="/admin/admin_manage_course/save_course/<?=is_object($course) ? $course->id : '';?>" style="padding-bottom:65px;">
                <div class="form-group">
                    <label for="course_name">Course Name <span class="required">*</span></label>
                    <input type="text" class="form-control" id="course_name" name="course_name" value="<?php echo set_value('course_name', is_object($course) ? $course->name : '')?>" required/>
                </div>

                <div class="form-group">
                    <label for="course_code">Course Code <span class="required">*</span></label>
                    <input type="text" class="form-control" id="course_code" name="course_code" value="<?php echo set_value('course_code', is_object($course) ? $course->code : '')?>" required/>
                </div>

                <div class="form-group row">
                    <div class="col-md-4">
                        <label for="course_start_date">Start Date <span class="required">*</span></label>
                        <input type="text" class="form-control col-md-3" id="course_start_date" name="course_start_date" value="<?php echo set_value('start_date', is_object($course) ? date('d-m-Y', strtotime($course->start_date)) : '')?>" required/>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="course_duration">Duration<span class="required">*</span><br/>

                        <div class="col-md-6 pad-left-0">
                            <input type="number"  min="0" max="5" value="<?=set_value('course_duration_years', is_object($course) ? floor($course->duration/12) : '')?>" class="form-control" id="course_duration_years" name="course_duration_years" placeholder="Years" />
                         </div>

                         <div class="col-md-6 pad-left-0">
                             <input type="number"  min="0" max="12" value="<?=set_value('course_duration_months', is_object($course) ? floor($course->duration%12) : '')?>" class="form-control" id="course_duration_months" name="course_duration_months" placeholder="Months" />
                         </div>
                    </div>
                </div>

                <div class="form-group">
                    <a href="/admin/course" role="button" class="btn btn-danger">&nbsp;&nbsp;Exit&nbsp;&nbsp;</a>&nbsp;&nbsp;

                    <?php if(isset($course->id) && $course->id > 0) {?>
                        <button type="reset" class="btn btn-warning" data-toggle="modal" data-target="#manage_semeter_dialog">Add Semester</button>&nbsp;&nbsp;
                        <button type="submit" class="btn btn-primary" name="btn_start_create_course" value="save">Update</button>
                    <?php } else { ?>
                        <button type="submit" class="btn btn-primary" name="btn_start_create_course" value="save">Create</button>
                    <?php } ?>
                </div>

                <?php if(isset($course->id) && $course->id > 0) {?>
                    <div class="form-group">
                        
                    </div>   
                <?php } ?>

            </form> 
        </div>
    </div>
</div>


<?php if(isset($course->id) && $course->id > 0 ) {?>

    <div id="course_semsters_container">
    
    </div>

    <div class="modal fade" id="manage_semeter_dialog" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" >Manage Semester</h4>
                </div>

                <div class="modal-body">
                    <div class="validation-errors" style="display:none;"></div>
                    <form id="manage_semeter_form" name="manage_semeter_form" role="form" method="post" action="/admin/course/save_semster">
                        <div class="form-group">
                            <label for="semester_year">Year<span class="required">*</span></label>
                            <select class="form-control" name="semester_year" id="semester_year">
                                <?php for($i = 1; $i <= ceil(($course->duration/12)); $i++) { ?>
                                    <option value="<?=$i?>"><?=$i?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="semster_name">Semester<span class="required">*</span></label>
                            <select class="form-control" name="semester_number" id="semester_number">
                                <?php for($i = 1; $i < 4; $i++) { ?>
                                    <option value="<?=$i?>"><?=$i?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="start_date">Start Date<span class="required">*</span></label>
                             <div class="input-append date form_datetime" data-date-format="dd-mm-yyyy">
                                <input id="semster_start_date" name="start_date" size="16" type="text" value="" readonly>
                                <span class="add-on"><i class="icon-remove"></i></span>
                                <span class="add-on"><i class="icon-calendar"></i></span>
                            </div>
                        </div>

                        <div id="add_subject_container">
                            <div class="form-group">
                              
                            </div>

                            <div class="form-group">

                            </div>
                        </div>

                        <input type="hidden" value="<?=$course->id?>" name="course_id">
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" id="modal-btn-save-semster" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="add_subject_dialog" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" >Manage Subject</h4>
                </div>

                <div class="modal-body">
                    <form id="add_subject_form" name="add_subject_form" role="form" method="post" action="/admin/course/add_subjects_to_semester">
                        
                        <input type="hidden" id="subject_semester_id" name="subject_semester_id" value="0">
                        <input type="hidden" id="subject_course_id" name="subject_course_id" value="<?=$course->id?>">
                        

                        <div class="row">
                            <div class="form-group col-sm-6">
                               <select class="form-control" id="semester_subject_list">
                                    <option></option>
                                    <?php foreach($subjects as $subject) {?>
                                        <option value="<?=$subject->id?>"><?=$subject->code . '-' . $subject->name;?></option>
                                    <?php } ?>
                               </select>
                            </div>

                            <div class="form-group col-sm-6">
                               <button class="btn btn-warning" id="modal-btn-add-subject" type="button">+Add</button>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <ul class="list-group" id="subjects_added">
                                   
                                </ul>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" id="modal-btn-save-semster-subject" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        var SEMESTER_DETAILS_LOAD_URL = '/admin/admin_manage_course/get_semester_details/<?=$course->id?>';

        $(document).ready(function() {
            load_semester_container();
        });

    </script>

<?php } ?>