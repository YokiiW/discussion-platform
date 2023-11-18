            <div class="col-4 offset-4" style="margin-top:15%;">
                <h3 class="text-center">Forgot your password?</h3> 
                <br>
                <small>Enter your email and we'll send you a link to reset your password</small>
				<?php echo form_open(base_url().'reset/forgot_password'); ?>      
                    <div class="form-group">
						<input type="email" class="form-control" required placeholder="Account Email" name="forgot_password_email">
					</div>
					<?php if(isset($notFoundError)): ?>
						<small class="form-text text-danger"><?php echo $notFoundError; ?></small>
					<?php endif; ?>
                    <div class="form-group">
						<button type="submit" <?php if(isset($isButtonDisabled)): ?><?php if ($isButtonDisabled) {echo 'disabled';} ?><?php endif; ?> class="btn btn-primary btn-block">Reset Password</button>
					</div>
					<div class="form-group">
						<button type="button" class="btn btn-outline-primary btn-block" id="back-to-login">Back to Login</button>
					</div>
				<?php echo form_close(); ?>
				<?php if(isset($error)): ?>
					<small class="form-text text-danger"><?php echo $error; ?></small>
				<?php endif; ?>
				<?php if(isset($success)): ?>
					<small class="form-text text-success"><?php echo $success; ?></small>
				<?php endif; ?>
			</div>		
		</div>
	</div>
	<script>
		const backToButton = document.getElementById('back-to-login');
		backToButton.addEventListener('click', function(){
			window.location.href = '<?php echo base_url('login'); ?>'
		});
	</script>
</body>