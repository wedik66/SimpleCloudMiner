<div class="card-header">
	Script Requeriments
</div>
<div class="card-body">
	<p>Make sure your hosting plan has the minimum requirements necessary for the script to work. All items must have "Ok" status, if any of them have the "Error" message you need to correct before proceeding with the installation.</p>
	<p>If you use cPanel, you can access the "<b>Select PHP Version</b>" menu to change the PHP version or enable the required extensions. If any of the extensions can not be enabled, please contact your hosting technical support for assistance.</p>
	<ul class="list-group">
		<li class="list-group-item d-flex justify-content-between align-items-center"><b>PHP Version:</b> <?php echo $php['version']; ?>
			<span class="badge <?php if($supported): ?>badge-success <?php else: ?> badge-danger <?php endif; ?> badge-pill"><?php echo PHP_VERSION; ?></span></li>
		<?php if(!$supported): ?> <?php $hasErrors = TRUE; ?> <?php endif;?>
		<li class="list-group-item d-flex justify-content-between align-items-center"><b>PHP Extensions:</b></li>
		<li class="list-group-item">
			<ul class="list-group">
				<?php foreach($php['extensions'] as $ext): ?>
				<li class="list-group-item d-flex justify-content-between align-items-center">
					<?php echo $ext; ?>
					<?php if(extension_loaded($ext)): ?>
					<span class="badge badge-success badge-pill">Ok</span>
					<?php else: ?>
					<?php $hasErrors = TRUE; ?>
					<span class="badge badge-danger badge-pill">Error</span>
					<?php endif; ?>
				</li>
				<?php endforeach; ?>
			</ul>
		</li>
		<li class="list-group-item d-flex justify-content-between align-items-center"><b>Apache Extensions:</b></li>
		<li class="list-group-item">
			<?php if(!function_exists('apache_get_modules')): ?>
			<p class="text-danger">Your host configuration does not allow verification of Apache extensions, you can continue with script installation, but it is recommended that you verify that your host has the following requirements to ensure proper script operation.</p>
			<?php endif;?>
			<ul class="list-group">
				<?php foreach($apache['extensions'] as $aext): ?>
				<li class="list-group-item d-flex justify-content-between align-items-center">
					<?php echo $aext; ?>
					<?php if(!function_exists('apache_get_modules')): ?>
					<span class="badge badge-warning badge-pill">Unkdown</span>
					<?php elseif(in_array($aext,apache_get_modules())): ?>
					<span class="badge badge-success badge-pill">Ok</span>
					<?php else: ?>
					<?php $hasErrors = TRUE; ?>
					<span class="badge badge-danger badge-pill">Error</span>
				<?php endif; ?>
				</li>
				<?php endforeach; ?>
			</ul>
		</li>
	</ul>
</div>
<div class="card-footer">
	<a href="<?php echo installRoute('install');?>" class="btn btn-danger">Back</a>
	<?php if($hasErrors == TRUE): ?>
	<a href="<?php echo installRoute('install/step1');?>" class="btn btn-warning">Recheck</a>
	<?php else: ?>
	<a href="<?php echo installRoute('install/step2');?>" class="btn btn-info">Continue</a>
	<?php endif;?>
</div>
