<?php if(settings('facebook')): ?>
	<a class="btn btn-default" href="<?php echo settings('facebook'); ?>" target="_blank"><i class="fa fa-facebook"></i> Facebook</a>
<?php endif; ?>
<?php if(settings('twitter')): ?>
	<a class="btn btn-default" href="<?php echo settings('twitter'); ?>" target="_blank"><i class="fa fa-twitter"></i> Twitter</a>
<?php endif; ?>
<?php if(settings('telegram')): ?>
	<a class="btn btn-default" href="<?php echo settings('telegram'); ?>" target="_blank"><i class="fa fa-telegram"></i> Telegram</a>
<?php endif; ?>
<?php if(settings('vk')): ?>
	<a class="btn btn-default" href="<?php echo settings('vk'); ?>" target="_blank"><i class="fa fa-vk"></i> VK</a>
<?php endif; ?>
