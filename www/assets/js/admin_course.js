
$(document).ready(function() {
    $('#').on('click', function() {
        admin_edit_semester_name();
    });

    $('.btn-add-subject').on('click', function() {
        var semster_id = $(this).data('semster-id');
        admin_course_add_subject(semster_id);
    });

    $('.btn-save-subject').on('click', function() {
        var subject_id = $(this).data('subject-id');
        admin_course_save_subject(subject_id, subject_id);
    });
});



function admin_edit_semester_name() {
    
}

function admin_course_add_subject(semester_id) {
    var subject_row = "";
    subject_row = "<tr class='subject-row mode-write'>";
    subject_row += "<input type='hidden' class='semester-id' value='"+semester_id+"'>";
    subject_row += "<td><input type='text' class='subject-code'></td>";
    subject_row += "<td><input type='text' class='subject-name'></td>"
    subject_row += "<td><a href='javascript:void(0)' class='btn-save-subject' data-subject-id='0'>save</a>|<a href='javascript:void(0)' data-subject-id='0'>remove</a></td>";
    subject_row += "</tr>";

    $('#semester-subjects-table-' + semester_id + ' tbody').append(subject_row);
}

function admin_course_save_subject(subject_id, subject_row) {

    var subject_code = $(subject_row).find('input.subject-code');
    var subject_name = $(subject_row).find('input.subject-name');
    var semester_id = $(subject_row).find('.semester-id').val();

    $.ajax({
        url: '/admin/admin_manage_course/save_subject',
        type: 'post',
        data: {
            'subject_code' : subject_code, 'subject_name': subject_name,
            'subject_id': subject_id, 'semster_id' : semester_id
        },
        success: function(data) {

        }
    });

    
}