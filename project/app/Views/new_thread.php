                    <h2 class="align-self-center">New Post</h2>
                    <br>
                    <br>
                    <div class="alert alert-success hidden-part" role="alert" id="post-alert">
                        Post successful!
                    </div>
                    <form id="new-thread-form" action="<?php echo base_url(); ?>login/check_post">
                    <div class="form-group row">
                        <label for="postTitle" class="col-1 col-form-label">Title</label>
                        <div class="col-11">
                            <input type="text" class="form-control" id="postTitle" name="title" required>
                        </div>
                    </div>
                    <div class="d-flex flex-row">
                        <h5 style="margin: 15px 25px 0 0;">Category</h5>
                        <button type="button" class="btn category" style="background-color: #00BFFF; padding: 5px; border-radius: 25px; margin: 10px; color: white;" value="General">General</button>
                        <button type="button" class="btn category" style="background-color: #6495ED; padding: 5px; border-radius: 25px; margin: 10px; color: white;" value="Social">Social</button>
                        <button type="button" class="btn category" style="background-color: #9370DB; padding: 5px; border-radius: 25px; margin: 10px; color: white;" value="Exam">Exam</button>
                        <button type="button" class="btn category" style="background-color: #FFC0CB; padding: 5px; border-radius: 25px; margin: 10px; color: white;" value="Assignment">Assignment</button>
                        <button type="button" class="btn category" style="background-color: #9ACD32; padding: 5px; border-radius: 25px; margin: 10px; color: white;" value="Lecture">Lecture</button>
                        <button type="button" class="btn category" style="background-color: #FFA500; padding: 5px; border-radius: 25px; margin: 10px; color: white;" value="Other">Other</button>
                    </div>
                    <div class="alert-danger invisible" role="alert" id="category-select"> Please select a category.</div> 
                    <input type="hidden" id="category-input" value="" name="category">
                    <div class="bg-light" style="border:1px solid grey; margin: 20px 0 0 0;">
                        <button type="button" class="btn btn-outline-secondary" id="upload-logo"><span class="glyphicon glyphicon-paperclip"></span></button>
                        <!-- <button type="button" class="btn btn-outline-secondary" id="image-logo"><span class="glyphicon glyphicon-picture"></span></button> -->
                        <textarea class="form-control" style="height:300px;" name="content" required></textarea>
                    </div>
                
                    <input type="hidden" id="file-id" value="" name="file_id">
                    <div class="d-flex justify-content-end" style="margin-top: 10px;">
                        <button type="button" class="btn btn-secondary" style="width: 100px;" id="cancel">Cancel</button>
                        <button type="submit" class="btn btn-primary" style="width: 100px;" id="submit-post">Post</button>
                    </div>
                    </form>
                    <div class="d-flex flex-row invisible" id="choose-files-area">
                        <div class="d-flex justify-content-center"style="border: 1px solid grey; border-radius: 8px; width: 100%;" id="drop-area">
                            <label for="file-input" style="cursor: pointer;" class="d-flex">   
                                <span class="glyphicon glyphicon-cloud-upload" id="file-logo" style="font-size: 20px; margin:5px;"></span>
                                <ul style="list-style: none;">
                                    No file chosen
                                </ul>
                            </label>
                            <input type="file" id="file-input" multiple name="files[]" style="display: none;">
                        </div>
                        <button class="btn btn-dark" type="button" id="upload-button">Upload</button>
                    </div>
                    <!-- <a href="/project/writable/uploads/s4758612_quiz1.zip" target="_blank">Click here to download the attachment</a>
                    <a href="/project/writable/uploads/watermark_1683737259_4f461f347eb21fbdd186.png" target="_blank">Click here to open the image</a> -->
                </div>