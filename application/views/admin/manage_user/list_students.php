<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>


<div class="col-md-10">
    <h3 class="text-muted">Students</h3>
    <div class="dataTable_wrapper">

        <div>
            <form role="form" name="manage_ac_user_form" method="get" action="/admin/student/list">
                
                <div class="row">

                    <div class="form-group col-sm-3">
                        <label for="batch_id">Search</label>
                        <input type="text" name="keyword" value="<?=$search_params['keyword']?>" class="form-control" placeholder="Serch by reg no, name or email">
                    </div>

                    <div class="form-group col-sm-3">
                        <label for="batch_id">Batch</label>
                        <select name="batch_id"  class="form-control">
                            <option value="">Select</option>
                            <?php foreach($courses as $course) {?>
                                <option value="<?=$course->id?>" <?= $course->id == $search_params['batch_id'] ? 'selected="selected"' : '';?>><?=$course->name?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group col-sm-3">
                        <label for="user_status">Status</label>
                        <select name="user_status"  class="form-control">
                            <option value="">All Status</option>
                            <option value="4" <?= $search_params['user_status'] == 4 ? 'selected="selected"' : '';?>>Approval Pending</option>
                            <option value="1" <?= $search_params['user_status'] == 1 ? 'selected="selected"' : '';?>>Active</option>
                            <option value="3" <?= $search_params['user_status'] == 3? 'selected="selected"' : '';?>>Deleted</option>
                        </select>
                    </div>

                    <div class="form-group col-sm-3">
                        <br/>
                        <button class="btn btn-primary" type="submit" value="submit">View</button>
                    </div>

                </div>

            </form>
        </div>


        <table class="table table-striped table-hover" id="subjects-table">
            <thead>
                <tr>
                    <th>Student Name</th>
                    <th>Reg No</th>
                    <th>Email</th>
                    <th>Mobile No</th>
                    <th>Enrolled Course</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach($students as $student) {?>
                    <tr id="stu-row-<?=$student->user_id;?>">
                        <td><?=ucwords($student->full_name)?></td>
                        <td><?=$student->reg_no;?></td>
                        <td><?=$student->email;?></td>
                        <td><?=$student->mobile_no;?></td>
                        <td><?=$student->course_name?></td>
                        <td class="stu-status"><?=user_status($student->user_status)?></td>
                        <td>
                            <a href="#" class="btn-sm btn-primary">Edit</a>
                            <?php if($student->user_status == 4) {?>
                                <a href="javascript:void(0)" class="btn-sm btn-success btn-approve" data-id="<?=$student->user_id;?>">Approve</a>
                            <?php }?>

                            <?php if($student->user_status != 3) {?>
                                <a href="#" class="btn-sm btn-danger btn-delete" data-id="<?=$student->user_id;?>">Delete</a>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('.btn-approve').on('click', function() {
            var id = $(this).data('id');
            admin_student_update_status(id, 1, 'approve', $(this));
        });

        $('.btn-delete').on('click', function() {
            var id = $(this).data('id');
            var btn = $(this);
            bootbox.confirm("Are you sure?", function(confirm){
                if(confirm) {
                    admin_student_update_status(id, 3, 'delete', btn);
                }
            })
            
        });

        function admin_student_update_status(id, status, newstatus, btn) {
            $.ajax({
                url: '/admin/admin_manage_user/update_user_status',
                type: 'post',
                data:   {'id': id, 'status': status},
                dataType:'json',
                success: function(data) {
                    if(data.status == '1') {
                        var newstatus_text = '';

                        if(newstatus == 'approve') {
                            newstatus_text = 'Approved';

                        } else if(newstatus == 'delete') {
                            newstatus_text = 'Deleted';
                        }
                        $('#stu-row-' + id).find('.stu-status').html(newstatus_text);
                        btn.hide();
                    } else {
                        alert('An error occured. Please refresh the page and try.');
                    }
                }
            })
        }
    });
</script>
