<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<!-- <div class="col-md-12">
    <h3 class="text-muted">Import Exam Result</h3>

    <div>
        <form role="form" name="manage_ac_user_form" method="get" action="/admin/student/list">
            <div class="row">

                <div class="form-group col-sm-3">
                    <label for="batch_id">Batch</label>
                    <select name="batch_id"  class="form-control">
                        <option value="">Select</option>
                    </select>
                </div>

                <div class="form-group col-sm-3">
                    <label for="user_status">Status</label>
                    <select name="user_status"  class="form-control">
                    </select>
                </div>

                <div class="form-group col-sm-3">
                    <br/>
                    <button class="btn btn-primary" type="submit" value="submit">View</button>
                </div>

            </div>
        </form>
    </div>
</div> -->

<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">

            <h3 class="text-muted">
                Import Exam Result
            </h3>

            <?php if(validation_errors()) {?>
                <div class="validation-errors">
                    <?php echo validation_errors(); ?>
                </div>
            <?php } elseif(!empty($errors)) {?>
                <div class="validation-errors">
                    <?php foreach($errors as $err) {?>
                        <p><?=$err;?></p>
                    <?php } ?>
                </div>
            <?php } ?>

            <form role="form" name="manage_ac_user_form" method="post" action="/admin/admin_manage_result/import_result" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="batch_id">Batch<span class="required">*</span></label>
                    <select class="form-control" name="batch_id" id="batch_id" onchange="get_semesters_by_course(this.value, '#semester_id')">
                        <option value=""></option>
                        <?php foreach($courses as $course) {?>
                            <option value="<?=$course->id?>"><?=$course->name;?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="semester_id">Semester<span class="required">*</span></label>
                    <select class="form-control" name="semester_id" id="semester_id">

                    </select>
                </div>

                <div class="form-group">
                    <label for="full_name">Result Sheet<span class="required">*</span></label>
                    <input type="file" name="result_sheet" id="result_sheet"/>
                    <span><small>Only .xls, .xlsx files are allowed.</small></span>
                </div>

                <button type="reset" class="btn btn-danger">Cancel</button>&nbsp;&nbsp;
                <button type="submit" name="btn_submit" value="1" class="btn btn-primary">Import</button>
            </form>
        </div>
    </div>
</div>


<script type="text/javascript">



</script>