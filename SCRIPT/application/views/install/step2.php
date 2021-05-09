<div class="card-header">
	Permissions
</div>
<div class="card-body">
	<p>The following folders need read / write permissions for the correct operation of the script.</p>
	<p>You can change folder permissions through cPanel's "File Manager" by clicking on the folder name and using the "Change Permissions" menu.</p>
	<div class="table-responsive">
		<table class="table table-sm">
			<thead>
			<tr>
				<th scope="col">Folder</th>
				<th scope="col">Required</th>
				<th scope="col">Using</th>
				<th scope="col">Status</th>
			</tr>
			</thead>
			<tbody>
			<?php foreach($folders as $fol => $pem): ?>
				<?php $permission = substr(sprintf('%o', fileperms(FCPATH.$fol)), -3);?>
				<tr>
					<td><?php echo $fol; ?></td>
					<td><?php echo $pem; ?></td>
					<td><?php echo $permission; ?></td>
					<td>
						<?php if($permission >= $pem): ?>
							<span class="badge badge-success badge-pill">Ok</span>
						<?php else: ?>
							<?php $hasErrors = TRUE; ?>
							<span class="badge badge-danger badge-pill"><?php echo $permission; ?></span>
						<?php endif; ?>
					</td>
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>
<div class="card-footer">
	<a href="<?php echo installRoute('install/step1');?>" class="btn btn-danger">Back</a>
	<?php if($hasErrors == TRUE): ?>
	<a href="<?php echo installRoute('install/step2');?>" class="btn btn-warning">Recheck</a>
	<?php else: ?>
	<a href="<?php echo installRoute('install/step3');?>" class="btn btn-info">Continue</a>
	<?php endif;?>
</div>
