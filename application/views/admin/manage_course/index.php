<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<script type="text/javascript" src="/assets/js/admin_course.js"></script>

<div class="col-md-10">
    <h3 class="text-muted">Manage Courses</h3>
    <div class="dataTable_wrapper">
        <table class="table table-striped table-hover" id="subjects-table">
            <thead>
                <tr>
                    <th>Course Name</th>
                    <th>Course Code</th>
                    <th>Start Date</th>
                    <th>Duration</th>
                    <th>Number of Students</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach($list as $course) {?>
                    <tr>
                        <td><?=$course->name?></td>
                        <td><?=$course->code?></td>
                        <td><?=date('d M Y', strtotime($course->start_date))?></td>
                        <td></td>
                        <td>&nbsp;</td>
                        <td>
                            <a href="/admin/course/edit/<?=$course->id?>" class="btn btn-sm btn-primary">Edit</a>
                            <a href="/admin/course/update-semester/<?=$course->id?>" class="btn btn-sm btn-success">Set Current Semster</a>
                            <?php /*<a href="/admin/course/status/complete/<?=$course->id?>" class="btn btn-sm btn-danger">Complete</a> */?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
