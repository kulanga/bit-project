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
    <script type="text/javascript" src="<?php echo asset_url();?>js/main.js"></script>

    <?php echo $js_for_layout ?>

    <link rel="stylesheet" href="<?php echo asset_url();?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo asset_url();?>css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="<?php echo asset_url();?>css/bootstrap-dialog.min.css">
    <link rel="stylesheet" href="<?php echo asset_url();?>css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" href="<?php echo asset_url();?>css/application.css">

    <?php // var_dump($user);die('x');?>
    <?php echo $css_for_layout ?>
</head>

<body>

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

                            <li class="<?php echo $top_nav == 'manage_user' ? 'active' : '';?>">
                                <a href="/admin/staff">Manage User</a>
                            </li>
                            <li class="<?php echo $top_nav == 'course' ? 'active' : '';?>">
                                <a href="/admin/course">Manage Course</a>
                            </li>
                            <li><a href="/admin/admin_manage_location/add_location">Manage Locations</a></li>
                            <li class="<?php echo $top_nav == 'manage_timetable' ? 'active' : ''?>">
                                <a href="/admin/timetable">Manage Timetables</a>
                            </li>
                            <li class="<?php echo $top_nav == 'manage_student' ? 'active' : ''?>">
                                <a href="/admin/student/list">Students</a>
                            </li>

                        <?php } elseif ($this->session->userdata('user_type_id') == 2) {?>

                            <li class=""><a href="/staff/my-timetable">View Timetable</a></li>
                            <li><a href="/staff/assignment">Manage Assignment</a></li>

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
                                    <li><?php echo anchor('user/logout', 'Logout', "title='Logout'");?></li>
                                </ul>
                            </li>
                        </ul>
                <?php } ?>
            </div><!--/.nav-collapse -->
        </div>
    </nav>

    <div id="main-content-wrap" class="container-fuild <?=$this->uri->segment('2') != 'welcome' ? 'main-content-wrap' : '' ?>">
        <div class="row">
            <?php if (!empty($user['user_id'])) { ?>
                <div id="left-nav" class="col-xs-2">
                    <ul class="nav navbar-nav">
                        <?php if ($user['user_type_id'] == 1) {?>
                                
                            <?php if($top_nav == 'course') {?>
                                <li><a href="/admin/course/new">Create a Course</a></li>
                                <li><a href="/admin/course">View Courses</a></li>
                                <li><a href="/admin/subject/index">Subjects</a></li>

                             <?php } elseif($top_nav == 'manage_user') {?>
                                <li><a href="/admin/staff/new">Add New Staff Member</a></li>
                                <li><a href="/admin/staff">View Staff</a></li>
                            <?php } ?>

                        <?php } elseif($user['user_type_id'] == 2) { ?>

                            <?php if($top_nav == 'manage_assignment') { ?>
                                 <li><a href="/staff/assignment/create">Create New Assignment</a></li>
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
        <p style="color:#9f9f9f;padding-top:20px;">&copy; Copyright <?php echo date('Y'); ?> <?php echo $this->config->item('institute'); ?></p>
    </footer>
</body>
</html>