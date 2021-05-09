<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- Breadcrumb-->
<div class="breadcrumb-holder">
	<div class="container-fluid">
		<ul class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?php echo adminRoute(); ?>">Home</a></li>
			<li class="breadcrumb-item active">Dashboard</li>
		</ul>
	</div>
</div>
<br>
<section class="statistics">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12 col-lg-6">
				<!-- Withdrawals -->
				<div class="card income text-center">
					<div class="icon"><i class="fa fa-calendar"></i></div>
					<div class="number"><?php echo $statistics['pending_withdrawals']; ?></div>
					<strong class="text-primary">Pending Withdrawals</strong>
				</div>
			</div>
			<div class="col-sm-12 col-lg-6">
				<!-- Messages -->
				<div class="card income text-center">
					<div class="icon"><i class="fa fa-envelope"></i></div>
					<div class="number"><?php echo $statistics['messages']; ?></div>
					<strong class="text-primary">Unread Messages</strong>
				</div>
			</div>
		</div>
		<br>
		<div class="row">
			<!-- Users -->
			<div class="col-lg-4">
				<div class="card income text-center">
					<div class="icon"><i class="fa fa-users"></i></div>
					<div class="number"><?php echo $all_users; ?></div>
					<strong class="text-primary">Total Users</strong>
					<p><b><?php echo $statistics['users_today']; ?></b> today</p>
				</div>
			</div>
			<!-- Admins -->
			<div class="col-lg-4">
				<div class="card income text-center">
					<div class="icon"><i class="fa fa-user-secret"></i></div>
					<div class="number"><?php echo $all_admins; ?></div>
					<strong class="text-primary">Total Admins</strong>
				</div>
			</div>
			<div class="col-sm-12 col-lg-4">
				<!-- Plans -->
				<div class="card income text-center">
					<div class="icon"><i class="fa fa-cubes"></i></div>
					<div class="number"><?php echo $statistics['plans']; ?></div>
					<strong class="text-primary">Total Plans</strong>
				</div>
			</div>
		</div>
		<br>
		<div class="row d-flex">
			<div class="col-sm-12 col-lg-6">
				<!-- Deposits -->
				<div class="card income text-center">
					<div class="icon"><i class="fa fa-bank"></i></div>
					<div
						class="number"><?php echo settings('currency_symbol'); ?><?php echo currencyFormat($statistics['deposits']); ?></div>
					<strong class="text-primary">Total Deposits</strong>
					<p>
						<b><?php echo settings('currency_symbol'); ?> <?php echo currencyFormat($statistics['deposits_today']); ?></b>
						today</p>
				</div>
			</div>
			<div class="col-sm-12 col-lg-6">
				<!-- Withdrawal -->
				<div class="card income text-center">
					<div class="icon"><i class="fa fa-money"></i></div>
					<div
						class="number"><?php echo settings('currency_symbol'); ?><?php echo currencyFormat($statistics['withdrawals']); ?></div>
					<strong class="text-primary">Total Withdrawals</strong>
					<p>
						<b><?php echo settings('currency_symbol'); ?> <?php echo currencyFormat($statistics['withdrawals_today']); ?></b>
						today</p>
				</div>
			</div>
		</div>
		<br>
		<div class="row d-flex">
			<div class="col-sm-12 col-lg-12">
				<!-- Profit -->
				<div class="card income text-center">
					<div class="icon"><i class="fa fa-area-chart"></i></div>
					<div
						class="number"><?php echo settings('currency_symbol'); ?><?php echo currencyFormat($profit); ?></div>
					<strong class="text-primary">Total Profit</strong>
					<p><b><?php echo settings('currency_symbol'); ?> <?php echo currencyFormat($profit_today); ?></b>
						today</p>
				</div>
			</div>
		</div>
		<br>
		<div class="row d-flex">
			<div class="col-sm-12 col-lg-12">
				<!-- Script Info -->
				<div class="card income text-center">
					<dl class="row mb-0">
						<dt class="col-sm-12 col-lg-3">Script Name</dt>
						<dd class="col-sm-12 col-lg-9"><?php echo SC_NAME; ?></dd>

						<dt class="col-sm-12 col-lg-3">Script Version</dt>
						<dd class="col-sm-12 col-lg-9"><?php echo SC_VERSION; ?></dd>

						<!--<dt class="col-sm-12 col-lg-3">Creator</dt>
						<dd class="col-sm-12 col-lg-9"><a href="https://smartyscripts.com" target="_blank">Smarty
								Scripts</a></dd>-->
					</dl>
				</div>
			</div>
		</div>
	</div>
</section>
<br>
<?php include('ipnlogs/logger.php'); ?>
