<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- Breadcrumb-->
<div class="breadcrumb-holder">
	<div class="container-fluid">
		<ul class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?php echo adminRoute(); ?>">Home</a></li>
			<li class="breadcrumb-item"><a href="<?php echo adminRoute('admins'); ?>">Admins Management</a></li>
			<li class="breadcrumb-item active">Create Admin</li>
		</ul>
	</div>
</div>
<!-- /. ROW  -->
<section>
	<div class="container-fluid">
		<header>
			<?php $this->load->view('admin/includes/alerts'); ?>
			<h1 class="h3 display">Create Admin</h1>
		</header>

		<div class="row">
			<div class="col-sm-12 col-lg-12">
				<div class="card">
					<div class="card-header">
						<h3>Edit Details</h3>
					</div>
					<div class="card-body">
						<form action="<?php adminRoute('admins/create'); ?>" method="POST">
							<div class="row">
								<div class="col-lg-6 col-sm-12">
									<div class="form-group">
										<label>Username <span class="text-danger">*</span></label>
										<input type="text" class="form-control" name="username" placeholder="Username"
											   required>
									</div>
								</div>
								<div class="col-lg-6 col-sm-12">
									<div class="form-group">
										<label>Email <span class="text-danger">*</span></label>
										<input type="email" class="form-control" name="email" placeholder="Email"
											   required>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-6 col-sm-12">
									<div class="form-group">
										<label>Password <span class="text-danger">*</span></label>
										<input type="password" class="form-control" name="password"
											   placeholder="Password" required>
									</div>
								</div>
								<div class="col-lg-6 col-sm-12">
									<div class="form-group">
										<label>Confirm Password <span class="text-danger">*</span></label>
										<input type="password" class="form-control" name="password_confirmation"
											   placeholder="Confirm Password" required>
									</div>
								</div>
							</div>
							<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Update</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
