<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- Breadcrumb-->
<div class="breadcrumb-holder">
	<div class="container-fluid">
		<ul class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?php echo adminRoute();?>">Home</a></li>
			<li class="breadcrumb-item active">Demo Addon</li>
		</ul>
	</div>
</div>
<!-- /. ROW  -->
<section>
	<div class="container-fluid">
		<header>
			<?php $this->load->view('admin/includes/alerts'); ?>
			<h1 class="h3 display">Demo Addon</h1>
		</header>

		<div class="row">
			<div class="col-sm-12 col-lg-12">
				<div class="card">
					<div class="card-header">
						Demo Addon
					</div>
					<div class="card-body">
						Addon installed!
					</div>
					<div class="card-footer">
						<a href="<?php echo adminRoute('demo_addon/uninstall');?>" class="btn btn-danger"><i class="fa fa-cog"></i> Uninstall</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
