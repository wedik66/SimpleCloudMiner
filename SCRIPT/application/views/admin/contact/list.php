<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- Breadcrumb-->
<div class="breadcrumb-holder">
	<div class="container-fluid">
		<ul class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?php echo adminRoute(); ?>">Home</a></li>
			<li class="breadcrumb-item active">Support Messages</li>
		</ul>
	</div>
</div>
<!-- /. ROW  -->
<section>
	<div class="container-fluid">
		<header>
			<?php $this->load->view('admin/includes/alerts'); ?>
			<h1 class="h3 display">Support Messages</h1>
		</header>

		<div class="row">
			<div class="col-sm-12 col-lg-12">
				<div class="card">
					<div class="card-header">Messages List</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-striped table-bordered table-hover">
								<thead>
								<tr>
									<th>#</th>
									<th>Name</th>
									<th>Subject</th>
									<th>Status</th>
									<th>Date</th>
									<th>Actions</th>
								</tr>
								</thead>
								<tbody>
								<?php if ($items): ?>
									<?php foreach ($items as $item): ?>
										<tr>
											<td><?php echo $item['id']; ?></td>
											<td><?php echo $item['name']; ?></td>
											<td><?php echo $item['subject']; ?></td>
											<td>
												<?php
												$status = $item['status'];
												if ($status === 'unread') {
													echo '<span class="badge badge-danger">Unread</span>';
												} elseif ($status === 'read') {
													echo '<span class="badge badge-warning">Readed</span>';
												} else {
													echo '<span class="badge badge-success">Replied</span>';
												}
												?>
											</td>
											<td><?php echo $item['created_at']; ?></td>
											<td><a class="btn btn-xs btn-info"
												   href="<?php echo adminRoute('contact/edit/' . $item['id']); ?>"><i
														class="fa fa-eye"></i> View</a></td>
										</tr>
									<?php endforeach; ?>
								<?php else: ?>
									<tr>
										<td colspan="6" class="text-center">No results</td>
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
