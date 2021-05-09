<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- Breadcrumb-->
<div class="breadcrumb-holder">
	<div class="container-fluid">
		<ul class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?php echo adminRoute();?>">Home</a></li>
			<li class="breadcrumb-item active">Coinpayments Auto Withdrawals Addon</li>
		</ul>
	</div>
</div>
<!-- /. ROW  -->
<section>
	<div class="container-fluid">
		<header>
			<?php $this->load->view('admin/includes/alerts'); ?>
			<h1 class="h3 display">Coinpayments Auto Withdrawals Addon</h1>
		</header>

		<div class="row">
			<div class="col-sm-12 col-lg-12">
				<div class="card">
					<div class="card-header">
						Coinpayments Auto Withdrawals Addon
						<small class="text-muted pull-right clearfix">v<?php echo $this->addon_version; ?></small>
					</div>
					<div class="card-body">
						Addon not installed!
					</div>
					<div class="card-footer">
						<a href="<?php echo adminRoute('coinpayments/install');?>" class="btn btn-success"><i class="fa fa-cog"></i> Install</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
