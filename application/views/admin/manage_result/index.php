<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<div class="col-md-10">
    <h3 class="text-muted">Exam Results</h3>

    <div class="print-btn-wrap">
        <a href="javascript:window.print()" class="print-btn no-print">&nbsp;&nbsp;Print&nbsp;&nbsp;</a>
    </div>

    <div class="dataTable_wrapper">

        <div>
            <form role="form" name="view_result_form" method="get" action="/admin/admin_manage_result">

                <div class="row">

                    <div class="form-group col-sm-3">
                        <label for="keyword_search">Search</label>
                        <input type="text" class="form-control" name="keyword_search" id="keyword_search" placeholder="Serach by Reg.No">
                    </div>

                    <div class="form-group col-sm-3">
                        <label for="course_id">Course</label>
                        <select name="course_id" id="course_id" class="form-control" onchange="get_semesters_by_course(this.value, '#semester_id')">
                            <option value="">Selects</option>
                            <?php foreach($courses as $course) {?>
                                <option value="<?=$course->id?>" <?= !empty($filters['course_id']) && $filters['course_id'] == $course->id ? 'selected="selected"' : '';?> ><?=$course->name?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group col-sm-3">
                        <label for="semester_id">Semester</label>
                        <select name="semester_id" id="semester_id" class="form-control">
                            <option value="">Select</option>
                        </select>
                    </div>

                    <div class="form-group col-sm-3 no-print">
                        <br/>
                        <button class="btn btn-primary" type="submit" value="submit">View</button>&nbsp;
                        <button class="btn btn-default" id="btn_clear_filters" type="reset">Clear Search</button>

                    </div>
                </div>
            </form>
        </div>

        <div class="row summery">
            <div class="col-sm-3">
                <?php if(isset($data[0])) {?>
                    <span><strong>Course:</strong> <?=$data[0]->course_name;?></span><br/>
                <?php } ?>

                <span><strong>Showing:</strong> <?=count($data)?> Record(s)</span>
            </div>
        </div>

        <table class="table table-striped table-hover" id="results-table">
            <thead>
                <tr>
                    <th>Reg.No (Indexno)</th>
                    <th>Student Name</th>
                    <th>Subject</th>
                    <th>Year/Semester</th>
                    <th>Grade</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach($data as $row) { ?>
                    <tr>
                        <td><?=$row->reg_no?></td>
                        <td><?=$row->full_name?></td>
                        <td><?=$row->subject_code;?>/<?=$row->subject_name;?></td>
                        <td><?=$row->year_semester_text?></td>
                        <td><?=$row->grade?></td>
                    </tr>
                <?php } ?>

            </tbody>
        </table>
    </div>
</div>

<script type="text/javascript">

    $(document).ready(function() {

        var sem_id = '<?=isset($filters['semester_id']) ? $filters['semester_id'] : 0;?>'
        get_semesters_by_course($('#course_id').val(), '#semester_id', sem_id);


        $('#btn_clear_filters').on('click', function() {
            $('#view_result_form')[0].reset();
            $('#course_id').val('0');
            $('#semester_id').val('');
        });
    });
</script>
