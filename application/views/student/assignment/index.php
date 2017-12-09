<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<div class="col-md-10">
    <h3 class="text-muted">Assignments</h3>
    <div class="dataTable_wrapper">
    <form role="form" name="manage_ac_user_form" method="get" action="/student/assignment" enctype="multipart/form-data">

         <div class="row">
             <div class="form-group col-sm-4">
                        <label for="subject_id">Status</label>
                        <select name="subject_id"  class="form-control">
                            <option value="">All</option>
                            <option value="0">Open</option>
                            <option value="1">Closed</option>
                        </select>
                    </div>
         </div>

        <?php if(count($assignments) > 0 ) {?>
            <table class="table table-striped table-hover" id="subjects-table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Subject</th>
                        <th>Due Date</th>
                        <th>Status</th>
                        <th>Score</th>
                        <th></th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach($assignments as $ass) {
                        if(isset($ass->show_repeat_assignment) && $ass->show_repeat_assignment == 0) {
                            continue;
                        }
                    ?>
                        <tr class="<?= isset($ass->show_repeat_assignment) && $ass->show_repeat_assignment == 1 ? 'repeat-assignment' : '';?>">
                            <td><?=$ass->title?></td>
                            <td><?=$ass->subject_code?>:<?=$ass->subject_name?></td>
                            <td><?=date('d-m-Y', strtotime($ass->due_date))?></td>
                            <td>
                                <?php
                                if($ass->status == '2' || strtotime($ass->due_date) <= time()) {
                                    echo 'Closed';
                                } elseif($ass->status == '1') {
                                    echo 'Open';
                                }?>
                            </td>
                            <td></td>
                            <td>
                                <a href="/student/student_assignment/view/<?=$ass->id?>" role="button" class="btn btn-sm btn-success">View</a>
                                <?php if(strtotime($ass->due_date) > time()) {?>
                                    <a href="/student/student_assignment/submit/<?=$ass->id?>" role="button" class="btn btn-sm btn-primary">Submit</a>
                                <?php } else {?>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <?php } else {?>
                <div class="alert alert-warning">
                    There are no Assignments. 
                </div>
            <?php } ?>
    </div>
</div>
