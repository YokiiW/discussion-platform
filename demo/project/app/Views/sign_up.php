                <div class="col-4 offset-4" id="sign" style="margin-top:5%;">
					<?= form_open(base_url().'sign_up/check_sign_up'); ?>
						<h2 class="text-center">Create an account</h2>
						<?php if(isset($invalid)): ?>
                    		<p class="text-center text-danger"><?= $invalid; ?></p>
                		<?php endif; ?>   
						<label for="name">Name</label>
						<div class="form-group">
							<input type="text" class="form-control" id="name" value="<?= set_value('name') ?>" name="name">
						</div>
						<div class="form-group">
							<label for="sign-up-email">Email</label>
							<input type="text" class="form-control" id="sign-up-email" value="<?= set_value('email') ?>" name="email">
						</div>
						<div class="form-group">
							<label for="sign-up-password">Password</label>
							<input type="password" class="form-control" id="sign-up-password" value="<?= set_value('password') ?>" name="password">
						</div>
						<div class="form-group">
							<label for="confirm-password">Confirm Password</label>
							<input type="password" class="form-control" id="confirm-password" value="<?= set_value('passconf') ?>" name="passconf">
						</div>
						<div class="form-group">
							<label for="sign-up-phone">Phone</label>
							<div class="d-flex flex-row">
								<span class="input-group-text input-group-prepend" id="inputGroupFileAddon01">+61</span>
								<input type="tel" class="form-control" id="sign-up-phone" value="<?= set_value('phone') ?>" name="phone">
							</div>
						</div>
						<button type="submit" class="btn btn-primary">Sign up</button>  
					<?= form_close(); ?>
					<div class="clearfix">
						<p class="float-left">Already have an account?&nbsp;</p>
						<a href="#" id="log-in-button">Log in</a>
					</div>    
				</div>
			</div>		
		</div>
	</div>
	<script>
		const logInButton = document.getElementById('log-in-button');
		logInButton.addEventListener('click', function(){
			window.location.href = '<?php echo base_url('login'); ?>'
		});
	</script>
</body>
</html>
