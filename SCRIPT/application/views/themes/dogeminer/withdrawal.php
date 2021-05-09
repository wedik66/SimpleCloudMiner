<div class="container">
		<div class="input-mine">
			<h1>Request Withdraw</h1>
			<p>Request withdraw of your earnings to your <?php echo settings('currency_name');?> Wallet.</p>
			<div class="text-center" style="margin-bottom: 10px">
				<?php include_once __DIR__ . '/includes/social.php'; ?>
			</div>
		</div>
</div>
</div><!-- end top-bg -->

<div class="serv-price">
	<div class="container">
		<div class="col-md-6 col-md-offset-3 text-center">
			<h2>Your earning balance: <?php echo $this->userdata->balance;?></h2>
			<br>
			<?php include_once __DIR__ . '/includes/alerts.php'; ?>
			<br>
			<div class="col-md-6">
				<div class="alert alert-success"><b>Min:</b> <?php echo settings('min_withdraw'); ?> <?php echo settings('currency_code');?></div>
			</div>
			<div class="col-md-6">
				<div class="alert alert-danger"><b>Max:</b> <?php echo settings('max_withdraw'); ?> <?php echo settings('currency_code');?></div>
			</div>
			<form action="<?php echo base_url('withdrawal'); ?>" method="POST">
				<div class="form-group">
					<label>Amount to Withdraw</label>
					<input type="number" step="any" id="amount" name="amount" class="form-control" required>
				</div>
				<div class="form-group">
					<label>Wallet Address</label>
					<input value="<?php echo $_SESSION['username'];?>" class="form-control" readonly>
				</div>
				<button type="submit" class="btn btn-success"><i class="fa fa-send"></i> Confirm Withdrawal</button>
			</form>
		</div>
	</div>
</div>
