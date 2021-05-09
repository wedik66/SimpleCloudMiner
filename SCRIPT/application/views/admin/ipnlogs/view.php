<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- Breadcrumb-->
<div class="breadcrumb-holder">
	<div class="container-fluid">
		<ul class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?php echo adminRoute();?>">Home</a></li>
			<li class="breadcrumb-item"><a href="<?php echo adminRoute('ipnlogs');?>">IPN Logs</a></li>
			<li class="breadcrumb-item active">IPN Log Details</li>
		</ul>
	</div>
</div>
<!-- /. ROW  -->
<section>
	<div class="container-fluid">
		<header>
			<?php $this->load->view('admin/includes/alerts'); ?>
			<h1 class="h3 display">IPN Log Details</h1>
		</header>

		<div class="row">
			<div class="col-sm-12 col-lg-12">
				<div class="card">
					<div class="card-body">
						<h3>Basic Details</h3><br>
						<div class="table-responsive">
							<table class="table table-striped">
								<tr>
									<th>Date</th>
									<td><?php echo $item['created_at'];?></td>
								</tr>
								<tr>
									<th>Status</th>
									<td><?php echo $item['status'];?></td>
								</tr>
								<tr>
									<th>Error Message</th>
									<td><?php echo $item['message'];?></td>
								</tr>
								<tr>
									<th colspan="2">Log Details</th>
								</tr>
								<tr>
									<td colspan="2"><textarea class="form-control" rows="15"><?php echo json_decode($item['content']);?></textarea></td>
								</tr>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
