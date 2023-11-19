            <div class="col-4 offset-4" style="margin-top:15%;">
				<h2 class="text-center">Verify your Email Address</h2>
                <p class="text-center">We just sent you the verification code to , please enter below to verify your email</p>
				<?php echo form_open(base_url().'verification/verify'); ?>     
					<div class="form-group">
						<input type="tel" class="form-control" name="verification_code">
                        <button type="submit" <?php if(isset($isButtonDisabled)): ?><?php if ($isButtonDisabled) {echo 'disabled';} ?><?php endif; ?> class="btn btn-primary btn-block">Verify</button>
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
</body>