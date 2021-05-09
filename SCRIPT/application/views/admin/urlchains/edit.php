<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- Breadcrumb-->
<div class="breadcrumb-holder">
	<div class="container-fluid">
		<ul class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?php echo adminRoute();?>">Home</a></li>
			<li class="breadcrumb-item"><a href="<?php echo adminRoute('urlchains');?>">Blockchain Explorer URL's</a></li>
			<li class="breadcrumb-item active">Edit Tracking URL</li>
		</ul>
	</div>
</div>
<!-- /. ROW  -->
<section>
	<div class="container-fluid">
		<header>
			<?php $this->load->view('admin/includes/alerts'); ?>
			<h1 class="h3 display">Edit Tracking URL</h1>
		</header>

		<div class="row">
			<div class="col-sm-12 col-lg-12">
				<div class="card">
					<div class="card-body">
						<form action="<?php adminRoute('urlchains/edit'); ?>" method="POST">
							<div class="form-group">
								<label>Name</label>
								<input type="text" class="form-control" name="name" placeholder="Site name" value="<?php echo $item['name']; ?>" required>
							</div>
							<div class="form-group">
								<label>URL</label>
								<input type="url" class="form-control" name="url" placeholder="Tracking URL" value="<?php echo $item['url']; ?>" required>
								<small class="help-block">Eg: https://dogechain.info/tx/. In your site will be: https://dogechain.info/tx/YourPaymentTansactionId</small>
							</div>
							<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Update</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
