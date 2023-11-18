			<div class="d-flex flex-fill container-fluid flex-column justify-content-around">    	
				<a class="align-self-end" id="profile-close" href="#"><span class="glyphicon glyphicon-remove"></span></a>
				<h1>Profile</h1>
				<div class="d-flex flex-row">
				<a class="profile-photo" href="#">
					<img src="/project/writable/uploads/6461149823e22.png" alt="User Photo">
				</a>
					<!-- <h3><span class="glyphicon glyphicon-user" style="background-color: lightblue; padding: 10px; border-radius: 100%; color: white"></span></h3> -->
					<h3 style="margin: 65px 0 0 10px;"><?= $user['name']; ?></h3>
					<a style="margin: 70px 0 0 10px;" href="#" id="location">Current Location</a>
				</div>
				<br>
				<div id="map" class="hidden-part"></div>
				<?php if(isset($invalid)): ?>
                    <p class="text-center text-danger"><?= $invalid; ?></p>
                <?php endif; ?>   
				<?php echo form_open(base_url().'login/update_profile'); ?>
					<div class="form-group">
						<label for="email">Email</label>
						<input type="text" class="form-control" placeholder=<?= $user['email']; ?> value="<?= set_value('profile_email') ?>" name="profile_email">
					</div>
					<div class="form-group">
						<label for="formGroupExampleInput2">Phone number</label>
						<input type="tel" class="form-control" placeholder=<?= $user['phone']; ?> value="<?= set_value('profile_phone') ?>" name="profile_phone">
					</div>
					<button type="submit" class="btn btn-primary">Update</button>
				<?php echo form_close(); ?>
				<div>
					<h3>Enrolled Courses</h3>
					<?php echo form_open(base_url().'login/update_course'); ?>
					<div class="form-row">
						<?php for ($i = 0; $i < 4; $i++): ?>
							<div class="form-group col-md-3">
								<select class="form-control course-select" id="course<?= $i ?>" name="course<?= $i ?>">
									<option>...</option>
									<?php foreach ($allCourses as $course): ?>
										<option value="<?= $course['name'] ?>" <?= (isset($courses[$i]) && $course['name'] == $courses[$i]['course_name']) ? 'selected' : '' ?>>
												<?= $course['name'] ?>
										</option>
									<?php endforeach; ?>
								</select>
							</div>
						<?php endfor; ?>
					</div>
					<button type="submit" class="btn btn-primary">Change</button>
					<?php echo form_close(); ?>
				</div>
				<div class="d-flex flex-row justify-content-end">
					<a class="btn btn-secondary" href="<?php echo base_url(); ?>login/logout">Log out</a>
				</div>


