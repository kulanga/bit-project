
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="col-md-12">
    <h3 class="text-muted">Assignment Submissions</h3>

    <div>
        <label>Assignment:</label> <span><?=$assignment->title?></span><br/>
        <label>Due Date:</label> <span><?=date('d-m-Y', strtotime($assignment->due_date))?></span>
    </div>

    <div class="dataTable_wrapper">

        <table class="table table-striped table-hover" id="subjects-table">
            <thead>
                <tr>
                    <th>Student Reg No</th>
                    <th>Name</th>
                    <th>Sumitted On</th>
                    <th>Submission</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach($assignment_submissions as $asub) { ?>
                    <tr>
                        <td><?=$asub->student->reg_no;?></td>
                        <td><?=$asub->student_user->full_name?></td>
                        <td><?=date('d-m-Y H:i:s', strtotime($asub->date_submitted))?></td>
                        <td><?=$asub->original_file_name?></td>
                        <td>
                            <a class="btn btn-primary"  href="<?=  base_url() . 'uploads/assignments/assignments/' . $asub->file_name?>">View Submission</a>
                            <a class="btn btn-success">Assign Marks</a>
                        </td>

                    </tr>
                <?php } ?>
            </tbody>
         
        </table>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function(){
        $('.btn-comfirm').on('click', function() {
            if(date>asub)
            {
            var lid = $(this).data('confirm-id');
            bootbox.confirm('this is late Submission?', function(get_by_assignment_id) )}
        });
    });
</script>