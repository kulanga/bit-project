<?php  apply_layout($layout); ?>

<div class="container">
	<div class="row"><br/></div>
	<div class="row">
		<div class="col-md-4">
			<form name="student_login_form" method="post" action="/user/process_login/student" >
				<div>
					<label>Registarion No</label>
					<input type="text" name="user_name" size="50"></input>
				</div>
				<div>
					<label>Password</label>
					<input type="password" name="password" size="50"></input>
				</div>
				<div>
					<button class="btn btn-primary" type="submit" name="student_login">Login</button>
				</div>
			</form>
		</div>
	</div>
</div>