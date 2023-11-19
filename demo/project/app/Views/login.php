			<div class="col-4 offset-4" style="margin-top:15%;">
				<?php echo form_open(base_url().'login/check_login'); ?>
					<h2 class="text-center">Login</h2>       
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Username" required="required" name="username">
					</div>
					<div class="form-group">
						<input type="password" class="form-control" placeholder="Password" required="required" name="password">
					</div>
					<div class="form-group">
					<?= $error; ?>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary btn-block">Log in</button>
					</div>
					<div class="clearfix">
						<label class="float-left form-check-label"><input type="checkbox" name="remember"> Remember me</label>
						<a href="#" class="float-right" id="forgot-password">Forgot Password?</a>
					</div>
					<div class="clearfix">
						<p class="float-left">Don't have an account?&nbsp;</p>
						<a href="#" id="sign-up">Sign up</a>
					</div>    
				<?php echo form_close(); ?>
			</div>		
		</div>
	</div>
	<script>
		const signUpButton = document.getElementById('sign-up');
		signUpButton.addEventListener('click', function(){
			window.location.href = '<?php echo base_url('sign_up'); ?>';
		})

		const forgotButton = document.getElementById('forgot-password');
		forgotButton.addEventListener('click', function(){
			window.location.href = '<?php echo base_url('reset'); ?>';
		})
	</script>
</body>
</html>

