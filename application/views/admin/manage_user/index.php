<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="col-md-10">
    <h3 class="text-muted">Manage Users</h3>
    <div class="dataTable_wrapper">
        <table class="table table-striped table-hover" id="subjects-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Designation </th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Action</th>

                </tr>
            </thead>

            <tbody>
                <?php foreach($list as $staff) {?>
                    <tr>
                        <td><?=$staff->full_name?></td>
                        <td><?=$staff->designation?></td>
                        <td><?=$staff->email?></td>
                        <td><?=$staff->mobile_no?></td>
                        <td>
                            <a class="btn btn-sm btn-primary" href="/admin/staff/edit/<?=$staff->user_id?>">Edit&nbsp;&nbsp;<a>
                            <a class="btn btn-sm btn-success">View timetable</a>
                            <a class="btn btn-sm btn-info">Assign subject</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
         
        </table>
    </div>
</div>