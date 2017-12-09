
<script type="text/javascript" src="<?php echo asset_url();?>js/jquery.smartmarquee.js"></script>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2 class="center">Welcome to HNDE Students Portal</h2>
        </div>
    </div>
    <div class="row row-login-form">
        <div class="col-md-9">

            <div class="row">
                <div class="col-md-12">
                    <h3>ATI Mattakkuliya</h3>
                    <p>
                        Since 1986 the Higher National Diploma in Engineering (HNDE) program has been the pioneer in producing incorporated engineers for the local and international industry. The demand in the industry for HNDE students and the knowledge to work with internationally recognized modern equipments shows the quality and the standard of the course. Compared to local universities offering engineering degrees, ours as an engineering diploma awarding institute has a lot to be proud of in terms of the curriculum, facilities and employ-ability. The course content ensures that those who complete this program are satisfactorily employed both inside Sri Lanka and abroad...
                    </p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-7">
                    <div style="overflow:hidden;">
                        <img src="<?=base_url()?>assets/images/image.jpg">
                    </div>
                </div>

                <div class="col-md-5 col-xs-12">
                    <div>
                        <h1 class="h4">What's New</h1>
                    </div>
                    <div class="smartmarquee example">
                        <ul class="container">
                            <li> 14th Diplma Awarding Ceremony</li>
                            <li> Blood Donation </li>
                            <li> New Intake  </li>
                            <li> Inter ATI Sportmeet </li>
                           
                        </ul>
                    </div>
                </div>

            </div><br/>
        </div>

        <div class="col-md-3">
            <div class="row">

                <?php if(empty($panel) || !empty($panel) && $panel == 'login') {?>
                    <div class="login-panel panel panel-default">
                        <div class="panel-heading">
                            <h2 class="panel-title" style="font-size:23px;"><?php echo $login_as ?> - Sign In</h2>
                        </div>
                        <div class="panel-body">

                            <?php if(validation_errors()) {?>
                                <div class="validation-errors">
                                    <?php echo validation_errors();?>
                                </div>
                            <?php } ?>

                            <form action="/login/index" method="post" accept-charset="utf-8" autocomplete="off">
                                <div class="form-group">
                                    <label for="inputEmail">Username</label>
                                    <input type="test" class="form-control" id="username" name="username" placeholder="username">
                                </div>

                                <div class="form-group">
                                    <label for="inputPassword">Password</label>
                                    <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Password" autocomplete="off">
                                </div>

                                <a href="/login/forget_password">Forget password?</a>
                                <button type="submit" style="float:right;" class="btn btn-primary">Login</button>
                            </form>
                        </div>
                    </div>
                <?php } ?>

                <?php if(!empty($panel) && $panel == 'forget_password') {?>
                    <div class="recover-pwd-panel panel panel-default">
                        <div class="panel-heading">
                            <h2 class="panel-title" style="font-size:23px;">Recover Password</h2>
                        </div>
                        <div class="panel-body">
                            <form action="/login/forget_password" method="post" accept-charset="utf-8">
                                <div class="form-group">
                                    <p>
                                        Enter the email address you used when you created the account.
                                        You will receive an email with the information you need to change your password.
                                    </p>
                                </div>

                                <div class="form-group">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" required="">
                                </div>

                                <a href="/login">Back to login</a>
                                <button type="submit" style="float:right;" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                <?php } ?>

            </div>

            <div class="row">
                <div class="login-panel panel panel-default">
                    <div class="panel-body">
                        <a href="/student/signup" class="btn btn-lg btn-warning">Register as a Student</a>
                    </div>
                </div>
            </div>

            <?php if(empty($panel) || !empty($panel) && $panel == 'login') {?>
                <div class="row">
                    <div class="login-panel panel panel-default">
                        <div class="panel-body">
                            <?php if (isset($is_lecturer_login) && $is_lecturer_login == 1) { ?>
                                <a href="/login/index" class="btn btn-lg btn-success">Sigin In as a Student</a>
                            <?php } else {?>
                                <a href="/login/lecturer" class="btn btn-lg btn-success">Sigin In as a Lecturer</a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<style type="text/css">
    .smartmarquee {
        position: relative;
        overflow: hidden;
    }
    .smartmarquee .container {
        position: absolute;
    }

    a { cursor: pointer }

    .example {
      height: 200px;
      /*width: 300px;*/
      -moz-box-shadow: 1px 1px 5px #999;
      -webkit-box-shadow: 1px 1px 5px #999;
      box-shadow: 1px 1px 5px #999;
    }

    .example .container {
      margin: 0;
      padding: 0;
    }

    .example .container li {
      width: 285px;
      margin: 0 0 0 5px;
      padding: 5px 0 5px 0;
      border-bottom: 1px dotted #999
    }
</style>

<script type="text/javascript">

    $(document).ready(function () {
        $(".example").smartmarquee({
            // animate duration
            duration: 1000,
            // auto loop
            loop : true,
            // interval duration
            interval : 2000,
            axis : "vertical",
        });
    });

</script>

