<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- Breadcrumb-->
<div class="breadcrumb-holder">
	<div class="container-fluid">
		<ul class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?php echo adminRoute(); ?>">Home</a></li>
			<li class="breadcrumb-item"><a href="<?php echo adminRoute('users'); ?>">Users Management</a></li>
			<li class="breadcrumb-item active">User Details</li>
		</ul>
	</div>
</div>
<!-- /. ROW  -->
<section>
	<div class="container-fluid">
		<header>
			<?php $this->load->view('admin/includes/alerts'); ?>
			<h1 class="h3 display">User Details</h1>
		</header>

		<div class="row">
			<div class="col-sm-12 col-lg-12">
				<div class="card">
					<div class="card-header">
						<h3>Basic Details</h3>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-striped">
								<tr>
									<th>Signup Date</th>
									<td><?php echo $item['created_at']; ?></td>
								</tr>
								<tr>
									<th>User Wallet</th>
									<td><?php echo $item['username']; ?></td>
								</tr>
								<tr>
									<th>Upline ID:</th>
									<td><?php if($item['reference_user_id']!=0): ?>
											<a href="<?php echo adminRoute('users/view/'.$item['reference_user_id'])?>"><?php echo $item['reference_user_id']; ?></a>
										<?php else: echo $item['reference_user_id']; ?>
										<?php endif; ?></td>
								</tr>
								<tr>
									<th>Affiliate Balance</th>
									<td><?php echo $item['affiliate_earns']; ?> <?php echo settings('currency_code'); ?></td>
								</tr>
								<tr>
									<th>Affiliate Earnings Paid</th>
									<td><?php echo $item['affiliate_paid']; ?> <?php echo settings('currency_code'); ?></td>
								</tr>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-12 col-lg-12">
				<div class="card">
					<div class="card-header">
						<h3>Active Plans</h3>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-striped">
								<thead>
								<tr>
									<th>#</th>
									<th>Plan Name</th>
									<th>Status</th>
									<th>Active Date</th>
									<th>Expire Date</th>
								</tr>
								</thead>
								<tbody>
								<?php if (!empty($plans)): ?>
									<?php foreach ($plans as $pl): ?>
										<tr>
											<td><?php echo $pl['id']; ?></td>
											<td><?php echo $pl['name']; ?></td>
											<td>
												<?php
												if ($pl['status'] === 'active') {
													echo "<span class='badge badge-success'>" . ucfirst($pl['status']) . "</span>";
												} else {
													echo "<span class='badge badge-danger'>" . ucfirst($pl['status']) . "</span>";
												}
												?>
											</td>
											<td><?php echo $pl['created_at']; ?></td>
											<td><?php echo $pl['expire_date']; ?></td>
										</tr>
									<?php endforeach; ?>
								<?php else: ?>
									<tr>
										<td colspan="5" class="text-center">No results!</td>
									</tr>
								<?php endif; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-12 col-lg-12">
				<div class="card">
					<div class="card-header">
						<h3>Withdrawals</h3>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-striped">
								<thead>
								<tr>
									<th>#</th>
									<th>Type</th>
									<th>Amount</th>
									<th>Status</th>
									<th>Request Date</th>
									<th>Payment Date</th>
								</tr>
								</thead>
								<tbody>
								<?php if (!empty($withdrawals)): ?>
									<?php foreach ($withdrawals as $wt): ?>
										<tr>
											<td><?php echo $wt['id'];?></td>
											<td><?php echo ucfirst($wt['type']);?></td>
											<td><?php echo $wt['amount'];?></td>
											<td>
												<?php
												if($wt['status']==='SUCCESS'){
													echo "<span class='badge badge-success'>".ucfirst($wt['status'])."</span>";
												}else{
													echo "<span class='badge badge-danger'>".ucfirst($wt['status'])."</span>";
												}
												?>
											</td>
											<td><?php echo $wt['created_at'];?></td>
											<td><?php echo $wt['date_paid'];?></td>
										</tr>
									<?php endforeach; ?>
								<?php else: ?>
									<tr>
										<td colspan="6" class="text-center">No results!</td>
									</tr>
								<?php endif; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-12 col-lg-12">
				<div class="card">
					<div class="card-header">
						<h3>Deposits</h3>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-striped">
								<thead>
								<tr>
									<th>#</th>
									<th>Amount</th>
									<th>Status</th>
									<th>Request Date</th>
									<th>Payment Date</th>
								</tr>
								</thead>
								<tbody>
								<?php if(!empty($deposits)): ?>
                                        <?php foreach($deposits as $dep): ?>
                                            <tr>
                                                <td><?php echo $dep['id'];?></td>
                                                <td><?php echo $dep['amount'];?></td>
                                                <td>
                                                    <?php
                                                    if($dep['status']==='SUCCESS'){
                                                        echo "<span class='badge badge-success'>".ucfirst($dep['status'])."</span>";
                                                    }else{
                                                        echo "<span class='badge badge-danger'>".ucfirst($dep['status'])."</span>";
                                                    }
                                                    ?>
                                                </td>
                                                <td><?php echo $dep['created_at'];?></td>
                                                <td><?php echo $dep['date_paid'];?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="5" class="text-center">No results!</td>
                                        </tr>
                                    <?php endif; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-12 col-lg-12">
				<div class="card">
					<div class="card-header">
						<h3>Affiliate History</h3>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-striped">
								<thead>
								<tr>
									<th>#</th>
									<th>Amount</th>
									<th>Status</th>
									<th>Payment Date</th>
								</tr>
								</thead>
								<tbody>
								<?php if(!empty($comissions)): ?>
									<?php foreach($comissions as $aff): ?>
										<tr>
											<td><?php echo $aff['id'];?></td>
											<td><?php echo $aff['amount'];?></td>
											<td>
												<?php
												if($aff['status']==='paid'){
													echo "<span class='badge badge-success'>".ucfirst($aff['status'])."</span>";
												}else{
													echo "<span class='badge badge-danger'>".ucfirst($aff['status'])."</span>";
												}
												?>
											</td>
											<td><?php echo $aff['date'];?></td>
										</tr>
									<?php endforeach; ?>
								<?php else: ?>
									<tr>
										<td colspan="4" class="text-center">No results!</td>
									</tr>
								<?php endif; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
