<div class="container">
	<div class="input-mine">
		<h1>Reliable online wallet for <?php echo settings('currency_name'); ?></h1>
		<p>It's very easy: your mining equipment launches after registration. Once you have set up your account, you can
			start earning your first coins from our <?php echo settings('currency_name'); ?> cloud mining service!</p>
		<div class="text-center" style="margin-bottom: 10px">
			<?php include_once __DIR__ . '/includes/social.php'; ?>
		</div>
		<div class="row">
			<div class="col-lg-10 col-lg-offset-1">
				<form action="<?php base_url(); ?>" method="post" class="form-inline">
					<input type="hidden" name="reference_user_id"
						   id='reference_user_id' value="<?php echo get_cookie('ref', true); ?>">
					<input type="text" id="username" minlength="<?php echo settings('wallet_min'); ?>"
						   maxlength="<?php echo settings('wallet_max'); ?>" pattern="[a-zA-Z0-9_-]+" name="username"
						   placeholder="Enter Your <?php echo settings('currency_name'); ?> Address"
						   class="form-control">
					<input type="password" id="password" minlength="4" name="password" placeholder="Enter Your Password"
						   class="form-control">
					<button class="but-hover" id="go_enter" onclick="return validateFormLogin();">Start mining</button>
				</form>
			</div>
			<a class="btn btn-info btn-link" data-toggle="modal" data-target="#fogotPassword">Forgot your password?</a>
		</div>
		<div class="clearfix"></div>
		<div id="result"></div>
	</div>
</div>
</div><!-- end top-bg -->

<div class="serv-price">
	<div class="container">
		<h2 id="plans">Find your Mining Plan</h2>
		<div id='doge-def2' class="serv-price-small clearfix">
			Cloud mining is greatly suited for novice miners who would like to try out mining and earning
			cryptocurrency; as well as seasoned miners who don't want the hassle or risks spent on home mining equipment
			maintenance.
		</div>
		<div class="row" id='doge-def4'>
			<?php foreach ($allplans as $plan): ?>
				<div class="col-md-3">
					<div class="price-box">
						<img class="img-responsive center-block" src="<?php echo plansAssets($plan['image']); ?>"
							 style="width:140px; padding-top: 20px; padding-bottom: 20px;"
							 alt="<?php echo $plan['version']; ?>"/>
						<h3><?php echo $plan['version']; ?></h3>
						<ul>
							<li><span class="d-block">Earning rate</span> <?php echo $plan['point_per_day']; ?> <?php echo settings('currency_symbol'); ?> per day</li>
							<li><span class="d-block">Profit</span>
								<?php echo $plan['profit']; ?>%
								<?php if ($plan['duration'] == 0) {
									echo 'forever';
								} else {
									echo "for {$plan['duration']} days";
								} ?></li>
							<?php if($plan['duration'] != 0){
								echo '<li><span class="d-block">Total Profit</span>'. currencyFormat($plan['point_per_day'] * $plan['duration'],2). ' '.settings('currency_symbol').'</li>';
							}?>
							<li><span>Affiliate bonus</span> <?php echo settings('aff_comission'); ?>%</li>
						</ul>
						<button type="button" class="price-button lgb" onclick="location.href='#top';">Buy
							for <?php echo currencyFormat($plan['price'], 0); ?> <?php echo settings('currency_symbol'); ?></button>
					</div>
				</div>
			<?php endforeach; ?>
		</div>

	</div>
</div>
<div class="mine-result">
	<div class="container">
		<div class="row">
			<div class="col-lg-9 col-sm-12">
				<h2>Statistics</h2>
				<div class="row text-center">
					<?php $footer_col = (settings('show_start_date') === 'yes')?'3':'4'; ?>
					<div class="col-lg-<?php echo $footer_col; ?> col-sm-12">
						<span><?php echo $totalUsers; ?></span>
						<div class="clearfix"></div>
						Total Users
					</div>
					<div class="col-lg-<?php echo $footer_col; ?> col-sm-12">
						<span><?php echo currencyFormat($totalDeposits); ?><?php echo settings('currency_symbol'); ?></span>
						<div class="clearfix"></div>
						Total Investments
					</div>
					<div class="col-lg-<?php echo $footer_col; ?> col-sm-12">
						<span><?php echo currencyFormat($totalPaid); ?><?php echo settings('currency_symbol'); ?></span>
						<div class="clearfix"></div>
						Total Paid
					</div>
					<?php if (settings('show_start_date') === 'yes'): ?>
						<div class="col-lg-<?php echo $footer_col; ?> col-sm-12">
							<span><?php echo project_start_date(); ?></span>
							<div class="clearfix"></div>
							Online Days
						</div>
					<?php endif; ?>
				</div>
			</div>
			<div class="col-lg-3 col-sm-12 text-center">
				<a href="<?php echo base_url('payouts'); ?>" class="result-button">See payment proofs</a>
			</div>
		</div>
	</div>
</div>
