<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- Breadcrumb-->
<div class="breadcrumb-holder">
	<div class="container-fluid">
		<ul class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?php echo adminRoute();?>">Home</a></li>
			<li class="breadcrumb-item active">IPN Logs</li>
		</ul>
	</div>
</div>
<!-- /. ROW  -->
<section>
	<div class="container-fluid">
		<header>
			<?php $this->load->view('admin/includes/alerts'); ?>
			<h1 class="h3 display">IPN Log Errors</h1>
		</header>

		<div class="row">
			<div class="col-sm-12 col-lg-12">
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-striped table-bordered table-hover">
								<thead>
								<tr>
									<th>#</th>
									<th>Message</th>
									<th>Status</th>
									<th>Date</th>
									<th>Action</th>
								</tr>
								</thead>
								<tbody>
								<?php if ($items): ?>
									<?php foreach ($items as $item): ?>
										<tr>
										<td><?php echo $item['id']; ?></td>
										<td><?php echo $item['message']; ?></td>
										<td>
											<?php
											if($item['status']==='0'){
												echo '<span class="badge badge-danger">Unpaid</span>';
											}
											elseif($item['status']==='2' OR $item['status']==='100'){
												echo '<span class="badge badge-success">Paid</span>';
											}else{
												echo '<span class="badge badge-warning">'.$item['status'].'</span>';
											}
											?>
										</td>
										<td><?php echo $item['created_at']; ?></td>
										<td><a class="btn btn-xs btn-info" href="<?php echo adminRoute('ipnlogs/view/'.$item['id']); ?>"><i class="fa fa-eye"></i> View</a></td>
										</tr>
									<?php endforeach; ?>
								<?php else: ?>
									<tr>
										<td colspan="5" class="text-center">No results</td>
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
