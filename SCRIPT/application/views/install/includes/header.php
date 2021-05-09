<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title><?php echo SC_NAME; ?> - Install Wizard</title>

	<!-- Bootstrap core CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<!-- FontAwesome CSS -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

</head>

<body>
<div class="container">
	<div class="row">
		<div class="col-lg-12 text-center"><h1><?php echo SC_NAME; ?> - Install Wizard</h1></div>
	</div>
	<hr>
	<div class="row">
		<div class="col-lg-2 col-sm-12 mb-2">
			<div class="list-group stepsmenu">
				<a href="<?php echo installRoute('install');?>" class="list-group-item list-group-item-action" id="home">Welcome</a>
				<a href="<?php echo installRoute('install/step1');?>" class="list-group-item list-group-item-action">Step 1</a>
				<a href="<?php echo installRoute('install/step2');?>" class="list-group-item list-group-item-action">Step 2</a>
				<a href="<?php echo installRoute('install/step3');?>" class="list-group-item list-group-item-action">Step 3</a>
				<a href="<?php echo installRoute('install/step4');?>" class="list-group-item list-group-item-action">Step 4</a>
				<a href="<?php echo installRoute('install/step5');?>" class="list-group-item list-group-item-action">Step 5</a>
				<a href="<?php echo installRoute('install/step6');?>" class="list-group-item list-group-item-action">Step 6</a>
			</div>
		</div>
		<div class="col-lg-10 col-sm-12">
			<div class="card card-primary">
