<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<div class="col-md-10">
    <h3 class="text-muted">Assignments</h3>
    <div class="dataTable_wrapper">

        <?php if(count($assignments) > 0 ) {?>
            <table class="table table-striped table-hover" id="subjects-table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Subject</th>
                        <th>Semester</th>
                        <th>Due Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach($assignments as $ass) {?>
                        <tr>
                            <td><?=$ass->title?></td>
                            <td><?=$ass->subject_code?>:<?=$ass->subject_name?></td>
                            <td><?=$ass->semester?></td>
                            <td><?=date('d-m-Y', strtotime($ass->due_date))?></td>
                            <td>
                                <?php if($ass->status == '1') {
                                    echo 'Open';
                                } elseif($ass->status == '2') {
                                    echo 'Close';
                                } ?>
                            </td>
                            <td>
                                <?php if($ass->status == 1) {?>
                                    <a href="/student/student_assignment/submit/<?=$ass->id?>" role="button" class="btn btn-sm btn-primary">Submit</a>
                                <?php } else {?>
                                    <a href="" role="button"  class="btn btn-sm btn-info" >View Submission & Status</a>
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
