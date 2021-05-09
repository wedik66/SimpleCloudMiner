<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- Breadcrumb-->
<div class="breadcrumb-holder">
	<div class="container-fluid">
		<ul class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?php echo adminRoute();?>">Home</a></li>
			<li class="breadcrumb-item"><a href="<?php echo adminRoute('contact');?>">Support Messages</a></li>
			<li class="breadcrumb-item active">Edit Message</li>
		</ul>
	</div>
</div>
<!-- /. ROW  -->
<section>
	<div class="container-fluid">
		<header>
			<?php $this->load->view('admin/includes/alerts'); ?>
			<h1 class="h3 display">Edit Message</h1>
		</header>

		<div class="row">
			<div class="col-sm-12 col-lg-12">
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-striped">
								<tr>
									<th>Name</th>
									<td><?php echo $item['name']; ?></td>
								</tr>
								<tr>
									<th>Email</th>
									<td><?php echo $item['email']; ?></td>
								</tr>
								<tr>
									<th>Subject</th>
									<td><?php echo $item['subject']; ?></td>
								</tr>
								<tr>
									<th>Message</th>
									<td><blockquote><?php echo htmlentities($item['message']);?></blockquote></td>
								</tr>
							</table>
						</div>
						<form action="<?php adminRoute('contact/edit'); ?>" method="POST">
							<div class="form-group">
								<label>Status</label>
								<select class="form-control" name="status" required>
									<option value="">-- SELECT A OPTION --</option>
									<option value="unread" <?php if($item['status']==='unread') {echo 'selected';} ?> >Unread</option>
									<option value="read" <?php if($item['status']==='read') {echo 'selected';} ?> >Readed</option>
									<option value="replied" <?php if($item['status']==='replied') {echo 'selected';} ?> >Replied</option>
								</select>
							</div>
							<?php if($item['status']!=='replied'): ?>
							<div class="form-group">
								<label>Reply Message</label>
								<textarea name="reply" rows="10" class="form-control"><?php echo set_value('reply'); ?></textarea>
							</div>
							<?php endif; ?>
							<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Update</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
