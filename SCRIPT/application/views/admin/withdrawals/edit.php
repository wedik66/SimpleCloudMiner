<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- Breadcrumb-->
<div class="breadcrumb-holder">
	<div class="container-fluid">
		<ul class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?php echo adminRoute();?>">Home</a></li>
			<li class="breadcrumb-item"><a href="<?php echo adminRoute('withdrawals');?>">Withdrawal Requests</a></li>
			<li class="breadcrumb-item active">Edit Withdraw Request</li>
		</ul>
	</div>
</div>
<!-- /. ROW  -->
<section>
	<div class="container-fluid">
		<header>
			<?php $this->load->view('admin/includes/alerts'); ?>
			<h1 class="h3 display">Edit Withdraw Request</h1>
		</header>

		<div class="row">
			<div class="col-sm-12 col-lg-12">
				<div class="card">
					<div class="card-body">
						<form action="<?php adminRoute('withdrawals/edit'); ?>" method="POST">
							<div class="form-group">
								<label>User Wallet</label>
								<input class="form-control" value="<?php echo $item['username'];?>" readonly>
							</div>
							<div class="row">
								<div class="col-lg-6 col-sm-12">
									<div class="form-group">
										<label>Amount</label>
										<input class="form-control" value="<?php echo $item['amount'];?>" readonly>
									</div>
								</div>
								<div class="col-lg-6 col-sm-12">
									<div class="form-group">
										<label>Type</label>
										<input class="form-control" value="<?php echo ucfirst($item['type']);?>" readonly>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-6 col-sm-12">
									<div class="form-group">
										<label>Transaction ID</label>
										<input class="form-control" name="tx" value="<?php echo $item['tx'];?>" placeholder="Transaction ID" required>
									</div>
								</div>
								<div class="col-lg-6 col-sm-12">
									<div class="form-group">
										<label>Status</label>
										<select class="form-control" name="status" required>
											<option value="">-- SELECT A OPTION --</option>
											<option value="SUCCESS" <?php if($item['status']==='SUCCESS') {echo 'selected';} ?> >Paid</option>
											<option value="PENDING" <?php if($item['status']==='PENDING') {echo 'selected';} ?> >Pending</option>
											<option value="PROCESSING" <?php if($item['status']==='PROCESSING') {echo 'selected';} ?> >Processing</option>
										</select>
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
