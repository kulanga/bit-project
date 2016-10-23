<div class="container">
    <div class="row">
        <div class="col-md-12"></div>
    </div>
    <div class="row row-login-form">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h2 class="panel-title" style="font-size:25px;">Sign In</h2>
                </div>
                <div class="panel-body">

                    <?php if(validation_errors()) {?>
                        <div class="validation-errors">
                            <?php echo validation_errors();?>
                        </div>
                    <?php } ?>

                    <?php echo form_open('/login/index'); ?>
                        <div class="form-group">
                            <label for="inputEmail">Username</label>
                            <input type="test" class="form-control" id="username" name="username" placeholder="username">
                        </div>

                        <div class="form-group">
                            <label for="inputPassword">Password</label>
                            <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Password">
                        </div>
                        
                        <a href="/student/signup" class="btn btn-warning">Signup as a Student</a>
                        <button type="submit" style="float:right;" class="btn btn-primary">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

