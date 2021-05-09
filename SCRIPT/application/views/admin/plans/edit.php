<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- Breadcrumb-->
<div class="breadcrumb-holder">
	<div class="container-fluid">
		<ul class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?php echo adminRoute();?>">Home</a></li>
			<li class="breadcrumb-item"><a href="<?php echo adminRoute('plans');?>">Plans Management</a></li>
			<li class="breadcrumb-item active">Edit Plan</li>
		</ul>
	</div>
</div>
<!-- /. ROW  -->
<section>
	<div class="container-fluid">
		<header>
			<?php $this->load->view('admin/includes/alerts'); ?>
			<h1 class="h3 display">Edit Plan</h1>
			<small>Use Plan Calculator.xlsx included on script files to calculate prices and details for your plans</small>
		</header>

		<div class="row">
			<div class="col-sm-12 col-lg-12">
				<div class="card">
					<div class="card-body">
						<form action="<?php adminRoute('plans/edit'); ?>" method="POST">
							<div class="row">
								<div class="col-lg-6 col-sm-12">
									<div class="form-group">
										<label>Plan Name</label>
										<input type="text" class="form-control" name="plan_name" placeholder="Plan name" value="<?php echo $item['plan_name']; ?>" required>
									</div>
								</div>
								<div class="col-lg-6 col-sm-12">
									<div class="form-control-label">
										<label>Is default(Free)</label>
									</div>
									<div class="custom-control-inline">
										<div class="i-checks">
											<input id="is_default1" type="radio" value="1" name="is_default" class="form-control-custom radio-custom" <?php echo $item['is_default']==1?'checked':''; ?>>
											<label for="is_default1">Yes</label>
										</div>
										<div class="i-checks">
											<input id="is_default0" type="radio" value="0" name="is_default" class="form-control-custom radio-custom"  <?php echo $item['is_default']==0?'checked':''; ?>>
											<label for="is_default0">No</label>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-4 col-sm-12">
									<div class="form-group">
										<label>Plan Price</label>
										<input type="text" id="plan_price" class="form-control" name="price" placeholder="Plan Price" value="<?php echo $item['price']; ?>" required>
									</div>
								</div>
								<div class="col-lg-4 col-sm-12">
									<div class="form-group">
										<label>Plan Duration (days)</label>
										<input type="number" min="0" id="duration" class="form-control" name="duration" placeholder="Plan duration (days)" value="<?php echo $item['duration']; ?>" required>
									</div>
								</div>
								<div class="col-lg-4 col-sm-12">
									<div class="form-group">
										<label>Earning Rate (min)</label>
										<input type="text" id="earning_rate" class="form-control" name="earning_rate" placeholder="Coins per minute" value="<?php echo $item['earning_rate']; ?>" required>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-4 col-sm-12">
									<div class="form-group">
										<label>Version</label>
										<input type="text" id="version" class="form-control" name="version" placeholder="Version name" value="<?php echo $item['version']; ?>" required>
									</div>
								</div>
								<div class="col-lg-4 col-sm-12">
									<div class="form-group">
										<label>Coin per day</label>
										<input type="text" id="point_per_day" class="form-control" name="point_per_day" placeholder="Coins per day" value="<?php echo $item['point_per_day']; ?>" required>
									</div>
								</div>
								<div class="col-lg-4 col-sm-12">
									<div class="form-group">
										<label>Plan Profit (%)</label>
										<input type="number" step="any" id="profit" class="form-control" name="profit" placeholder="Examples: 2 | 5.25" value="<?php echo $item['profit']; ?>" required>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-4 col-sm-12">
									<div class="form-group">
										<label>Mining Speed</label>
										<input type="number" step="any" id="speed" class="form-control" name="speed" placeholder="Mining Speed" value="<?php echo $item['speed']; ?>" required>
									</div>
								</div>
								<div class="col-lg-8 col-sm-12">
									<div class="form-group">
										<label>Image File Name</label>
										<select class="form-control" name="image">
											<option value="">-- SELECT A OPTION --</option>
											<?php
											$imgsArray = getPlansImages();
											foreach($imgsArray as $pimg){
												if($pimg===$item['image']){
													$selec = 'selected';
												}else{
													$selec = '';
												}
												echo '<option value="'.$pimg.'" '.$selec.'>'.$pimg.'</option>';
											}
											?>
										</select>
										<span class="help-block">You need upload the image in your hosting account or via FTP on <b>assets/plans</b> folder</span>
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
