<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- Breadcrumb-->
<div class="breadcrumb-holder">
	<div class="container-fluid">
		<ul class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?php echo adminRoute();?>">Home</a></li>
			<li class="breadcrumb-item active">Transactions History</li>
		</ul>
	</div>
</div>
<!-- /. ROW  -->
<section>
	<div class="container-fluid">
		<header>
			<?php $this->load->view('admin/includes/alerts'); ?>
			<h1 class="h3 display">Transactions History</h1>
		</header>

		<div class="row">
			<div class="col-sm-12 col-lg-12">
				<div class="card">
					<div class="card-header">
						Transactions List
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-striped table-bordered table-hover table-sm">
								<thead>
								<tr>
									<th>#</th>
									<th>User ID</th>
									<th>Plan ID</th>
									<th>Amount</th>
									<th>Hash</th>
									<th>Status</th>
									<th>TXID</th>
									<th>Date</th>
								</tr>
								</thead>
								<tbody>
								<?php if ($items): ?>
									<?php foreach ($items as $item): ?>
										<tr>
											<td><?php echo $item['id']; ?></td>
											<td><a href="<?php echo adminRoute('users/view/'.$item['user_id']); ?>"><?php echo $item['user_id']; ?></a></td>
											<td><a href="<?php echo adminRoute('plans/edit/'.$item['plan_id']); ?>"><?php echo $item['plan_id']; ?></a></td>
											<td><?php echo settings('currency_symbol'); ?> <?php echo $item['amount']; ?></td>
											<td><?php echo $item['hash']; ?></td>
											<td>
												<?php if($item['status']==='pending'):?>
													<span class="badge badge-danger">Pending</span>
												<?php elseif($item['status']==='waiting'):?>
													<span class="badge badge-info">Waiting</span>
												<?php elseif($item['status']==='paid'):?>
													<span class="badge badge-success">Paid</span>
												<?php endif;?>
											</td>
											<td><?php echo $item['txid']; ?></td>
											<td><?php echo $item['date']; ?></td>
										</tr>
									<?php endforeach; ?>
								<?php else: ?>
									<tr>
										<td colspan="8" class="text-center">No results</td>
									</tr>
								<?php endif; ?>
								</tbody>
							</table>
						</div>
						<?php echo $pagination_links; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
