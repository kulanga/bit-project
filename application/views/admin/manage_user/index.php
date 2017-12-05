<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="col-md-10">
    <h3 class="text-muted">Manage Acedamic Staff</h3>

    <div class="print-btn-wrap">
        <a href="javascript:window.print()" class="print-btn no-print">&nbsp;&nbsp;Print&nbsp;&nbsp;</a>
    </div>

    <div class="dataTable_wrapper">
        <table class="table table-striped table-hover" id="subjects-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Designation </th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Status</th>
                    <th class="no-print">Action</th>

                </tr>
            </thead>

            <tbody>
                <?php foreach($list as $staff) {?>
                    <tr id="staff-row-<?=$staff->user_id?>">
                        <td><?=$staff->full_name?></td>
                        <td><?=$staff->designation?></td>
                        <td><?=$staff->email?></td>
                        <td><?=$staff->mobile_no?></td>
                        <td class="staff-status"><?=user_status($staff->status)?></td>
                        <td class="no-print">
                            <a class="btn btn-sm btn-primary" href="/admin/staff/edit/<?=$staff->user_id?>">Edit&nbsp;&nbsp;<a>
                            <?php if($staff->status != 3) {?>
                                <a href="#" class="btn-sm btn-danger btn-delete" data-id="<?=$staff->user_id;?>">Delete</a>
                            <?php } ?>
                            <?php /*<a class="btn btn-sm btn-success" href="">View timetable</a> */ ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>

        </table>
    </div>
</div>
<script type="text/javascript">


 $(document).ready(function() {

    $('.btn-delete').on('click', function() {
        var id = $(this).data('id');
        var btn = $(this);
        bootbox.confirm("Are you sure?", function(confirm){
            if(confirm) {
                admin_staff_update_status(id, 3, 'delete', btn);
            }
        })
    });

     function admin_staff_update_status(id, status, newstatus, btn) {
            $.ajax({
                url: '/admin/admin_manage_user/update_staff_status',
                type: 'post',
                data:   {'id': id, 'status': status},
                dataType:'json',
                success: function(data) {
                    if(data.status == '1') {
                        var newstatus_text = '';

                        if(newstatus == 'delete') {
                            newstatus_text = 'deleted';
                        }
                        $('#staff-row-' + id).find('.staff-status').html(newstatus_text);
                        btn.hide();
                    } else {
                        alert('An error occured. Please refresh the page and try.');
                    }
                }
            });
        }
    });
</script>