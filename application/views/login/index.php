<div class="container">
    <div class="row">
        <div class="col-md-12"></div>
    </div>
    <div class="row row-login-form">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Please Sign In</h3>
                </div>
                <div class="panel-body">

                    <?php echo validation_errors(); ?>
                    <?php echo form_open('/login/index'); ?>
                        <div class="form-group">
                            <label for="inputEmail">Username</label>
                            <input type="test" class="form-control" id="username" name="username" placeholder="username">
                        </div>

                        <div class="form-group">
                            <label for="inputPassword">Password</label>
                            <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Password">
                        </div>
                        <button type="submit" class="btn btn-primary">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

