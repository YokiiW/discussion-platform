                    <form id="image-form" action="<?php echo base_url(); ?>login/process_image" method="POST" enctype="multipart/form-data" style="margin-top: 50px;">
                        <div class="form-row">
                            <div class="col-3">
                            <label>Choose an image to process:</label>
                            </div>
                            <div class="col-4">
                            <input type="file" name="image" id="input-image">
                            </div>
                        </div>
                        <br>
                        <img id="preview-image" src="">
                        <br>
                        <?php if (isset($validation)): ?>
                            <div class="alert alert-danger"><?= $validation->listErrors() ?></div>
                        <?php endif; ?>
                        <?php if (isset($success)): ?>
                            <!-- <div class="alert alert-success"><?= $success ?></div>  -->
                            <?php if (isset($watermark)): ?>
                                <div>
                                <img src="<?php echo $watermark; ?>" alt="Watermark image." style="width: 100%;"> 
                                </div>  
                            <?php endif; ?>	   
                            <?php if (isset($resize)): ?>
                                <div>
                                <img src="<?php echo $resize; ?>" alt="Resize image."> 
                                </div>  
                            <?php endif; ?>	   
                            <?php if (isset($rotate)): ?>
                                <div>
                                <img src="<?php echo $rotate; ?>" alt="Rotate image."> 
                                </div>  
                            <?php endif; ?>	  
                        <?php endif; ?>	
                        <div class="form-row">
                            <div class="col-1">
                            <input type="text" name="degrees" class="form-control" placeholder="Degrees">
                            </div>
                            <div class="col-1">
                            <button type="submit" name="imageBtn" value="rotate" class="btn btn-info">Rotate</button>
                            </div>
                            <div class="col-1">
                            <input type="text" name="width" class="form-control" placeholder="Width">
                            </div>
                            <div class="col-1">
                            <input type="text" name="height" class="form-control" placeholder="Height">
                            </div>
                            <div class="col-1">
                            <button type="submit" name="imageBtn" value="resize" class="btn btn-info">Resize</button>
                            </div>
                            <div class="col-2">
                            <input type="text" name="text" class="form-control" placeholder="Watermark Text">
                            </div>
                            <div class="col-2">
                            <button type="submit" name="imageBtn" value="addWatermark" class="btn btn-info">Add watermark</button>
                            </div>
                        </div>
                    </form>
                    <div class="align-self-end">
                    <?= form_open(base_url().'login/upload_image'); ?>
                        <?php if (isset($success)): ?>
                            <input type="hidden" value="<?php echo $imageName; ?>" name="imageName">
                        <?php endif; ?>	
                        <button type="submit" class="btn btn-warning">Upload</button>
                    <?= form_close(); ?>
                    </div>
                    <button class="btn btn-primary align-self-end" id="image-back">Go back</button>
                </div>