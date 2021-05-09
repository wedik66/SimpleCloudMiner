<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo settings('sitename'); ?> - Invest like rich</title>
	<meta name="description" content="<?php echo settings('description'); ?>">
	<meta name="keywords" content="<?php echo settings('keywords'); ?>">
	<meta name="author" content="Script by SmartyScripts.com">
	<link href="<?php echo themeAssets('img/favicon.png'); ?>" rel="shortcut icon" type="image/x-icon" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="<?php echo themeAssets('css/bootstrap.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo themeAssets('css/font-awesome.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo themeAssets('css/style.css'); ?>">
</head>
<body>
<div class="topmenu" id="top">
	<div class="container">
		<ul>
			<?php if($_SESSION['user_id']):?>
				<li><a href="<?php echo base_url('dashboard'); ?>">Dashboard</a></li>
				<li><a href="<?php echo base_url('account'); ?>">Account</a></li>
			<?php else: ?>
				<li><a href="<?php echo base_url(); ?>">Home</a></li>
			<?php endif; ?>
			<li><a href="<?php echo base_url('affiliate'); ?>">Affiliate Program</a></li>
			<li><a href="<?php echo base_url('payouts'); ?>">Payouts</a></li>
			<li><a href="<?php echo base_url('faq'); ?>">FAQ</a></li>
			<li><a href="<?php echo base_url('contact'); ?>">Contact Us</a></li>
		</ul>
		<div class="clearfix"></div>
	</div>
</div>
<div class="top-bar">
	<div class="container">
		The mining starts immediately. Free Plan give you 2% per day forever.
	</div>
</div>
<a href="<?php echo base_url(); ?>" class="logo-block">
	<span id='logo-change' class="logo"></span>
</a>
<div class="top-bg" id="header">
	<div class="top-bg-dark"></div>
