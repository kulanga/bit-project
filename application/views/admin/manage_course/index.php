<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<script type="text/javascript" src="/assets/js/admin_course.js"></script>

<div class="col-md-10">
    <h3 class="text-muted">Manage Courses</h3>

    <div class="print-btn-wrap">
        <a href="javascript:window.print()" class="print-btn no-print">&nbsp;&nbsp;Print&nbsp;&nbsp;</a>
    </div>

    <div class="dataTable_wrapper">

        <div>
            <form role="form" name="manage_ac_user_form" method="get" action="/admin/course">

                <div class="row">

                    <div class="form-group col-sm-3">
                        <label for="user_status">Status</label>
                        <select name="status"  class="form-control">
                            <option value="">All Status</option>
                            <option value="1" <?= $search_params['status'] == 1 ? 'selected="selected"' : '';?>>Live</option>
                            <option value="2" <?= $search_params['status'] == 2 ? 'selected="selected"' : '';?>>Draft</option>
                            <option value="3" <?= $search_params['status'] == 3? 'selected="selected"' : '';?>>Completed</option>
                        </select>
                    </div>

                    <div class="form-group col-sm-3 no-print">
                        <br/>
                        <button class="btn btn-primary" type="submit" value="submit">View</button>
                    </div>

                </div>

            </form>
        </div>

        <table class="table table-striped table-hover" id="subjects-table">
            <thead>
                <tr>
                    <th>Course</th>
                    <th>Start Date</th>
                    <th>Status</th>
                    <th style="text-align:right">Duration(Months)</th>
                    <th style="text-align:right">No of Students</th>
                    <th style="text-align:center" class="no-print">Action</th>
                </tr>
            </thead>

            <tbody>

                <?php foreach($list as $course) {?>
                    <tr>
                        <td><?=$course->name?></td>
                        <td><?=date('d M Y', strtotime($course->start_date))?></td>
                        <td>
                            <?php if($course->status == '1') {?>
                                <span class="label label-success"><?=couser_status($course->status)?></span>
                            <?php } elseif($course->status == '2') {?>
                                 <span class="label label-warning"><?=couser_status($course->status)?></span>

                            <?php } elseif($course->status == '3') {?>
                                 <span class="label label-danger"><?=couser_status($course->status)?></span>
                            <?php }?>
                        </td>
                        <td align="center"><?=$course->duration?></td>
                        <td align="center"><?=$course->student_count?></td>
                        <td align="center" class="no-print">
                            <a href="/admin/course/edit/<?=$course->id?>" class="btn btn-sm btn-primary">Edit</a>
                             <a href="/admin/course/settings/<?=$course->id?>" class="btn btn-sm btn-success">Settings</a>


                            <?php /*<a href="/admin/course/status/complete/<?=$course->id?>" class="btn btn-sm btn-danger">Complete</a> */?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
