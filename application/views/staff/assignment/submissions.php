
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
                    <th style="text-align:right;">Score</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach($assignment_submissions as $asub) { ?>
                    <tr>
                        <td><?=$asub->student->reg_no;?></td>
                        <td><?=$asub->student_user->full_name;?></td>
                        <td><?=date('d-m-Y H:i:s', strtotime($asub->date_submitted));?></td>
                        <td><?=$asub->original_file_name;?></td>
                        <td  style="text-align:right;" id="score-<?=$asub->id?>"><?=$asub->score?></td>
                        <td>
                            <a class="btn-sm btn-primary" target="_blank" href="<?=base_url() . 'uploads/assignments/assignments/' . $asub->file_name?>">View Submission</a>
                            <a class="btn-sm btn-success" data-id="<?=$asub->id?>" data-toggle="modal" data-target="#assignment_mark_form">Assign Marks</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="assignment_mark_form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Enter Assignment Score</h4>
            </div>

            <div class="modal-body" style="overflow:hidden;">

                <div class="validation-errors hide"></div>

                <form role="form" method="post" action="/admin/subject/save">
                    <div class="form-group">
                        <label>Score<span class="required">*</span></label>
                        <input style="width:150px;" type="number" max=100 min=0 id="score" name="score"/>
                        <label for="score"></label>&nbsp;
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <input  type="hidden" id="submission_id" value="">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" id="modal-btn-save-subject" class="btn btn-primary">Add</button>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function(){
        // $('.btn-comfirm').on('click', function() {
        //     if(date>asub)
        //     {
        //     var lid = $(this).data('confirm-id');
        //     bootbox.confirm('this is late Submission?', function(get_by_assignment_id) )}
        // });

        $('#assignment_mark_form').on('show.bs.modal', function (event) {
             var id = $(event.relatedTarget).data('id');
             $('#submission_id').val(id);
        });

        $('#modal-btn-save-subject').on('click', function() {
            var id = parseInt($('#submission_id').val());
            var score = $('#score').val();

            if (id <= 0) {
                return false;
            }

            $.ajax({
                url: '/staff/staff_assignment/add_marks',
                type: 'post',
                data: {'id': id, 'score': score},
                dataType: 'json',
                success: function(res) {
                    if(res.error) {
                        alert(res.error);
                    } else {
                        $('td#score-'+id).html(score);
                    }
                    $('#assignment_mark_form').modal('hide');
                },
                error: function() {
                    alert('An error occured. Please try again.');
                }
            });
        });
    });
</script>