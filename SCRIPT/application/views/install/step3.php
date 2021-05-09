<div class="card-header">
	Configure Enviroment
</div>
<div class="card-body">
	<p>Let's configure the database connection to proceed with the installation.</p>
	<?php include_once 'includes/alerts.php';?>
	<form action="<?php echo installRoute('install/step3');?>" method="post" id="formStep">
		<h5>Database Settings</h5>
		<p>
			<a class="btn btn-success" data-toggle="collapse" href="#databaseTutorial" role="button" aria-expanded="false" aria-controls="databaseTutorial"><i class="far fa-file-alt"></i> Short Tutorial</a>
			<a class="btn btn-danger" href="https://www.youtube.com/results?search_query=cpanel+create+database&page=&utm_source=opensearch" target="_blank"><i class="fab fa-youtube"></i> Video Tutorials on Youtube</a>
			<a class="btn btn-info" href="https://vimeo.com/search?q=cpanel%20create%20database" target="_blank"><i class="fab fa-vimeo"></i> Video Tutorials on Vimeo</a>
		</p>
		<div class="collapse" id="databaseTutorial">
			<div class="card card-body">
				<small>
					<ol>
						<li>Access the cPanel of your hosting</li>
						<li>Click on "MySQL® Databases"</li>
						<li>On "Create New Database", fill the field with a name for your database and click on "Create Database" button. Copy and paste the database name on "Database Name" field below</li>
						<li>On "Add New User", fill the field with a username for your database. Click on "Password Generator" button, copy the generated password and paste on "Database Password" field below. Check "I have copied this password in a safe place" field and click on "Use Password" button. Click on "Create User" button, copy and paste the username on "Database Username" field below.</li>
						<li>On "Add User To Database", choose the username and database created before, click on "Add" button, check "ALL PRIVILEGES" box and click on "Make Changes" button.</li>
					</ol>
				</small>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				<div class="form-group">
					<label>Database Driver</label>
					<select name="db_driver" class="form-control">
						<option value="mysqli">MySqli - Default</option>
					</select>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label>Database Host</label>
					<input type="text" name="db_host" class="form-control" placeholder="Your Database Host" value="<?php echo set_value('db_host'); ?>">
					<small class="form-text">Eg.: localhost, 127.0.0.1 or YourHostingDBUrl</small>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label>Database Port</label>
					<input type="number" name="db_port" class="form-control" placeholder="Your Database Port" value="<?php echo set_value('db_port'); ?>">
					<small class="form-text">Default 3306</small>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label>Database Name</label>
					<input type="text" name="db_name" class="form-control" placeholder="Your Database Name" value="<?php echo set_value('db_name'); ?>">
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label>Database Username</label>
					<input type="text" name="db_user" class="form-control" placeholder="Your Database Username" value="<?php echo set_value('db_user'); ?>">
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label>Database Password</label>
					<input type="text" name="db_pass" class="form-control" placeholder="Your Database Password" value="<?php echo set_value('db_pass'); ?>">
				</div>
			</div>
		</div>
	</form>
</div>
<div class="card-footer">
	<a href="<?php echo installRoute('install/step2');?>" class="btn btn-danger">Back</a>
	<button class="btn btn-info" onclick="(this).classList.add('disabled');(this).innerHTML='Working...<i class=\'fa fa-spinner fa-spin\'></i>';document.getElementById('formStep').submit();">Continue</button>
</div>
