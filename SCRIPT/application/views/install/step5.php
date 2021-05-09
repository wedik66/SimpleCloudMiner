<div class="card-header">
	Configure Admin User
</div>
<div class="card-body">
	<p>Let's configure the admin user to proceed with the installation.</p>
	<?php include_once 'includes/alerts.php';?>
	<form action="<?php echo installRoute('install/step5');?>" method="post" id="formStep">
		<h5>Default Admin User</h5>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label>Username <span class="text-danger">*</span></label>
					<input type="text" name="username" class="form-control" placeholder="Your Username" value="<?php echo set_value('username'); ?>" required>
					<small class="form-text">Your account username</small>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label>Email <span class="text-danger">*</span></label>
					<input type="email" name="email" class="form-control" placeholder="Your Email" value="<?php echo set_value('email'); ?>" required>
					<small class="form-text">Your email</small>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label>Password <span class="text-danger">*</span></label>
					<input type="text" name="password" class="form-control" placeholder="Your Password" value="<?php echo set_value('password'); ?>" required>
					<small class="form-text">Your account password</small>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label>Password Confirm <span class="text-danger">*</span></label>
					<input type="text" name="password_confirmation" class="form-control" placeholder="Confirm your Password" value="<?php echo set_value('password_confirmation'); ?>" required>
					<small class="form-text">Confirm your password</small>
				</div>
			</div>
		</div>
	</form>
</div>
<div class="card-footer">
	<a href="<?php echo installRoute('install/step4');?>" class="btn btn-danger">Back</a>
	<button class="btn btn-info" onclick="(this).classList.add('disabled');(this).innerHTML='Working...<i class=\'fa fa-spinner fa-spin\'></i>';document.getElementById('formStep').submit();">Continue</button>
</div>
