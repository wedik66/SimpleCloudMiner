<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- Breadcrumb-->
<div class="breadcrumb-holder">
	<div class="container-fluid">
		<ul class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?php echo adminRoute();?>">Home</a></li>
			<li class="breadcrumb-item active">Admins Management</li>
		</ul>
	</div>
</div>
<!-- /. ROW  -->
<section>
	<div class="container-fluid">
		<header>
			<?php $this->load->view('admin/includes/alerts'); ?>
			<h1 class="h3 display">Admins Management</h1>
		</header>

		<div class="row">
			<div class="col-sm-12 col-lg-12">
				<div class="card">
					<div class="card-header">
						<a class="btn btn-success btn-sm" href="<?php echo adminRoute('admins/create');?>"><i class="fa fa-plus"></i> Add</a>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-striped table-bordered table-hover">
								<thead>
								<tr>
									<th>#</th>
									<th>Username</th>
									<th>Actions</th>
								</tr>
								</thead>
								<tbody>
								<?php if ($items): ?>
									<?php foreach ($items as $item): ?>
										<tr>
											<td><?php echo $item['id']; ?></td>
											<td><?php echo $item['username']; ?></td>
											<td>
												<a class="btn btn-info btn-xs" href="<?php echo adminRoute('admins/edit/'.$item['id']);?>"><i class="fa fa-edit"></i> Edit</a>
												<a class="btn btn-danger btn-xs" href="<?php echo adminRoute('admins/remove/'.$item['id']);?>"><i class="fa fa-unlock"></i> Remove Admin Rights</a>
											</td>
										</tr>
									<?php endforeach; ?>
								<?php else: ?>
									<tr>
										<td colspan="3" class="text-center">No results</td>
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
