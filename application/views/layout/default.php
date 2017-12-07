<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $title_for_layout; ?></title>

    <script type="text/javascript" src="<?php echo asset_url();?>js/jquery-2.2.4.min.js"></script>
    <script type="text/javascript" src="<?php echo asset_url();?>js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo asset_url();?>js/bootbox.min.js"></script>
    <script type="text/javascript" src="<?php echo asset_url();?>js/bootstrap-dialog.min.js"></script>
    <script type="text/javascript" src="<?php echo asset_url();?>js/moment.min.js"></script>
    <script type="text/javascript" src="<?php echo asset_url();?>js/bootstrap-datetimepicker.min.js"></script>
    <script type="text/javascript" src="<?php echo asset_url();?>js/toastr.min.js"></script>

    <script type="text/javascript" src="<?php echo asset_url();?>js/main.js"></script>


    <?php echo $js_for_layout ?>

    <link rel="stylesheet" href="<?php echo asset_url();?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo asset_url();?>css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="<?php echo asset_url();?>css/bootstrap-dialog.min.css">
    <link rel="stylesheet" href="<?php echo asset_url();?>css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" href="<?php echo asset_url();?>css/toastr.min.css">
    <link rel="stylesheet" href="<?php echo asset_url();?>css/application.css">

    <?php echo $css_for_layout ?>
</head>

