<div class="container">
    <div class="row"><br/></div>
    <div class="row">

    	<?php if($user->is_email_verified == 0) {?>
    		<div class=" col-md-8 alert alert-warning" style="font-size: 18px;">
    		    You have successfully signed up on HNDE Students Portal. You will receive a verification email shortly. Please check your inbox. If you still not received a verification email, <a id="resend_verify_email" href="javascript:void(0);">Click here</a> to resend it.
    		</div>
    	<?php } ?>

    	<?php if($user->is_email_verified == 1 && $user->status == 4) { ?>
	        <div class=" col-md-8 alert alert-success" style="font-size: 15px;">
	          Hi <?=$this->session->userdata('full_name')?>, Thank your for sign up on Student Portal. Your account is under review, you will receive an email once portal admin approve your account.<br/><br/>

	          If you have any question please contact poral admin via <a href="mailto:<?php echo $this->config->item('admin_email')?>"><?php echo $this->config->item('admin_email')?></a>
	        </div>
        <?php } ?>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#resend_verify_email').on('click', function() {
            $.ajax({
                url: '/user/resend_verify_email',
                type: 'get',
                success: function(res) {
                    if(res == '1') {
                        alert('Verification email has been re-sent successfully. Please check your inbox.');
                    } else {
                        alert('An error occurred. Please try again');
                    }
                }
            });
        });
    });
</script>