
function get_subjects_in_curret_semster(course_id) {
    var ret;
    if(course_id <= 0) {
        return new Array();
    }
    $.ajax({
        url: '/common/get_subjects_in_current_semester/' + course_id,
        type: 'get',
        async: false,
        dataType: 'json',
        success: function(data) {
            ret = data;
        }
    });
    return ret;
}

function generate_password(target_el_id) {
    $.ajax({
        url: '/common/generate_password',
        type: 'get',
        success: function(password) {
            $(target_el_id).val(password);
        }
    });
}

function get_semesters_by_course(course_id, target_el_id, selected_value) {

    var options = '<option value="">-</option>';
    var selected_option = '';

    selected_value = selected_value || 0;

    $.ajax({
        url: '/common/get_semesters_in_course/' + course_id,
        type: 'get',
        async: false,
        dataType: 'json',
        success: function(response) {
            $.each(response.data, function(i, v) {

                if (v.id == selected_value) {
                    selected_option = 'selected="selected"';
                }
                options += "<option value='"+v.id+"' "+selected_option+">Year " + v.semester_year +  " Semester " + v.semester_number +"</option>";
            });

            $(target_el_id).html(options);
        }
    });
}