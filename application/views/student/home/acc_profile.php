<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<div class="col-md-10">
    <h3 class="text-muted"></h3>


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
                        <div class="dataTable_wrapper">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Subject</th>
                                        <th>Grade</th>
                                        <th>Attempt</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php foreach ($items['rows'] as $row) {?>
                                        <tr>
                                            <td><?= $row->subject . '(' . $row->subject_code . ')' ?></td>
                                            <td>N/A</td>
                                            <th>N/A</td>
                                            <td>N/A</td>
                                        </tr>
                                        <?php /*
                                        <tr>
                                            <td colspan="3">
                                                <table>
                                                    <tr>
                                                        <th>Assignment</th>
                                                        <th>Mark</th>
                                                        <th>Statuss</th>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        */?>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
