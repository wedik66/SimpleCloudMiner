<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- Breadcrumb-->
<div class="breadcrumb-holder">
	<div class="container-fluid">
		<ul class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?php echo adminRoute();?>">Home</a></li>
			<li class="breadcrumb-item active">Addons List</li>
		</ul>
	</div>
</div>
<!-- /. ROW  -->
<section>
	<div class="container-fluid">
		<header>
			<?php $this->load->view('admin/includes/alerts'); ?>
			<h1 class="h3 display">Addons List</h1>
			<small class="text-danger"><b>Warning</b>: Disable addons will erase all addon data from Database.</small>
		</header>

		<div class="row">
			<div class="col-sm-12 col-lg-12">
				<div class="card">
					<div class="card-header">
						Installed Addons
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-striped table-bordered table-hover">
								<thead>
								<tr>
									<th>Name</th>
									<th>Version</th>
									<th>Status</th>
									<th>Actions</th>
								</tr>
								</thead>
								<tbody>
								<?php if ($items): ?>
									<?php foreach ($items as $item): ?>
										<tr>
											<td><?php echo $item['name']; ?></td>
											<td><?php echo $item->version; ?></td>
											<td>
												<?php
												if(in_array($item['slug'],array_column($modules,'name'))){
													echo '<span class="badge badge-success">Active</span>';
												}else{
													echo '<span class="badge badge-danger">Inactive</span>';
												}
												?>
											</td>
											<td>
												<?php
												if($item->status){
													echo '<a class="btn btn-xs btn-danger" href="'.adminRoute('addons/disable/'.$item['slug']).'"><i class="fa fa-eye-slash"></i> Disable</a>';
												}else{
													echo '<a class="btn btn-xs btn-success" href="'.adminRoute('addons/enable/'.$item['slug']).'"><i class="fa fa-eye"></i> Enable</a>';
												}
												?>
											</td>
										</tr>
									<?php endforeach; ?>
								<?php else: ?>
									<tr>
										<td colspan="4" class="text-center">No results</td>
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

		<div class="row">
			<div class="col-sm-12 col-lg-12">
				<div class="card">
					<div class="card-header">
						Available Addons
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-striped table-bordered table-hover">
								<thead>
								<tr>
									<th>Name</th>
									<th>Actions</th>
								</tr>
								</thead>
								<tbody>
								<?php if ($modules): ?>
									<?php foreach ($modules as $item): ?>
										<tr>
											<td><?php echo $item; ?></td>
											<td>
												<?php
													echo '<a class="btn btn-xs btn-success" href="'.adminRoute('addons/install/'.$item).'"><i class="fa fa-power-off"></i> Install</a>';
												?>
											</td>
										</tr>
									<?php endforeach; ?>
								<?php else: ?>
									<tr>
										<td colspan="2" class="text-center">No results</td>
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
