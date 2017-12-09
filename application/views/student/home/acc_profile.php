<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<div class="col-md-10">
    <h3 class="text-muted"></h3>

    <div >
        <!-- <label>Your current semesrer(s):</label> -->
    </div>

    <div class="panel-group" id="accordion">

        <?php foreach($data as $key => $items) { ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                         <a data-toggle="collapse" data-parent="#accordion" href="#collapse-<?=$key?>"><?=$items['title']?></a>
                    </h4>
                </div>
                <div id="collapse-<?=$key?>" class="panel-collapse collapse in">
                    <div class="panel-body">

                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#exams-<?=$key?>">Exam</a></li>
                            <li><a data-toggle="tab" href="#assignments-<?=$key?>">Assignment</a></li>
                        </ul>

                        <div class="tab-content">
                            <div id="exams-<?=$key?>" class="dataTable_wrapper tab-pane fade in active">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Subject</th>
                                            <th>Grade</th>
                                            <th>Attempt</th>
                                            
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php foreach ($items['rows'] as $row) {
                                                if(empty($row->subject)) continue;
                                            ?>
                                            <tr>
                                                <td><?=$row->subject . '(' . $row->subject_code . ')' ?></td>
                                                <td><?=$row->grade;?></td>
                                                <td><?=$row->attempt;?></td>
                                                
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>

                            <div id="assignments-<?=$key?>" class="dataTable_wrapper tab-pane fade">
                                <?php if(isset($items['asrows'])) { ?>
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>Subject</th>
                                                <th>Assignment</th>
                                                <th>Marks</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php
                                            foreach($items['asrows'] as $row) {?>
                                                <tr>
                                                    <td><?=$row->subject;?></td>
                                                    <td><?=$row->title?></td>
                                                    <td><?=$row->score <= 0 ? 'Pending' : $row->score?></td>
                                                    <td>
                                                        <?=$row->status?>
                                                        <?php if($row->is_repeat) {?>
                                                            <span>(Repeat Attempt)</span>
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>

                                <?php } else { ?>
                                    <span>No Assignments</span>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
