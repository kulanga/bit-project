<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<script type="text/javascript" src="/assets/js/admin_course.js"></script>

<div class="col-md-6">


<h3 class="text-muted">Manage Subjects</h3>

    <div>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#create_subject_form" data-id="0">Add New</button>
    </div>

    <div class="dataTable_wrapper">
        <table class="table table-striped table-hover" id="subjects-table">
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Subject</th>
                    <th>Acton</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($list as $subject) { ?>
                    <tr id="subject-row-<?=$subject->id?>" class="subject-row" data-id="<?=$subject->id?>">
                        <td class="subject-name" ><?=$subject->code;?></td>
                        <td class="subject-code" ><?=$subject->name;?></td>
                        <td>
                            <a href="#" data-toggle="modal" data-id="<?=$subject->id?>" data-target="#create_subject_form">edit</a> |
                            <a>remove</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="create_subject_form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" >Add/Edit Subject</h4>
            </div>
            <div class="modal-body">
                <form role="form" method="post" action="/admin/subject/save">
                    <div class="form-group">
                        <label for="subject_name">Subject Name<span class="required">*</span></label>
                        <input type="text" class="form-control" id="subject_name" name="subject_name" required="" />
                    </div>

                    <div class="form-group">
                        <label for="subject_code">Subject Code<span class="required">*</span></label>
                        <input type="text" class="form-control" value="" id="subject_code" name="subject_code" required=""/>
                    </div>
                    <input type="hidden" value="" name="subject_id" id="subject_id">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" id="modal-btn-save-subject" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>