
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