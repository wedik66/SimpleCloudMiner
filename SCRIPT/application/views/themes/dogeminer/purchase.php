<div class="container">
	<div class="input-mine">
		<h1>Purchase Plan</h1>
		<p>Congratulations on your decision to invest in our project and get more profit with a paid mining plan!</p>
		<div class="text-center" style="margin-bottom: 10px">
			<?php include_once __DIR__ . '/includes/social.php'; ?>
		</div>
	</div>
</div>
</div>
<div class="white-box">
	<div class="serv-price">
		<div class="container">
			<div class="col-sm-6 col-sm-offset-3">
				<div class="panel panel-info">
					<div class="panel-heading">
						<h2>Complete Your Purchase</h2>
					</div>
					<div class="panel-body">
						<p class="list-group-item"><b>Purchase Price:</b> <?php echo $invoice['price']; ?> <?php echo settings('currency_code');?></p>
						<p class="list-group-item"><b>Payment Address:</b>
							<input class="form-control" onclick="this.select();" value="<?php echo $params['address'];?>" readonly>
							<span class="help-block">* Click to select all</span>
						</p>
						<p class="list-group-item">
							<b>Instructions:</b><br>
							Send exactly <b><?php echo $params['amount']; ?></b> <?php echo settings('currency_name');?> to above address.<br><br>
							<b>Confirmations:</b><br>
							<?php echo $params['confirms_needed'];?> confirmations required to accept your payment.<br><br>
							<b>Timeout:</b><br>
							You have <b><?php echo $time_left->i.'m '.$time_left->s.'s';?></b> minutes to pay your purchase.<br><br>
							<b>QRCODE:</b><br>
							You can scan this QR code with your mobile wallet app to make a payment.<br><br>
							<b>Status:</b><br>
							You can track the status of your payment at the link below.<br>
							<a href="<?php echo $params['status_url']; ?>" target="_blank" class="btn btn-info"><i class="fa fa-clock-o"></i> Payment Status</a>
						</p>
						<p>
						<div class="text-center">
							<br>
							<img src="<?php echo $params['qrcode_url']; ?>" alt="QrCode" style="width: 300px; height: 300px" class="img-thumbnail" />
						</div>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
