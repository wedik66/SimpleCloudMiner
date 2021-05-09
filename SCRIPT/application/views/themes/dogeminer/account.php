    <div class="container">
        <div class="input-mine">
			<h1>Account</h1>
			<p>All history of your account, deposits, withdraws, referrals and comissions.</p>
            <div class="text-center" style="margin-bottom: 10px">
				<?php include_once __DIR__ . '/includes/social.php'; ?>
            </div>
        </div>
    </div>
</div>

<div class="serv-price">
	<div class="container">
		<?php include_once __DIR__ . '/includes/alerts.php'; ?>
		<h2>Update Account Details</h2>
		<div class="row text-center">
			<div class="col-md-6 col-md-offset-3">
				<form action="<?php echo base_url('account');?>" method="post" id="contactForm">
					<div class="form-group">
						<label>Email</label>
						<input type="email" id="email" name="email" class="form-control" placeholder="Your Email" value="<?php echo $this->userdata->email;?>" required />
					</div>
					<div class="form-group">
						<label>New Password</label>
						<input type="password" id="new_password" name="new_password" class="form-control" placeholder="Leave blank to do not change" />
					</div>
					<div class="form-group">
						<label>Confirm New Password</label>
						<input type="password" id="new_password_confirmation" name="new_password_confirmation" class="form-control" placeholder="Leave blank to do not change" />
					</div>
					<div class="form-group">
						<label>Current Password</label>
						<input type="password" id="password" name="password" class="form-control" placeholder="Your current password" required />
					</div>
					<button type="submit" class="btn btn-warning"><i class="fa fa-save"></i> Save</button>
				</form>
			</div>
		</div>
		<br>

		<h2>Your Account Status</h2>
		<br>

		<div class="panel-heading">
			<ul class="nav panel-tabs">
				<li role="presentation" class="active"><a href="#refs" data-toggle="tab">Referrals</a></li>
				<li role="presentation"><a href="#comissions" data-toggle="tab">Affiliate Earns</a></li>
				<li role="presentation"><a href="#deposits" data-toggle="tab">Deposits</a></li>
				<li role="presentation"><a href="#withdraws" data-toggle="tab">Withdraws</a></li>
				<li role="presentation"><a href="#transactions" data-toggle="tab">Pending Purchases</a></li>
			</ul>
		</div>

		<!-- Tab panes -->
		<div class="tab-content">
			<!-- START REFS -->
			<div role="tabpanel" class="tab-pane active" id="refs">
				<div class="table-responsive">
					<table class="table table-striped table-bordered">
						<tbody class="text-center">
						<tr>
							<th>Name</th>
							<th>Date of Joining</th>
							<th>IP Address</th>
						</tr>
						<?php
						if($referrals)
						{
							foreach ($referrals as $ref)
							{
								?>
								<tr>
									<td><?php echo substr($ref['username'],0,15); ?><b>xxxxx</b></td>
									<td><?php echo $ref['created_at']; ?></td>
									<td><?php echo $ref['ip_address']; ?></td>
								</tr>
								<?php
							}
						}
						else
						{
							?>
							<tr>
								<td colspan="3" class="text-center">No Records Found !!</td>
							</tr>
							<?php
						}
						?>
						</tbody>
					</table>
				</div>
			</div>
			<!-- END REFS -->
			<!-- START COMISSIONS -->
			<div role="tabpanel" class="tab-pane" id="comissions">
				<div class="table-responsive">
					<table class="table table-striped table-bordered">
						<tbody class="text-center">
						<tr>
							<th>Date</th>
							<th>Amount</th>
							<th>Status</th>
						</tr>
						<?php
						if($aff_earns)
						{
							foreach ($aff_earns as $aff_earn)
							{
								?>
								<tr>
									<td><?php echo $aff_earn['date']; ?></td>
									<td><?php echo $aff_earn['amount']; ?> <?php echo settings('currency_symbol');?></td>
									<td>
										<?php if($aff_earn['status']==='pending'): ?>
											<span class="label label-danger"><?php echo ucfirst($aff_earn['status']); ?></span>
										<?php elseif($aff_earn['status']==='paid'): ?>
											<span class="label label-success"><?php echo ucfirst($aff_earn['status']); ?></span>
										<?php endif; ?>
									</td>
								</tr>
								<?php
							}
						}
						else
						{
							?>
							<tr>
								<td colspan="3" class="text-center">No Records Found !!</td>
							</tr>
							<?php
						}
						?>
						</tbody>
					</table>
				</div>
			</div>
			<!-- END COMISSIONS -->
			<!-- START DEPOSITS -->
			<div role="tabpanel" class="tab-pane" id="deposits">
				<div class="table-responsive">
					<table class="table table-striped table-bordered">
						<tbody class="text-center">
						<tr>
							<th>Date</th>
							<th>Deposit Amount</th>
							<th>TXID</th>
							<th>Status</th>
						</tr>
						<?php
						if($deposits)
						{
							foreach ($deposits as $deposit)
							{
								?>
								<tr>
									<td><?php echo $deposit['created_at']; ?></td>
									<td><?php echo $deposit['amount']; ?> <?php echo settings('currency_symbol');?></td>
									<td><?php echo $deposit['tx']; ?></td>
									<td>
										<?php if($deposit['status']==='PENDING'): ?>
											<span class="label label-danger">Pending</span>
										<?php elseif($deposit['status']==='SUCCESS'): ?>
											<span class="label label-success">Paid</span>
										<?php else: ?>
											<span class="label label-warning"><?php echo ucfirst($deposit['status']); ?></span>
										<?php endif; ?>
									</td>
								</tr>
								<?php
							}
						}
						else
						{
							?>
							<tr>
								<td colspan="4" class="text-center">No Records Found !!</td>
							</tr>
							<?php
						}
						?>
						</tbody>
					</table>
				</div>
			</div>
			<!-- END DEPOSITS -->
			<!-- START WITHDRAWS -->
			<div role="tabpanel" class="tab-pane" id="withdraws">
				<div class="table-responsive">
					<table class="table table-striped table-bordered">
						<tbody class="text-center">
						<tr>
							<th>Date</th>
							<th>Withdrawal Amount</th>
							<th>TXID</th>
							<th>Status</th>
						</tr>
						<?php
						if($withdrawals)
						{
							foreach ($withdrawals as $wt)
							{
								?>
								<tr>
									<td><?php echo $wt['created_at']; ?></td>
									<td><?php echo $wt['amount']; ?> <?php echo settings('currency_symbol');?></td>
									<td>
										<?php if(settings('blockchain') !== '0'){ ?>
											<a href="<?php echo blockchainUrl($wt['tx']); ?>" target="_blank"><?php echo $wt['tx']; ?></a>
										<?php }else{ ?>
											<div class="text-danger"><?php echo $wt['tx'];?></div>
										<?php } ?>
									</td>
									<td>
										<?php if($wt['status']==='PENDING'): ?>
											<span class="label label-warning">Pending</span>
										<?php elseif($wt['status']==='SUCCESS'): ?>
											<span class="label label-success">Paid</span>
										<?php else: ?>
											<span class="label label-danger"><?php echo ucfirst($wt['status']); ?></span>
										<?php endif; ?>
									</td>
								</tr>
								<?php
							}
						}
						else
						{
							?>
							<tr>
								<td colspan="4" class="text-center">No Records Found !!</td>
							</tr>
							<?php
						}
						?>
						</tbody>
					</table>
				</div>
			</div>
			<!-- END WITHDRAWS -->
			<!-- START TRANSACTIONS -->
			<div role="tabpanel" class="tab-pane" id="transactions">
				<div class="table-responsive">
					<table class="table table-striped table-bordered">
						<tbody class="text-center">
						<tr>
							<th>Date</th>
							<th>Amount</th>
							<th>Status</th>
						</tr>
						<?php
						if($transactions)
						{
							foreach ($transactions as $transaction)
							{
								?>
								<tr>
									<td><?php echo $transaction['date']; ?></td>
									<td><?php echo $transaction['amount']; ?> <?php echo settings('currency_symbol');?></td>
									<td>
										<?php if($transaction['status']==='pending'): ?>
											<span class="label label-danger">Pending</span>
											<a class="btn btn-xs btn-success" href="<?php echo base_url('invoice/'.$transaction['hash']);?>">Pay Now</a>
										<?php elseif($transaction['status']==='waiting'): ?>
											<span class="label label-warning">Waiting Confirmations</span>
										<?php else: ?>
											<span class="label label-success"><?php echo ucfirst($transaction['status']); ?></span>
										<?php endif; ?>
									</td>
								</tr>
								<?php
							}
						}
						else
						{
							?>
							<tr>
								<td colspan="3" class="text-center">No Records Found !!</td>
							</tr>
							<?php
						}
						?>
						</tbody>
					</table>
				</div>
			</div>
			<!-- END TRANSACTIONS -->
		</div>
		<div class="clearfix"></div>
		<div class="referral-link">
			<h3 class="title copytext">Your referral link:</h3>
			<div class="link copy_btn" id="url_field" onclick="var addy=$('body').find('#url_field');window.getSelection().selectAllChildren(addy.get(0));">
				<h4><?php echo base_url('r/'.$this->userdata->unique_id); ?></h4>
			</div>
		</div>
	</div>
</div>
