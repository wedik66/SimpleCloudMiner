<div class="footer">
	<div class="container">
		© <?php echo settings('sitename'); ?> <?php echo date('Y');?>. Made with love by <a href="https://www.youtube.com/c/newtoki" target="_blank">NewToki.</a>
	</div>
</div>
<!-- Forgot Password Modal -->
<div class="modal fade" id="fogotPassword" tabindex="-1" role="dialog" aria-labelledby="fogotPassword">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="fogotPassword">Forgot Password</h4>
			</div>
			<div class="modal-body">
				<div id="forgotPassResult"></div>
				<form id="forgotPass">
					<div class="form-group">
						<label for="email">Username</label>
						<input type="text" name="identity" id="identity" class="form-control" placeholder="Your username" required>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				<button type="button" class="btn btn-primary" id="fpSend" onclick="return forgotPassword();">Recover Password</button>
			</div>
		</div>
	</div>
</div>
<script src="<?php echo themeAssets('js/jquery.min.js'); ?>"></script>
<script src="<?php echo themeAssets('js/bootstrap.min.js'); ?>"></script>
<script src="<?php echo themeAssets('js/global.js'); ?>"></script>
<script type="text/javascript">
	<?php if(current_url()===base_url()): ?>
	function validateFormLogin()
	{
		event.preventDefault();
		let button = $('#go_enter');
		let min_length = <?php echo settings('wallet_min');?>;
		let max_length = <?php echo settings('wallet_max');?>;
		let error_message = "";
		let username_val = $("#username").val();
		let username = username_val.length;
		let password_val = $("#password").val();
		let reference_user_id = $("#reference_user_id").val();
		let password = password_val.length;

		button.prop('disabled',true);
		$("#result").html('Working...');

		if(username > 0 && password > 0)
		{
			if(username < min_length )
			{
				error_message = "Wallet address is invalid! Enter correct wallet address or <b><a href='https://coinpayments.net' target='_blank'>Create New Wallet Address</a></b>.";
				$("#result").html(error_message);
				button.prop('disabled',false);
				return false;
			}
			if(username > max_length )
			{
				error_message = "Wallet address is invalid! Enter correct wallet address or <b><a href='https://gocps.net/sfg518zyuamg70yp7mb9uqaeuaot/' target='_blank'>Create New Wallet Address</a></b>.";
				$("#result").html(error_message);
				button.prop('disabled',false);
				return false;
			}
			if(password < 4)
			{
				error_message = "Password must have at last 4 characters!";
				$("#result").html(error_message);
				button.prop('disabled',false);
				return false;
			}
			//Send
			$.ajax({
				type: "POST",
				url: '<?php echo base_url('ajax_auth'); ?>',
				data: {username: username_val, password: password_val, reference_user_id:reference_user_id },
				success : function(authresult){
					if (authresult === 'success'){
						success_message = "Redirecting to your account...";
						$("#result").html(success_message);
						return window.location.href = '/';
						//return true;
					}
					else{
						$("#result").html(authresult);
						button.prop('disabled',false);
						return false;
					}
				},
				error: function ()	{ alert('Oops'); }
			});
		}
		else
		{
			error_message = "All fields are required!";
			$("#result").text(error_message);
			return false;
		}
	}
	//Forgot password
	function forgotPassword() {
		let identity_val = $('#forgotPass input[id="identity"]').val();
		let resultMessage = $('#forgotPassResult');
		let btnSend = $('#fpSend');

		btnSend.prop('disabled','disabled');
		if(identity_val.length > 4){
			//Send
			$.ajax({
				type: "POST",
				url: '<?php echo base_url('ajax_auth/recoverpassword'); ?>',
				data: {username: identity_val},
				success : function(forgotresult){
					console.log(forgotresult);
					if (forgotresult === 'success'){
						resultMessage.html('<div class="alert alert-success">Email sent successfully!</div>');
					}
					else{
						resultMessage.html('<div class="alert alert-danger">'+forgotresult+'</div>');
						btnSend.prop('disabled',false);
					}
				},
				error: function ()	{ alert('Oops');
					btnSend.prop('disabled',false);}
			});
		}else{
			resultMessage.html('<div class="alert alert-danger">Username Required!</div>');
			btnSend.prop('disabled',false);
		}
	}
	<?php endif; ?>
	<?php if(current_url()===base_url('dashboard')): ?>
	//Counter
	$(document).ready(function() {
		let speed = (parseFloat(<?php echo $userEarningRate;?>)/60).toFixed(8);
		setInterval(function() {
			let oldvalue =  parseFloat($('#bal').html()).toFixed(8);
			let result = parseFloat(parseFloat(oldvalue) + parseFloat(speed)).toFixed(8);
			$("#bal").html(result);
		}, 1000);
	});
	//Wallet show
	function go_show_address() {
		$('#show_address').html('<?php echo $_SESSION['username'];?>');
	}
	<?php endif; ?>
</script>
</body>
</html>
