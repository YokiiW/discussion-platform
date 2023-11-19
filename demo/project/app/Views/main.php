            <!-- main page -->
            <div class="d-flex flex-row" style="height: 92%;">
                
                <div class="d-flex flex-column invisible" id="course-menu" style="width: 0; border-right-style: solid; z-index: 2;">
                    <div class="d-flex flex-column h-50" style="padding-left: 10px; border-bottom-style: solid;">
                        <a class="align-self-end" id="course-close" href="#"><span class="glyphicon glyphicon-remove"></span></a>
                        <a class="text-muted">Current Courses</a>
                        <nav class="nav flex-column" style="margin-top: 10px;">
                            <?php foreach ($courses as $key => $course): ?>
                                <button class="nav-link text-dark btn course <?= ($key == 0) ? 'course_background' : '' ?>" value="<?= $course['course_name'] ?>"><b><?= $course['course_name'] ?></b></button>
                            <?php endforeach; ?>
                        </nav>
                    </div>
                    <div class="d-flex flex-column flex-fill" style="margin-left: 10px; margin-top: 10px;">
                        <a class="text-muted">Categories</a>
                        <nav class="nav flex-column text-secondary" style="margin-top: 10px;">
                            <h5><span class="glyphicon glyphicon-stop" style="color: #00BFFF"></span>General</h5>
                            <h5><span class="glyphicon glyphicon-stop" style="color: #6495ED"></span>Social</h5>	
                            <h5><span class="glyphicon glyphicon-stop" style="color: #9370DB"></span>Exam</h5>	
                            <h5><span class="glyphicon glyphicon-stop" style="color: #FFC0CB"></span>Assignment</h5>	
                            <h5><span class="glyphicon glyphicon-stop" style="color: #9ACD32"></span>Lecture</h5>	
                            <h5><span class="glyphicon glyphicon-stop" style="color: #FFA500"></span>Other</h5>		
                        </nav>
                    </div>
                </div>



                
                <div class="d-flex flex-column invisible" id="threads" style="width: 0; border-right-style: solid; overflow: scroll; padding: 10px;">
                    <a class="align-self-end sticky-top" id="thread-close" href="#">
                        <span class="glyphicon glyphicon-remove"></span>
                    </a>

                    <div class="d-flex flex-column post">
                        <h5>Title</h5>
                        <h6>Category1</h6>
                    </div>
                </div>

                <div class="d-flex flex-column invisible" id="star_thread" style="width: 0; border-right-style: solid; overflow: scroll; padding: 10px;">
                    <a class="align-self-end sticky-top" id="star-close" href="#">
                        <span class="glyphicon glyphicon-remove"></span>
                    </a>

                    <div class="d-flex flex-column star_post">
                        <div class="title">Title about the new star discussion postTitle about the new star discussion postTitle about the new star discussion post</div>
                        <h6>Category1</h6>
                        <a class="align-self-end sticky-bottom" href="#">
                            <span class="glyphicon glyphicon-trash"></span>
                        </a>
                    </div>
                    <div class="d-flex flex-column star_post">
                        <div class="title">Title</div>
                        <h6>Category1</h6>
                        <a class="align-self-end sticky-bottom" href="#">
                            <span class="glyphicon glyphicon-trash"></span>
                        </a>
                    </div>
                </div>
                <div class="d-flex flex-fill container flex-column align-items-center" id="post-page" style="overflow: scroll; word-wrap: break-word; word-break: normal; padding-inline: 50px; padding-bottom: 20px; z-index: 0;">
                
