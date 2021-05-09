<div class="container">
	<div class="head-login">
		<div class="first-mine">
			<div class="text-center" style="margin-bottom: 10px">
				<?php include_once __DIR__ . '/includes/social.php'; ?>
			</div>
			<div class="text-center">You have entered via the following address:</div>
			<div class="mine-num notranslate" id="show_address">
				<?php echo substr($_SESSION['username'], 0, 29); ?><a style="cursor:pointer;"
																	  onclick="go_show_address()"
																	  title="Click to show Address">XXXXX</a>
			</div>
			<div class="row text-center">
				<div class="col-lg-6">
					<div class="log-mine">
						<h4>Your balance</h4>
						<input type="hidden" id="getBalance" value="<?php echo $this->userdata->balance; ?>"/>
						<span><font
								id="bal"><?php echo $this->userdata->balance; ?></font> <?php echo settings('currency_code'); ?></span>
					</div>
				</div>
				<div class="col-lg-6">
					<button type="button" class="btn btn-success btn-lg" onclick="location.href='withdrawal';">
						<i class="fa fa-money"></i> Withdrawal
					</button>
					<button type="button" class="btn btn-danger btn-lg" onclick="location.href='logout';">
						<i class="fa fa-sign-out"></i> Logout
					</button>
				</div>
			</div>
		</div>
	</div>
</div>
</div><!-- end top-bg -->

<div class="white-box">
	<div class="serv-price">
		<div class="container">
			<?php
			if(!$this->userdata->email):
				?>
				<div class="alert alert-danger">You must enter a valid email address, otherwise you will not be able to regain access to your account if you forget your password. <a href="<?php echo base_url('account');?>">Click here</a> to update your email.</div>
			<?php
			endif;
			?>
			<?php include_once __DIR__ . '/includes/alerts.php'; ?>
			<br>
			<h2>Your Active Plan</h2>
			<div class="serv-price-small clearfix">
				Here are all your active miners, each deposit is a separate miner.
			</div>
			<div class="table-responsive">
				<table class="table table-striped table-bordered">
					<tbody>
					<tr class="text-center">
						<th>Name</th>
						<th>Speed</th>
						<th>Earning Rate</th>
						<th>Start</th>
						<th>Time left</th>
						<th>Status</th>
					</tr>
					<?php
					$sumCD = 0;
					$sumER = 0;
					$sumSP = 0;
					foreach ($active_plans as $key => $plans):
						$sumER += $plans->earning_rate;
						$sumSP += $plans->speed;
						$sumCD += $plans->point_per_day;
						$duration = $plans->duration;
						if ($duration == 0) {
							$leftDays = 'Unlimited';
						} else {
							$now = date_create('now');
							$end = date_add(date_create($plans->created_at), date_interval_create_from_date_string($duration . ' days'));
							$left = date_diff($now, $end);
							$leftDays = $left->days . 'd ' . $left->h . 'h ' . $left->i . 'min';
						}
						?>
						<tr class="text-center">
							<td><?php echo $plans->version; ?></td>
							<td><?php echo $plans->speed; ?> H/s</td>
							<td><?php echo $plans->earning_rate; ?> <?php echo settings('currency_symbol'); ?></td>
							<td><?php echo $plans->created_at; ?></td>
							<td><?php echo $leftDays; ?></td>
							<td>
								<?php
								$sclass = $plans->status === 'active' ? 'success' : 'danger';
								echo "<span class='label label-{$sclass}'>" . ucfirst($plans->status) . "</span>";
								?>
							</td>
						</tr>
					<?php endforeach; ?>
					</tbody>
					<tfoot class="text-center">
					<tr>
						<td><b>Totals</b></td>
						<td><?php echo $sumSP; ?> H/s</td>
						<td colspan="4"><?php echo currencyFormat($sumER); ?> <?php echo settings('currency_symbol'); ?> min
							/ <?php echo currencyFormat($sumCD); ?> <?php echo settings('currency_symbol'); ?> day
						</td>
					</tr>
					</tfoot>
				</table>
			</div>
			<br>

			<h2 id="plans">Select your Package</h2>
			<div class="row" id='doge-def4'>
				<?php foreach ($allplans as $plan): ?>
					<div class="col-lg-3">
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
							<button type="button" class="price-button lgb" onclick="location.href='purchase/<?php echo $plan['id'];?>';">Buy
								for <?php echo currencyFormat($plan['price'],0); ?> <?php echo settings('currency_symbol'); ?></button>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</div>
