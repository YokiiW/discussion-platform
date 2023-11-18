                    <?php if (isset($validation)): ?>
                        <div class="alert alert-danger"><?= $validation->listErrors() ?></div>
                    <?php endif; ?>
                    <?php if (isset($success)): ?>
                        <div class="alert alert-success"><?= $success ?></div> 
                        <div>
                        <img src="<?php echo $watermark; ?>" alt="Image with watermark." style="width: 100%;"> 
                        </div>     
                    <?php endif; ?>	
                    <button class="btn btn-primary" id="image-back">Go back</button>