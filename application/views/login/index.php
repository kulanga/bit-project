<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2 class="center">Welcome to HNDE Students Portal</h2>
        </div>
    </div>
    <div class="row row-login-form">
        <div class="col-md-8">
            <h3>What is Lorem Ipsum?</h3>
            <p>
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum
            </p>
            <div>
                <img src="https://dummyimage.com/600x300/cccccc/fff">
            </div><br/>
        </div>
        <div class="col-md-4">
            <div class="row">

                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h2 class="panel-title" style="font-size:25px;"><?php echo $login_as ?> - Sign In</h2>
                    </div>
                    <div class="panel-body">

                        <?php if(validation_errors()) {?>
                            <div class="validation-errors">
                                <?php echo validation_errors();?>
                            </div>
                        <?php } ?>

                        <form action="/login/index" method="post" accept-charset="utf-8">
                            <div class="form-group">
                                <label for="inputEmail">Username</label>
                                <input type="test" class="form-control" id="username" name="username" placeholder="username">
                            </div>

                            <div class="form-group">
                                <label for="inputPassword">Password</label>
                                <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Password">
                            </div>
                            
                            <a href="javascript:alert('Implement me...')">Forget password?</a>
                            <button type="submit" style="float:right;" class="btn btn-primary">Login</button>
                        </form>
                    </div>
                </div>


            </div>

            <div class="row">
                <div class="login-panel panel panel-default">
                    <div class="panel-body">
                        <a href="/student/signup" class="btn btn-lg btn-warning">Register as a Student</a>
                    </div>
                </div>
            </div>

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
        </div>
    </div>
</div>

