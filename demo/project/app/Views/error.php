            <div class="col-4 offset-4" style="margin-top:25%;">
                <?php if(isset($error)): ?>
                    <h3 class="text-center text-danger"><?php echo $error; ?></h3>
                <?php endif; ?>
                <?php if(isset($tokenError)): ?>
                    <h3 class="text-center text-danger"><?php echo $tokenError; ?></h3>
                <?php endif; ?>        
			</div>
		</div>
	</div>
</body>