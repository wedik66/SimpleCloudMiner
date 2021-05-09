<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!-- Breadcrumb-->
<div class="breadcrumb-holder">
	<div class="container-fluid">
		<ul class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?php echo adminRoute(); ?>">Home</a></li>
			<li class="breadcrumb-item active">Coinpayments Auto Withdrawals Addon</li>
		</ul>
	</div>
</div>
<!-- /. ROW  -->
<section>
	<div class="container-fluid">
		<header>
			<?php $this->load->view('admin/includes/alerts'); ?>
			<h1 class="h3 display">Coinpayments Auto Withdrawals Addon</h1>
		</header>

		<div class="row">
			<div class="col-sm-12 col-lg-12">
				<div class="card">
					<div class="card-header">
						Settings
						<small class="text-muted pull-right clearfix">v<?php echo $this->addon_version; ?></small>
					</div>
					<div class="card-body">
						<h4>API Settings</h4>
						<form method="post" action="<?php echo adminRoute('coinpayments'); ?>"
							  class="form-horizontal" style="margin-top: 1em">
							<div class="row">
								<div class="col-lg-12 col-sm-12">
									<div class="form-group">
										<label>Server IP</label>
										<span class="text-danger">If the IP address is incorrect, use the IP address of the error message returned when using the "Get Withdrawal History" button.</span></small>
									</div>
								</div>
								<div class="col-lg-6 col-sm-12">
									<div class="form-group">
										<label>Transaction Fees</label>
										<select class="form-control" name="tx_fee">
											<option value="">-- Select --</option>
											<option value="owner" <?php echo $config['tx_fee'] === 'owner' ? 'selected' : ''; ?>>
												Admin
											</option>
											<option value="user" <?php echo $config['tx_fee'] === 'user' ? 'selected' : ''; ?>>
												User
											</option>
										</select>
										<small>Who pays transaction fee</small>
									</div>
								</div>
								<div class="col-lg-6 col-sm-12">
									<div class="form-group">
										<label>Payment Mode</label>
										<select class="form-control" name="auto_confirm">
											<option value="">-- Select --</option>
											<option value="1" <?php echo $config['auto_confirm'] === '1' ? 'selected' : ''; ?>>
												Auto
											</option>
											<option value="0" <?php echo $config['auto_confirm'] === '0' ? 'selected' : ''; ?>>
												Manual
											</option>
										</select>
										<small>Auto: instant withdrawal. Manual: email confirmation link</small>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="form-group">
									<div class="col-sm-offset-2 col-sm-10">
										<button type="submit" class="btn btn-info"><i class="fa fa-save"></i>
											Save
										</button>
									</div>
								</div>
							</div>
						</form>

						<h4>Actions</h4>
						<dl class="row">
							<dt class="col-lg-3"><a href="<?php echo adminRoute('coinpayments/latest_withdraws'); ?>"
													class="btn btn-success btn-sm"><i class="fa fa-bank"></i> Get
									Withdrawal History</a></dt>
							<dd class="col-lg-9"> Get 25 Latest Withdrawals</dd>
						</dl>
					</div>
					<div class="card-footer">
						<a href="<?php echo adminRoute('coinpayments/uninstall'); ?>" class="btn btn-danger"><i
									class="fa fa-cog"></i> Uninstall</a>
					</div>
				</div>
				<?php if ($this->session->flashdata('withdraws')): ?>
					<div class="card">
						<div class="card-header">Latest 25 Withdraws</div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-striped">
									<thead>
									<tr>
										<th>#</th>
										<th>Coin</th>
										<th>Amount</th>
										<th>Address</th>
										<th>TXID</th>
										<th>Status</th>
										<th>Date</th>
									</tr>
									</thead>
									<tbody>
									<?php
									if (count($this->session->flashdata('withdraws')) != 0):
										foreach ($this->session->flashdata('withdraws') as $withdraw) {
											echo '<tr>';
											echo '<td>' . $withdraw['id'] . '</td>';
											echo '<td>' . $withdraw['coin'] . '</td>';
											echo '<td>' . $withdraw['amountf'] . '</td>';
											echo '<td>' . $withdraw['send_address'] . '</td>';
											echo '<td>' . $withdraw['send_txid'] . '</td>';
											echo '<td>' . $withdraw['status'] . '</td>';
											echo '<td>' . date('Y-m-d H:i:s', $withdraw['time_created']) . '</td>';
											echo '</tr>';
										}
									else:
										echo '<tr><td colspan="7" class="text-center">No results found!</td></tr>';
									endif;
									?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				<?php endif; ?>
			</div>

			<div class="col-sm-12 col-lg-12">
				<div class="card">
					<div class="card-header">
						Error Logs
						<a href="<?php echo adminRoute('coinpayments/empty_logs');?>" class="btn btn-danger btn-sm pull-right clearfix"><i class="fa fa-trash"></i> Delete All</a>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-striped">
								<thead>
								<tr>
									<th>#</th>
									<th>User</th>
									<th>Message</th>
									<th>Date</th>
								</tr>
								</thead>
								<tbody>
								<?php
								if($error_logs):
									foreach ($error_logs as $item) {
										echo '<tr>';
										echo '<td>'.$item['id'].'</td>';
										echo '<td><a href="'.adminRoute('users/view/'.$item['user_id']).'">'.$item['user_id'].'</a></td>';
										echo '<td>'.$item['message'].'</td>';
										echo '<td>'.$item['created_at'].'</td>';
										echo '</tr>';
									}
								else:
									echo '<tr><td colspan="4" class="text-center">No results found!</td>';
								endif;
								?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
