
$(document).ready(function() {
    $('#').on('click', function() {
        admin_edit_semester_name();
    });
    
    $('#create_subject_form').on('show.bs.modal', function (event) {
        var id = $(event.relatedTarget).data('id');
        var subject_form = $(this).find('form').trigger('reset');
        
        //populate existing data
        subject_form.find('#subject_id').val(id);

        if(id > 0 ) {
            var subject_to_edit = $('#subject-row-' + id);
            subject_form.find('#subject_name').val(subject_to_edit.find('.subject-name').text());
            subject_form.find('#subject_code').val(subject_to_edit.find('.subject-code').text());
        }
    });

    $('#modal-btn-save-subject').on('click', function() {
        var $content = $('#create_subject_form').find('form');

        if($content.find('#subject_name').val() == '') {
            alert("Please enter subject name.");
            return false;
        }

        if($content.find('#subject_code').val() == '') {
            alert("Please enter subject code.");
            return false;
        }
        
        save_subject($content.serialize());
    });

    $('#modal-btn-save-semster').on('click', function() {
        save_semsters_to_course($('#manage_semeter_form').serialize());
    });

     $('#add_subject_dialog').on('show.bs.modal', function (event) {
        $('#subject_semester_id').val($(event.relatedTarget).data('id'));
        $('#subjects_added').find('li').remove();
     });

    $('#modal-btn-add-subject').on('click', function() {
        admin_course_add_subject();
    });

    $('#modal-btn-save-semster-subject').on('click', function() {
        admin_course_save_subject($('#add_subject_form').serialize());
    });

});

function save_semsters_to_course(data) {
    $.ajax({
        url: '/admin/course/save_semster',
        type: 'post',
        dataType: 'json',
        data: data,
        success: function(res) {
            if(res.success) {
                $('#manage_semeter_dialog').modal('hide');
                load_semester_container();
            } else{
                $('#manage_semeter_dialog').find('.validation-errors').html(res.errors);
            }
        }
    });
}

function load_semester_container() {
    $('#course_semsters_container').load(SEMESTER_DETAILS_LOAD_URL);
}


function admin_course_add_subject() {

    var label = $('#semester_subject_list option:selected').text();
    var subject_id = $('#semester_subject_list option:selected').val()

    if(subject_id <= 0 ) {
        return false;
    }

    var subject_row = "";
    subject_row  = "<li class='list-group-item'>";
    subject_row += label;
    subject_row += "<input type='hidden' name='subjects[]' value='"+subject_id+"'>";
    subject_row += "</li>";

    $('#subjects_added').append(subject_row);
}

function admin_course_save_subject(post_data) {
    $.ajax({
        url: '/admin/admin_manage_course/add_subjects_to_semester',
        type: 'post',
        data: post_data,
        dataType: 'json',
        success: function(data) {
            if(data.success) {
                load_semester_container();
                $('#add_subject_dialog').modal('hide');
            } else {
                alert(data.errors);
            }
        }
    }); 
}

function save_subject(data) {
    
    $.ajax({
        url: '/admin/subject/save/',
        type: 'post',
        dataType: 'json',
        data: data,
        success: function(res) {
            
            if(res.success == '1') {
                if(res.action == 'insert' ) {   
                    var row = "<tr id='subject-row-"+res.subject.id+"' class='subject-row' data-id='"+res.subject.id+"'>";
                    row += "<td class='subject-code'>" + res.subject.code + "</td>";
                    row += "<td class='subject-name'>" + res.subject.name + "</td>";
                    row += "<td><a href='' data-toggle='modal' data-id='"+res.subject.id+"' data-target='#create_subject_form'>edit</a> | <a>remove</a> </td>";
                    row += "</tr>";

                    $('#subjects-table').append(row);
                } else {
                     var row = $("#subject-row-" + res.subject.id);
                     row.find('.subject-code').text(res.subject.code);
                     row.find('.subject-name').text(res.subject.name);
                }

                $('#create_subject_form').modal('hide');
                
            } else {
                $('#create_subject_form .validation-errors').html(res.errors);
            }
        }
    });
}