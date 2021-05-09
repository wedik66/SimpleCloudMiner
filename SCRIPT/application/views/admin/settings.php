<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!-- Breadcrumb-->
<div class="breadcrumb-holder">
	<div class="container-fluid">
		<ul class="breadcrumb">
			<li class="breadcrumb-item"><a href="home.php">Home</a></li>
			<li class="breadcrumb-item active">Settings</li>
		</ul>
	</div>
</div>
<!-- /. ROW  -->
<section>
	<div class="container-fluid">
		<header>
			<?php $this->load->view('admin/includes/alerts'); ?>
			<h1 class="h3 display">Settings</h1>
		</header>
		<div class="row">
			<div class="col-sm-12 col-lg-12">
				<form id="data-form" action="<?php echo adminRoute('settings'); ?>" method="POST">
					<div class="card">
						<div class="card-body">
							<h4>General Settings</h4>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Site Name</label>
										<input type="text" class="form-control" name="sitename"
											   value="<?php echo $item['sitename']; ?>" placeholder="Name of your site"
											   required>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Site Keywords</label>
										<input type="text" class="form-control" name="keywords"
											   value="<?php echo $item['keywords']; ?>"
											   placeholder="Keywords of your site, separated with comma" required>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Site Description</label>
										<input type="text" class="form-control" name="description"
											   value="<?php echo $item['description']; ?>"
											   placeholder="Description of your site" required>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Admin Pagination</label>
										<input type="number" step="1" class="form-control" name="pagination"
											   value="<?php echo $item['pagination']; ?>"
											   placeholder="Items per page on admin" required>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="card">
						<div class="card-body">
							<h4>Layout Settings</h4>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Active Theme</label>
										<select class="form-control" name="theme">
											<option value="">-- SELECT --</option>
											<?php
											$themes = getThemes();
											foreach ($themes as $burl):
												if ($burl == $item['theme']):
													$bSel = 'selected';
												else:
													$bSel = '';
												endif;
												echo '<option value="' . $burl . '" ' . $bSel . '>' . ucfirst($burl) . '</option>';
											endforeach;
											?>
										</select>
									</div>
								</div>
							</div>
							<h5>Project Start Date</h5>
							<div class="row">
								<div class="col-lg-4 col-sm-12">
									<div class="form-group">
										<label>Show Start Date</label>
										<select name="show_start_date" class="form-control" required>
											<option value="">-- Select --</option>
											<option value="yes" <?php echo ($item['show_start_date'] === 'yes') ? 'selected' : ''; ?>>
												Yes
											</option>
											<option value="no" <?php echo ($item['show_start_date'] === 'no') ? 'selected' : ''; ?>>
												No
											</option>
										</select>
									</div>
								</div>
								<div class="col-lg-4 col-sm-12">
									<div class="form-group">
										<label>Start Date</label>
										<input type="date" class="form-control" name="start_date"
											   value="<?php echo $item['start_date']; ?>"
											   placeholder="When the site went live" required>
									</div>
								</div>
								<div class="col-lg-4 col-sm-12">
									<div class="form-group">
										<label>Add Days</label>
										<input type="number" step="1" min="0" class="form-control"
											   name="start_date_increment"
											   value="<?php echo $item['start_date_increment']; ?>"
											   placeholder="Add days to start date" required>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="card">
						<div class="card-body">
							<h4>Social Settings</h4>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Facebook</label>
										<input type="url" class="form-control" name="facebook"
											   value="<?php echo $item['facebook']; ?>"
											   placeholder="Facebook Page or Group URL">
										<small class="help-block">Leave blank to deactivate</small>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Telegram</label>
										<input type="url" class="form-control" name="telegram"
											   value="<?php echo $item['telegram']; ?>"
											   placeholder="Telegram Group or Channel URL">
										<small class="help-block">Leave blank to deactivate</small>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Twitter</label>
										<input type="url" class="form-control" name="twitter"
											   value="<?php echo $item['twitter']; ?>"
											   placeholder="Twitter Profile URL">
										<small class="help-block">Leave blank to deactivate</small>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>VK</label>
										<input type="url" class="form-control" name="vk"
											   value="<?php echo $item['vk']; ?>" placeholder="VK Page or Group URL">
										<small class="help-block">Leave blank to deactivate</small>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="card">
						<div class="card-body">
							<h4>Limit Settings</h4>
							<div class="row">
								<div class="col-md-6">
									<label>Min. Withdrawal</label>
									<div class="input-group">
										<input type="text" class="form-control" name="min_withdraw"
											   value="<?php echo $item['min_withdraw']; ?>"
											   placeholder="Min withdraw value" required>
										<div class="input-group-append"><span
													class="input-group-text"><?php echo $item['currency_code']; ?></span>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<label>Max. Withdrawal</label>
									<div class="input-group">
										<input type="text" class="form-control" name="max_withdraw"
											   value="<?php echo $item['max_withdraw']; ?>"
											   placeholder="Max withdraw value" required>
										<div class="input-group-append"><span
													class="input-group-text"><?php echo $item['currency_code']; ?></span>
										</div>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-md-6">
									<label>Affiliate Commission</label>
									<div class="input-group">
										<input type="text" class="form-control" name="aff_comission"
											   value="<?php echo $item['aff_comission']; ?>"
											   placeholder="Affiliate commission percentage" required>
										<div class="input-group-append"><span class="input-group-text">%</span></div>
									</div>
								</div>
								<div class="col-md-6">
									<label>Max Pending Transactions(per user)</label>
									<div class="input-group">
										<input type="number" step="1" min="1" class="form-control"
											   name="max_pending_transactions"
											   value="<?php echo $item['max_pending_transactions']; ?>"
											   placeholder="Min withdraw value affiliate commissions" required>
										<div class="input-group-append"><span class="input-group-text"><i
														class="fa fa-spinner"></i></span></div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="card">
						<div class="card-body">
							<h4>Currency Settings</h4>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Currency Name</label>
										<input type="text" class="form-control" name="currency_name"
											   value="<?php echo $item['currency_name']; ?>"
											   placeholder="Currency name. Dogecoin, Bitcoin, Litecoin, Ethereum"
											   required>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Currency Code</label>
										<input type="text" class="form-control" name="currency_code"
											   value="<?php echo $item['currency_code']; ?>"
											   placeholder="Currency code. DOGE, BTC, LTC, ETH" required>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Currency Symbol</label>
										<input type="text" class="form-control" name="currency_symbol"
											   value="<?php echo $item['currency_symbol']; ?>"
											   placeholder="Currency symbol. Đ, Ƀ, Ł, Ξ" required>
										<small class="help-block">Examples: Đ, Ƀ, Ł, Ξ</small>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Decimals</label>
										<input type="number" class="form-control" name="currency_decimals"
											   value="<?php echo $item['currency_decimals']; ?>"
											   placeholder="Number of decimals to show" required>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Wallet Address Min Characters</label>
										<input type="number" class="form-control" name="wallet_min"
											   value="<?php echo $item['wallet_min']; ?>"
											   placeholder="Min Characters for Wallet Address Validation" required>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Wallet Address Max Characters</label>
										<input type="number" class="form-control" name="wallet_max"
											   value="<?php echo $item['wallet_max']; ?>"
											   placeholder="Max Characters for Wallet Address Validation" required>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label>Blockchain Tracking URL</label>
										<select class="form-control" name="blockchain">
											<option value="">-- SELECT --</option>
											<option value="0" <?php echo ($item['blockchain'] === '0') ? 'selected' : ''; ?>>
												! DISABLED !
											</option>
											<?php
											foreach ($urlchains as $burl):
												if ($burl['id'] == $item['blockchain']):
													$bSel = 'selected';
												else:
													$bSel = '';
												endif;
												echo '<option value="' . $burl['id'] . '" ' . $bSel . '>' . $burl['name'] . '</option>';
											endforeach;
											?>
										</select>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="card">
						<div class="card-body">
							<h4>CoinPayments Settings</h4>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Site Currency</label>
										<input type="text" class="form-control" name="coin_cur1"
											   value="<?php echo $item['coin_cur1']; ?>"
											   placeholder="Currency used in your site" required>
										<small class="help-block">See more about <b>currency1</b> field <a
													href="https://www.coinpayments.net/apidoc-create-transaction"
													target="_blank">here</a>.</small>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Receive Currency</label>
										<input type="text" class="form-control" name="coin_cur2"
											   value="<?php echo $item['coin_cur2']; ?>"
											   placeholder="Currency used to receive payments" required>
										<small class="help-block">See more about <b>currency2</b> field <a
													href="https://www.coinpayments.net/apidoc-create-transaction"
													target="_blank">here</a>.</small>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Security Hash</label>
										<input type="text" class="form-control" name="coin_hash"
											   value="<?php echo $item['coin_hash']; ?>"
											   placeholder="Create a secure hash to validate transactions" required>
										<small class="help-block">Your security hash to encrypt transactions.</small>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Payment Mode</label>
										<select name="coin_mode" class="form-control" required>
											<option value="api" <?php echo ($item['coin_mode'] === 'api') ? 'selected' : ''; ?>>
												API
											</option>
											<option value="gateway" <?php echo ($item['coin_mode'] === 'gateway') ? 'selected' : ''; ?>>
												Gateway
											</option>
										</select>
										<small class="help-block">API= Generate Payment Address+QRCode. Gateway =
											redirect user to Coinpayments.</small>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="card">
						<div class="card-body">
							<h4>Email Settings</h4>
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label>SMTP Host</label>
										<input type="text" class="form-control" name="smtp_host"
											   value="<?php echo $item['smtp_host']; ?>" placeholder="SMTP Hostname"
											   required>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>SMTP Port</label>
										<input type="text" class="form-control" name="smtp_port"
											   value="<?php echo $item['smtp_port']; ?>" placeholder="SMTP Port Number"
											   required>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>SMTP Secure</label>
										<select name="smtp_secure" class="form-control" required>
											<option value="null" <?php echo ($item['smtp_secure'] === 'null') ? 'selected' : ''; ?>>
												None
											</option>
											<option value="ssl" <?php echo ($item['smtp_secure'] === 'ssl') ? 'selected' : ''; ?>>
												SSL
											</option>
											<option value="tsl" <?php echo ($item['smtp_secure'] === 'tsl') ? 'selected' : ''; ?>>
												TSL
											</option>
										</select>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label>SMTP Username</label>
										<input type="text" class="form-control" name="smtp_user"
											   value="<?php echo $item['smtp_user']; ?>" placeholder="SMTP username"
											   required>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>SMTP Password</label>
										<input type="password" class="form-control" name="smtp_pass"
											   placeholder="Leave blank to dont change">
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>SMTP Sender Email</label>
										<input type="text" class="form-control" name="smtp_sender"
											   value="<?php echo $item['smtp_sender']; ?>"
											   placeholder="SMTP sender email" required>
									</div>
								</div>
								<br>
							</div>
						</div>
					</div>
					<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Save</button>
				</form>
			</div>
		</div>
	</div>
</section>
