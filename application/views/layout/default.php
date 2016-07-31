<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $title_for_layout; ?></title>

    <script type="text/javascript" src="<?php echo asset_url();?>js/jquery-2.2.4.min.js"></script>
    <script type="text/javascript" src="<?php echo asset_url();?>js/bootstrap.min.js"></script>
    <?php echo $js_for_layout ?>

    <link rel="stylesheet" href="<?php echo asset_url();?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo asset_url();?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo asset_url();?>css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="<?php echo asset_url();?>css/application.css">
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
                    <li><a href="#">Contact Us</a></li>
                    <?php if ($user['user_type_id'] == 1): ?>
                        <li class="active"><a href="#">Manage User</a></li>
                        <li><a href="#">Manage Course</a></li>
                        <li><a href="#">Manage Locations</a></li>
                        <li><a href="#">Manage Timetables</a></li>
                    <?php elseif ($user['user_type_id'] == 2): ?>
                        <li class="active"><a href="#">View Timetable</a></li>
                        <li><a href="#">Add Assignment</a></li>
                    <?php elseif ($user['user_type_id'] == 3): ?>
                        <li class="active"><a href="#">View Timetable</a></li>
                        <li><a href="#">Submit Assignment</a></li>
                    <?php endif; ?>
                </ul>
                <?php if (!empty($user)):?>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                           aria-expanded="false"><?php echo $user['full_name']; ?> <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><?php echo anchor('user/logout', 'Logout', "title='Logout'");?></li>
                        </ul>
                    </li>
                </ul>
                <?php endif; ?>
            </div><!--/.nav-collapse -->
        </div>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <?php echo $content_for_layout; ?>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <footer>
                    <p>&copy; Copyright 2016 <?php echo $this->config->item('institute'); ?></p>
                </footer>
            </div>
        </div>
    </div>
</body>
</html>