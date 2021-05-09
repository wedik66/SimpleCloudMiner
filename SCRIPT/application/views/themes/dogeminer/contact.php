<div class="container">
		<div class="input-mine">
			<h1>Contact Us</h1>
			<p>Have problem that cannot resolve by yourself or have a question you do not have an answer to? Send us a message!</p>
			<div class="text-center" style="margin-bottom: 10px">
				<?php include_once __DIR__ . '/includes/social.php'; ?>
			</div>
		</div>
</div>
</div><!-- end top-bg -->

<div class="wrapper white-box">
	<div class="container">
		<div class="faq-box">
			<div class="faq-item text-center">
				<h2>Contact Us</h2>
				<div class="row">
					<div class="col-md-6 col-md-offset-3 col-sm-12 col-sm-offset-0">
						<?php include_once __DIR__ . '/includes/alerts.php'; ?>
						<form action="<?php echo base_url('contact');?>" method="post" id="contactForm">
							<div class="form-group">
								<label>Name</label>
								<input type="text" id="name" name="name" class="form-control" placeholder="Your Name" required />
							</div>
							<div class="form-group">
								<label>Email</label>
								<input type="email" id="email" name="email" class="form-control" placeholder="Your Email" required />
							</div>
							<div class="form-group">
								<label>Subject</label>
								<input type="text" id="subject" name="subject" class="form-control" placeholder="Subject" required />
							</div>
							<div class="form-group">
								<label>Message</label>
								<textarea id="message" name="message" class="form-control" placeholder="Your Message here" required></textarea>
							</div>
							<button type="submit" class="btn btn-warning"><i class="fa fa-send"></i> Send</button>
						</form>
					</div>
				</div>
				<br>
			</div>
		</div>
	</div>
</div>
