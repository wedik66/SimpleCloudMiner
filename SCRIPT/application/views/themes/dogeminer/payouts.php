    <div class="container">
        <div class="input-mine">
			<h1>Start earning now</h1>
			<p>We are experts in the field of trading and investment of <?php echo settings('currency_name');?>, and we're want to share our best practice with EVERYONE! <?php echo settings('currency_name');?> market capitalization growing everyday. Don't miss your chance to earn on this wave. Join our team now!</p>
            <div class="text-center" style="margin-bottom: 10px">
				<?php include_once __DIR__ . '/includes/social.php'; ?>
            </div>
        </div>
    </div>
</div>

<div class="wrapper white-box">
    <div class="container">
		<div class="payouts-box">

			<div class="alert alert-info text-center">Estimated total payouts of <b><?php echo $totalpayments;?> <?php echo settings('currency_code');?></b> since launch date!</div>

			<h2 class="wrap-title">10 Last Payouts</h2>

			<div class="table-responsive">
				<table class="table table-striped table-bordered">
					<tbody>
					<tr>
						<th>Date</th>
						<th>Amount</th>
						<th>Address</th>
						<th>TXID</th>
					</tr>
					<?php if($withdrawals): ?>
						<?php foreach($withdrawals as $pmt): ?>
							<tr align="center">
								<td><?php echo $pmt['date_paid'];?></td>
								<td class="coin"><?php echo $pmt['amount'];?> <?php echo settings('currency_symbol');?></td>
								<td><?php echo substr($pmt['username'],0,20);?><b>XXXX</b></td>
								<td>
									<?php if(settings('blockchain')!=='0'){ ?>
										<a href="<?php echo blockchainUrl($pmt['tx']);?>" target="_blank"><?php echo substr($pmt['tx'],0,20);?><b>XXXX</b></a>
									<?php }else{ ?>
										<div class="text-danger"><?php echo substr($pmt['tx'],0,20);?><b>XXXX</b></div>
									<?php } ?>
								</td>
							</tr>
						<?php endforeach; ?>
					<?php else: ?>
						<tr align="center">
							<td colspan="4" class="text-center">No results!</td>
						</tr>
					<?php endif; ?>
					</tbody>
				</table>
			</div>

			<h2 class="wrap-title">10 Last Deposits</h2>

			<div class="table-responsive">
				<table class="table table-striped table-bordered">
					<tbody>
					<tr>
						<th>Date</th>
						<th>Amount</th>
						<th>Address</th>
						<th>TXID</th>
					</tr>
					<?php if($deposits): ?>
						<?php foreach($deposits as $dps): ?>
							<tr align="center">
								<td><?php echo $dps['date_paid'];?></td>
								<td class="coin"><?php echo $dps['amount'];?> <?php echo settings('currency_symbol');?></td>
								<td><?php echo substr($dps['username'],0,20);?><b>XXXX</b></td>
								<td>
									<?php if(settings('blockchain')!=='0'){ ?>
									<a href="<?php echo blockchainUrl($dps['tx']);?>" target="_blank"><?php echo substr($dps['tx'],0,20);?><b>XXXX</b></a>
									<?php }else{ ?>
										<div class="text-danger"><?php echo substr($dps['tx'],0,20);?><b>XXXX</b></div>
									<?php } ?>
								</td>
							</tr>
						<?php endforeach; ?>
					<?php else: ?>
						<tr align="center">
							<td colspan="4" class="text-center">No results!</td>
						</tr>
					<?php endif; ?>
					</tbody>
				</table>
			</div>

		</div>
    </div>
</div>
