<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<?php foreach($semesters as $semester) {?>
    <div>
        <span style="font-weight:bold;">Year <?=$semester->semester_year?> Semster <?=$semester->semester_number?></span>
        <span><a href="javascript:void(0)" class="btn btn-sm btn-danger btn-remove-semster" data-id="<?=$semester->id?>">Remove</a></span>
        <span><a href="javascript:void(0)" class="btn btn-sm btn-success" data-toggle="modal" data-target="#add_subject_dialog" data-id="<?=$semester->id?>">+Add Subject</a></span>
    </div>
    <div class="dataTable_wrapper">
        <table class="table table-striped table-hover" id="subjects-table">
            <thead>
                <tr>
                    <th>Subject Code</th>
                    <th>Subject Name</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>

            <tbody>
                <?php if(isset($semester->subjects)) { ?>
                    <?php foreach($semester->subjects as $subject) {?>
                        <tr>
                            <td><?=$subject->code?></td>
                            <td><?=$subject->name?></td>
                            <td>
                                <button type="button" class="btn btn-sm btn-danger btn-delete-semester-subject" data-id="<?=$subject->couser_subject_id?>">Delete</button>
                            </td>
                        </tr>
                    <?php } ?>
                <?php } ?>
            </tbody>
        </table>
    </div>
<?php } ?>

<script type="text/javascript">
    $(document).ready(function() {

    })
</script>