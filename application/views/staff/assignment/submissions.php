
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="col-md-12">
    <h3 class="text-muted">Manage Assignments</h3>

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
                        <td><?=date('d-m-Y H:i', strtotime($asub->date_submitted))?></td>
                        <td><?=$asub->original_file_name?></td>
                        <td><a class="btn btn-primary" href="<?=  base_url() . 'uploads/assignments/assignments/' . $asub->file_name?>">Download</a></td>
                    </tr>
                <?php } ?>
            </tbody>
         
        </table>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
     
    });
</script>