<body>

    <?php if($this->session->userdata('user_id') > 0 ) { ?>
        <!-- Fixed navbar -->
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                            aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo base_url(); ?>"><?php echo $this->config->item('app_name'); ?></a>
                </div>
                <div id="navbar" class="collapse navbar-collapse">
                        <ul class="nav navbar-nav">
                            <?php if ($this->session->userdata('user_type_id') == 1) { ?>

                                <li class="dropdown <?php echo $top_nav == 'manage_user' ? 'active' : '';?>">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                                       aria-expanded="false">Staff<span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="/admin/staff/new">Add New</a></li>
                                        <li><a href="/admin/staff">List Staff</a></li>
                                    </ul>
                                </li>

                                <li class="<?php echo $top_nav == 'manage_student' ? 'active' : ''?>">
                                    <a href="/admin/student/list">Students</a>
                                </li>

                                <li class="dropdown <?php echo $top_nav == 'course' ? 'active' : '';?>">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                                       aria-expanded="false">Course<span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="/admin/course/new">Create a Course</a></li>
                                        <li><a href="/admin/course">List</a></li>
                                        <li><a href="/admin/subject/index">Mange Subjects</a></li>
                                    </ul>
                                </li>

                                <li class="<?php echo $top_nav == 'manage_timetable' ? 'active' : ''?>">
                                    <a href="/admin/timetable">Timetables</a>
                                </li>

                                <li class="dropdown <?php echo $top_nav == 'location' ? 'active' : '';?>">
                                    <!-- <a href="/admin/admin_manage_location/list_location">Manage Locations</a> -->
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Locations<span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="/admin/admin_manage_location/list_location">List</a></li>
                                        <li><a href="/admin/admin_manage_location/add_location">Add New</a></li>
                                    </ul>
                                </li>

                                <li class="dropdown <?php echo $top_nav == 'manage_results' ? 'active' : '';?>">
                                    <!-- <a href="/admin/admin_manage_location/list_location">Manage Locations</a> -->
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Results<span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="/admin/admin_manage_result">View Results</a></li>
                                        <li><a href="/admin/admin_manage_result/import_result">Import Results</a></li>
                                    </ul>
                                </li>

                                <li class="dropdown <?php echo $top_nav == 'attendance_sheet' ? 'active' : '';?>">
                                    <a href="/admin/admin_attendance_sheet/search">Print Attendance Sheet</a>
                                </li>

                            <?php } elseif ($this->session->userdata('user_type_id') == 2) { ?>

                                <li class=""><a href="/staff/my-timetable">My Timetable</a></li>

                                <li class="dropdown <?php echo $top_nav == 'location' ? 'active' : ''; ?>">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Assignment<span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="/staff/assignment/create">Create</a></li>
                                        <li><a href="/staff/assignment">List</a></li>
                                    </ul>
                                </li>

                                <li class="dropdown <?php echo $top_nav == 'attendance_sheet' ? 'active' : '';?>">
                                    <a href="/admin/admin_attendance_sheet/search">Print Attendance Sheet</a>
                                </li>

                            <?php } elseif ($this->session->userdata('user_type_id') == 3) { ?>

                                <li class="<?php echo $top_nav == '' ? 'active' : '';?>"><a href="/student/timetable">View Timetable</a></li>
                                <li class="<?php echo $top_nav == 'assignment' ? 'active' : '';?>"><a href="/student/assignment">Assignments</a></li>

                            <?php }; ?>
                        </ul>

                        <?php if ($this->session->userdata('user_id') > 0 ) { ?>
                            <ul class="nav navbar-nav navbar-right">
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                                       aria-expanded="false"><?php echo $user['full_name']; ?> <span class="caret"></span></a>
                                    <ul class="dropdown-menu">

                                        <?php if($this->session->userdata('user_type_id') == 2) {?>
                                            <li><a href="/staff/staff_manage/change_password">Change Password</a></li>

                                        <?php } elseif($this->session->userdata('user_type_id') == 3) {?>
                                            <li><a href="/student/student_manage/change_password">Change Password</a></li>
                                        <?php } ?>

                                        <li><?php echo anchor('user/logout', 'Logout', "title='Logout'");?></li>
                                    </ul>
                                </li>
                            </ul>
                    <?php } ?>
                </div><!--/.nav-collapse -->
            </div>
        </nav>

    <?php } ?>

    <div id="main-content-wrap" class="container-fuild <?=$this->uri->segment('2') != 'welcome' ? 'main-content-wrap' : '' ?>">
        <?php
            if(!isset($full_page_layout)) {
                $full_page_layout = false;
            }

            $flash_success_message = $this->session->flashdata('success_message');
            $flash_error_message   = $this->session->flashdata('error_message');

        ?>

        <!-- Display Success/Error message top of the page-->
        <div class="rowx" id="flash-message-wrap">
            <?php if($flash_success_message) {?>
                <div style="text-align:center;" class="alert alert-success">
                    <strong>Success!</strong> <?=$flash_success_message;?>
                </div>
            <?php } elseif($flash_error_message) {?>
                <div style="text-align:center;" class="alert alert-danger">
                    <strong>Error!</strong> <?=$flash_error_message;?>
                </div>
            <?php } ?>
        </div>
        <!-- End display flash message -->

        <div class="rowx">
            <?php if (!empty($user['user_id']) && $full_page_layout == false) { ?>
                <div id="left-nav" class="col-xs-2">
                    <ul class="nav navbar-nav">
                        <?php if ($user['user_type_id'] == 3 && $this->uri->segment(1) !== 'login') {?>
                            <div class="profile-info">
                                <div>
                                    <img width="100" src="<?=profile_image($user['user_id'])?>">
                                </div>
                                <span>
                                    <?php $stcourse = get_student_course_data($user['user_id'])?>
                                    <strong><?=$stcourse->name;?></strong><br/>
                                    <a href="/student/student_manage/edit_profile">Edit Profile</a><br/>
                                    <a href="/student/acc_profile">My Acedamic Profile</a>
                                </span>
                            </div>
                        <?php } ?>
                        <?php if ($user['user_type_id'] == 10) {?>

                            <?php if($top_nav == 'course') {?>
                                <li><a href="/admin/course/new">Create a Course</a></li>
                                <li><a href="/admin/course">View Courses</a></li>
                                <li><a href="/admin/subject/index">Subjects</a></li>

                             <?php } elseif($top_nav == 'manage_user') {?>
                                <li><a href="/admin/staff/new">Add New Staff Member</a></li>
                                <li><a href="/admin/staff">View Staff</a></li>
                            <?php } elseif($top_nav == 'location'){?>
                                <li><a href="/admin/admin_manage_location/add_location">Add Location</a></li>
                            <?php } ?>

                        <?php } elseif($user['user_type_id'] == 2) { ?>

                            <?php if($top_nav == 'manage_assignment') { ?>
                                 <!-- <li><a href="/staff/assignment/create">Create New Assignment</a></li> -->
                            <?php } ?>
                        <?php } ?>
                    </ul>
                </div>

                <div id="right-container" class="col-xs-10">
                    <?php echo $content_for_layout; ?>
                </div>
            <?php } else { ?>
                <div id="right-container" class="col-xs-12">
                    <?php echo $content_for_layout; ?>
                </div>
            <?php } ?>
        </div>
    </div>

    <footer>
        <p style="color:#9f9f9f;padding-top:20px;">&copy; Copyright <?php echo date('Y'); ?>
            <?php echo $this->config->item('institute'); ?>
        </p>
    </footer>

    <!-- Hide Flash Message -->
    <script type="text/javascript">
        $(document).ready(function(){
            $('#flash-message-wrap').fadeOut(5000);
        });
    </script>

</body>
</html>