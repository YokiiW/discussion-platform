            <div class="col-4 offset-4" style="margin-top:15%;">
                <h2 class="text-center">Reset your password</h2> 
                <br>
				<?php if(isset($invalid)): ?>
                    <p class="text-center text-danger"><?= $invalid; ?></p>
                <?php endif; ?> 
				<?php echo form_open(base_url().'reset/reset_password'); ?>      
					<div class="form-group">
                        <label>Password</label>
						<input type="password" class="form-control" value="<?= set_value('new_password') ?>" name="new_password">
					</div>
					<div class="form-group">
                        <label>Confirm Password</label>
						<input type="password" class="form-control" value="<?= set_value('new_passconf') ?>" name="new_passconf">
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary btn-block">Reset</button>
					</div>   
				<?php echo form_close(); ?>
			</div>		
		</div>
	</div>
</body>