<div class="card-header">
	Configure Site
</div>
<div class="card-body">
	<p>Let's configure the basic script data to proceed with the installation.</p>
	<?php include_once 'includes/alerts.php';?>
	<form action="<?php echo installRoute('install/step4');?>" method="post" id="formStep">
		<h5>Basic Settings</h5>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label>Site Name <span class="text-danger">*</span></label>
					<input type="text" name="sitename" class="form-control" placeholder="Your Site Name" value="<?php echo set_value('sitename'); ?>" required>
					<small class="form-text">Name of your site</small>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label>Site URL <span class="text-danger">*</span></label>
					<input type="url" name="app_url" class="form-control" placeholder="Your Site URL" value="<?php echo set_value('app_url',installRoute()); ?>" required>
					<small class="form-text">Eg.: http://www.yoursite.com/. With / at end</small>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label>Security Hash <span class="text-danger">*</span></label>
					<input type="text" name="hash" class="form-control" placeholder="Security Hash" value="<?php echo set_value('hash',bin2hex(random_bytes(10))); ?>" required>
					<small class="form-text">Security Hash for Coinpayments Transactions</small>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label>Admin Route Prefix <span class="text-danger">*</span></label>
					<input type="text" name="admin_prefix" class="form-control" placeholder="Admin Route Prefix" value="<?php echo set_value('admin_prefix','admin'); ?>" required>
					<small class="form-text">Prefix to admin area. Eg.: yoursite.com/adminpanel</small>
				</div>
			</div>
		</div>
		<hr>
		<h5>Mail Settings (Outgoing Server)</h5>
		<p>
			<a class="btn btn-success" data-toggle="collapse" href="#emailTutorial" role="button" aria-expanded="false" aria-controls="emailTutorial"><i class="far fa-file-alt"></i> Short Tutorial</a>
			<a class="btn btn-danger" href="https://www.youtube.com/results?search_query=cpanel+create+email&page=&utm_source=opensearch" target="_blank"><i class="fab fa-youtube"></i> Video Tutorials on Youtube</a>
			<a class="btn btn-info" href="https://vimeo.com/search?q=cpanel%20create%20email" target="_blank"><i class="fab fa-vimeo"></i> Video Tutorials on Vimeo</a>
		</p>
		<div class="collapse" id="emailTutorial">
			<div class="card card-body">
				<small>
					<ol>
						<li>Access the cPanel of your hosting</li>
						<li>Click on "Email Accounts"</li>
						<li>Click on "Create" button</li>
						<li>On "Domain", choose your domain(if you have more than one)</li>
						<li>On "Username" field, choose a username to use. This username will be your email address. Eg.: youUsername@yourDomain.com. Copy and paste this email address on "Mail Username" field below</li>
						<li>On "Password" field, choose a password for this mail account. Fill "Mail Password" field below with this same password</li>
						<li>Click on "Create" button to create this mail address</li>
						<li>In the list of email accounts, locate the created email, click on "Connect Devices"</li>
						<li>On "Mail Client Manual Settings", copy the "Outgoing Server" url and paste on "Mail Host" field below</li>
						<li>Copy and paste "SMTP Port" number on "Mail Port" field below</li>
					</ol>
				</small>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				<div class="form-group">
					<label>Mail Host</label>
					<input type="text" name="mail_host" class="form-control" placeholder="Your Mail Host" value="<?php echo set_value('mail_host'); ?>">
					<small class="form-text">Eg.: mail.yourdomain.com | smtp.yourdomain.com</small>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label>Mail Port</label>
					<input type="number" name="mail_port" min="1" class="form-control" placeholder="Your Mail Port" value="<?php echo set_value('mail_port'); ?>">
					<small class="form-text">Eg.: 465, 587</small>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label>Mail Username</label>
					<input type="text" name="mail_user" class="form-control" placeholder="Your Mail Username" value="<?php echo set_value('mail_user'); ?>">
					<small class="form-text">Eg.: username@yourdomain.com</small>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label>Mail Password</label>
					<input type="text" name="mail_pass" class="form-control" placeholder="Your Mail Password" value="<?php echo set_value('mail_pass'); ?>">
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label>Mail Encryption</label>
					<select name="mail_encryption" class="form-control">
						<option value="ssl">SSL - Default</option>
						<option value="tls">TLS</option>
						<option value="null">None</option>
					</select>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label>Send Mail From Address</label>
					<input type="text" name="mail_sender" class="form-control" placeholder="Email sender address" value="<?php echo set_value('mail_sender'); ?>">
					<small class="form-text">Eg.: username@gmail.com</small>
				</div>
			</div>
		</div>
		<hr>
		<h5>Coinpayments Basic Settings</h5>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label>Merchant ID <span class="text-danger">*</span></label>
					<input type="text" name="merchant" class="form-control" placeholder="Your Merchant ID" value="<?php echo set_value('merchant'); ?>" required>
					<small class="help-block">Click <a href="https://www.coinpayments.net/acct-settings" target="_blank">here</a>. Can be found on 'Basic Settings' tab.</small>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label>IPN Secret Key <span class="text-danger">*</span></label>
					<input type="text" name="ipnsecret" class="form-control" placeholder="Your IPN Secret Key" value="<?php echo set_value('ipnsecret'); ?>" required>
					<small class="help-block">Click <a href="https://www.coinpayments.net/acct-settings" target="_blank">here</a>. Set this on 'Merchant Settings' tab, IPN Secret Key.</small>
				</div>
			</div>
			<div class="col-md-12">
				<h5>Coinpayments API Settings</h5>
				<p>The settings below are mandatory only if you intend to use <b>API mode</b>, which generates a payment address with QRcode.</p>
				<p>If you intend to use the <b>Gateway mode</b>, which redirects the user to the Coinpayments website to make the payment, it is not necessary to generate API keys in your Coinpayments account or complete the fields below.</p>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label>Private Key</label>
					<input type="text" name="privatekey" class="form-control" placeholder="Your API Private Key" value="<?php echo set_value('privatekey'); ?>" required>
					<small class="help-block">Click <a href="https://www.coinpayments.net/acct-api-keys" target="_blank">here</a> to get your key</small>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label>Public Key</label>
					<input type="text" name="publickey" class="form-control" placeholder="Your API Public Key" value="<?php echo set_value('publickey'); ?>" required>
					<small class="help-block">Click <a href="https://www.coinpayments.net/acct-api-keys" target="_blank">here</a> to get your key</small>
				</div>
			</div>
			<div class="col-md-12">
				<div class="alert alert-danger">
					<b>Warning!</b> Follow the Documentation's recommendations to have the best possible level of security and avoid financial loss.
				</div>
				<div class="alert alert-danger">
					<b>Warning!</b> Make sure that the fields have been filled in correctly, these settings cannot be changed in the admin, only manually.
				</div>
			</div>
		</div>
	</form>
</div>
<div class="card-footer">
	<a href="<?php echo installRoute('install/step3');?>" class="btn btn-danger">Back</a>
	<button class="btn btn-info" onclick="(this).classList.add('disabled');(this).innerHTML='Working...<i class=\'fa fa-spinner fa-spin\'></i>';document.getElementById('formStep').submit();">Continue</button>
</div>
