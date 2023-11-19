                    <h1>Title</h1>
                    <h5>Category1</h5>
                    <div class="d-flex flex-row align-self-end" style="font-size: 3rem">
                        <a style="font-size: 15px; margin-top: 12px;" id="like_num">1</a>
                        <a href="#" style="margin:10px;" title="star">
                            <span class="glyphicon glyphicon-heart-empty" id="like"></span>
                        </a>
                        <a href="#" style="margin:10px;" title="star">
                            <span class="glyphicon glyphicon-star-empty" id="star"></span>
                        </a>
                    </div>
                    <p class="post_content"></p>
                    <div id = "attachments"></div>
                    <!-- <a class="hidden-part" href="" target="_blank" id="attachment">Click here to download the attachment</a> -->
                    <h3></h3>
                    <small class="time"></small>
                    <br>
                    <a href="#" id="comment">comment</a>
                    <form class="d-flex flex-column" action="<?php echo base_url(); ?>login/check_comment">
                        <input type="hidden" name="post_id" id="post_id">
                        <textarea class="form-control comment-area hidden-part" style="height:200px; margin: 20px 0 20px 0;" name="content"></textarea>
                        <button class="btn btn-primary hidden-part align-self-end" type="submit">Post</button>
                    </form>
                    <div class="alert alert-success hidden-part" role="alert">
                        Comment successful!
                    </div>
                    <h2><small>Comments</small></h2>
                    <div id="comments">
                        <!-- <div class="comment">
                            <h4><span class="glyphicon glyphicon-user"></span> Name</h4>
                            <p class="comment_content">uwojfkfhakhfuoiqhfaaaaaaaaqwefasdfwjhfiowjkafkdjshafiuwojfkfhakhfuoiqhfaaaaaaaaqwefasdfwjhfiowjkafkdjshafiuwojfkfhakhfuoiqhfaaaaaaaaqwefa</p>
                            <small class="comment-time">Added 2 min ago</small>
                        </div> -->
                    </div>
                </div>
