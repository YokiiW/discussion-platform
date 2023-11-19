    </div>
	<script>
		const xhr = new XMLHttpRequest();
		var postId = "";

		const courseButton = document.getElementById("course-logo");
		const courseCloseButton = document.getElementById("course-close");
		const courseMenu = document.getElementById("course-menu");
		courseCloseButton.addEventListener("click", function(event){
			courseMenu.classList.add("invisible");
			courseButton.classList.remove("active");
			courseMenu.style.width = "0";
		});

		courseButton.addEventListener("click", function(event){
			courseMenu.classList.remove("invisible");
			courseButton.classList.add("active");
			courseMenu.style.width = "15%";
		});

		const threadButton = document.getElementById("thread-logo");
		const threadCloseButton = document.getElementById("thread-close");
		const threads = document.getElementById("threads");
		const defaultCourse = document.querySelector('.course_background');
		const searchResultDiv = document.getElementById("search-result");
		var currentCourse = defaultCourse.value;
		threadCloseButton.addEventListener("click", function(event){
			threads.classList.add("invisible");
			threadButton.classList.remove("active");
			threads.style.width = "0";
		});

		threadButton.addEventListener("click", function(){
			threads.classList.remove("invisible");
			threadButton.classList.add("active");
			threads.style.width = "30%";
			offset = 0;	
			loadPost();
			searchResultDiv.classList.add('hidden-part');
		});

		const starButton = document.getElementById('star-logo');
		const starCloseButton = document.getElementById('star-close');
		const starThreads = document.getElementById('star_thread');
		starCloseButton.addEventListener('click', function(){
			starThreads.classList.add("invisible");
			starButton.classList.remove("active");
			starThreads.style.width = "0";
		});

		starButton.addEventListener("click", function(){
			starThreads.classList.remove("invisible");
			starButton.classList.add("active");
			starThreads.style.width = "30%";
			offset = 0;	
			loadFavorite();
			searchResultDiv.classList.add('hidden-part');
		});

		const postPage = document.getElementById("post-page");
		let posts = [];
		let offset = 0;
		const courseButtons = document.querySelectorAll('.course');
		for(let courseButton of courseButtons) {
			courseButton.addEventListener('click', function(){
				for (let otherButton of courseButtons) {
					if (otherButton != courseButton) {
						otherButton.classList.remove('course_background');
					}
				}
				courseButton.classList.add('course_background');
				threads.classList.remove("invisible");
				threadButton.classList.add("active");
				threads.style.width = "30%";
				currentCourse = this.value;
				offset = 0;	
				loadPost();
				searchResultDiv.classList.add('hidden-part');
			})
		}

		let favoriteArray = [];
		function loadFavorite() {
			xhr.open("POST", "<?php echo base_url(); ?>login/show_favorite", true);
			xhr.send();
			xhr.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					favoriteArray = JSON.parse(this.responseText);
					starThreads.innerHTML = "";
					starThreads.appendChild(starCloseButton);
					appendPost(favoriteArray, starThreads);
				}
			};
		}

		let postArray = [];
		const limit = 10; // number of posts to be appended at a time
		function loadPost() {
			xhr.open("POST", "<?php echo base_url(); ?>login/show_post", true);
			xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
			xhr.send('current_course=' + currentCourse + '&offset=' + offset + '&limit=' + limit);

			xhr.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					postArray = JSON.parse(this.responseText);
					if (offset == 0) {
						threads.innerHTML = "";
						threads.appendChild(threadCloseButton);
					}
					appendPost(postArray.post, threads);
				}
			};
		}

		let likeNum;
		function appendPost(array, thread) {
			for (let i = 0; i < array.length; i++) {
				const post = array[i];

				// Create a new div for the post
				const postDiv = document.createElement('div');
				postDiv.classList.add('d-flex', 'flex-column', 'post');

				// Add the post title to the div
				const title = document.createElement('div');
				title.textContent = post.title;
				title.classList.add('title');
				postDiv.appendChild(title);

				// Add the post category to the div
				const category = document.createElement('h6');
				category.textContent = post.category;
				postDiv.appendChild(category);

				// Add the post div to the container
				thread.appendChild(postDiv);

				showPost(postDiv, post);
			}

			posts = document.querySelectorAll('.post');
			for(let post of posts) {
				post.addEventListener('click', function(){
					// Remove selectedPost class from other posts
					for(let otherPost of posts) {
						if(otherPost != post) {
							otherPost.classList.remove("selectedPost");
						}
					}

					post.classList.add("selectedPost");
				})
			}
		}

		// Check if there are more posts to be appended
		threads.addEventListener('scroll', function(){
			if (threads.scrollTop + threads.clientHeight >= threads.scrollHeight) {
				if (offset < postArray.total_rows - limit) {
					offset += limit;
					loadPost(); 
				}
			}
		});

		function showPost(div, post) {
			// Add a click event listener to the post div to show the post content
			div.addEventListener('click', function(){
				searchResultDiv.classList.add('hidden-part');
				searchInput.value = "";
				xhr.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						postPage.innerHTML = this.responseText;
						postPage.classList.remove("align-items-center");

						const thread_title = postPage.querySelector('h1');
						const thread_category = postPage.querySelector('h5');
						const thread_content = postPage.querySelector('.post_content');
						const thread_author = postPage.querySelector('h3');
						const thread_author_photo = document.createElement('span');
						const author_text = document.createTextNode(post.author);
						const thread_time = postPage.querySelector('.time');
						const post_id_input = document.getElementById('post_id');

						thread_author_photo.classList.add('glyphicon', 'glyphicon-user');
						thread_author_photo.style.marginRight = '10px';
						thread_author.appendChild(thread_author_photo);
						thread_author.appendChild(author_text);					
						thread_title.textContent = post.title;
						thread_category.textContent = post.category;
						post_id_input.value = post.id;
						postId = post.id;
						likeNum = document.getElementById('like_num');
						likeNum.textContent = post.likes[0];
						thread_content.textContent = post.content;
						thread_time.textContent = "posted in " + post.created_at;

						loadContent();

						const commentButton = postPage.querySelector('#comment');
						const commentArea = postPage.querySelector('.comment-area');
						const commentPostButton = postPage.querySelector('.btn-primary');

						const commentForm = postPage.querySelector('form');
						const commentAlert = postPage.querySelector('.alert');

						commentButton.addEventListener('click', function(){
							commentArea.classList.toggle('hidden-part');
							commentPostButton.classList.toggle('hidden-part');
							commentAlert.classList.add('hidden-part');
						})

						commentForm.addEventListener('submit', function(event) {
							event.preventDefault();

							const formData = new FormData(commentForm);
							xhr.onreadystatechange = function() {
								if (this.readyState == 4 && this.status == 200) {
									const response = JSON.parse(this.responseText);
									if (response.success) {
										const textarea = commentForm.querySelector('textarea');
										textarea.value = '';
										commentAlert.classList.add('alert-success');
										commentAlert.classList.remove('alert-danger');
										commentAlert.classList.remove('hidden-part');
										loadComment();
									} else if (response.error) {
										commentAlert.innerHTML = "Comment failed! Please try again";
										commentAlert.classList.remove('alert-success');
										commentAlert.classList.add('alert-danger');
										commentAlert.classList.remove('hidden-part');
									}
								}
							};
							xhr.open('POST', commentForm.action, true);
							xhr.send(formData);
						})
					}
				};
				xhr.open("POST", "<?php echo base_url(); ?>login/open_thread", true);
				xhr.send();
			})
		}

		let threadContentArray;
		let like;
		let star;
		function loadContent() {
			xhr.open("POST", "<?php echo base_url(); ?>login/show_comment", true);
			xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
			xhr.send('post_id=' + postId);

			xhr.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					threadContentArray = JSON.parse(this.responseText);
					loadComment();
					loadFile();
					loadLike();
					loadStar();
				}
			}
		}

		function loadComment() {
			const commentArray = threadContentArray.comment;
			const comments = document.getElementById('comments');
			comments.innerHTML = "";
			for (let i = 0; i < commentArray.length; i++) {
				const comment = commentArray[i];

				//Create a new div for the comment
				const commentDiv = document.createElement('div');
				commentDiv.classList.add('comment');

				//Add the comment author to the div
				const comment_author = document.createElement('h4');
				const author_photo = document.createElement('span');
				author_photo.classList.add('glyphicon', 'glyphicon-user');
				comment_author.appendChild(author_photo);
				const author_text = document.createTextNode(comment.author);
				comment_author.appendChild(author_text);
				commentDiv.appendChild(comment_author);

				//Add the comment content to the div
				const comment_content = document.createElement('p');
				comment_content.textContent = comment.content;
				commentDiv.appendChild(comment_content);

				//Add the comment time to the div
				const comment_time = document.createElement('small');
				comment_time.textContent = comment.created_at;
				commentDiv.appendChild(comment_time);

				//Add the comment div to the container
				comments.appendChild(commentDiv);
			}
		}

		function loadFile() {
			const fileArray = threadContentArray.files;
			const attachments = document.getElementById('attachments');
			if (fileArray) {
				for (let i = 0; i < fileArray.length; i++) {
					const file = fileArray[i];

					//Create a new div
					const div = document.createElement('div');
					div.classList.add('d-flex', 'flex-row');
					
					//Create and add span
					const file_logo = document.createElement('span');
					file_logo.classList.add('glyphicon', 'glyphicon-file');
					div.appendChild(file_logo);

					//Create and add a tag
					const attachment = document.createElement('a');
					attachment.href = "/project/writable/uploads/" + file.file_name;
					attachment.target = "_blank";
					attachment.textContent = file.file_name;
					div.appendChild(attachment);

					attachments.appendChild(div);
				}
			}
		}

		function loadLike() {
			const likeButton = document.getElementById('like');
			likeButton.addEventListener('click', function(){
				likeButton.classList.toggle('glyphicon-heart');
				likeButton.classList.toggle('glyphicon-heart-empty');
				if (likeButton.classList.contains('glyphicon-heart')) {
					like = 1;
				} else {
					like = 0;
				}
				xhr.open("POST", "<?php echo base_url(); ?>login/get_like", true);
				xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
				xhr.send('like=' + like + '&post_id=' + postId);
				xhr.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						const response = JSON.parse(this.responseText);
						likeNum.textContent = response;
					}
				}
			})

			const likeStatus = threadContentArray.likeStatus;
			if (likeStatus != 0) {
				if (likeStatus.liked == 1) {
					likeButton.classList.remove('glyphicon-heart-empty');
					likeButton.classList.add('glyphicon-heart');
				} else {
					likeButton.classList.add('glyphicon-heart-empty');
					likeButton.classList.remove('glyphicon-heart');
				}
			} else {
				likeButton.classList.add('glyphicon-heart-empty');
				likeButton.classList.remove('glyphicon-heart');
			}
		}

		function loadStar()
		{
			const postStarButton = document.getElementById('star');
			postStarButton.addEventListener('click', function(){
				postStarButton.classList.toggle('glyphicon-star');
				postStarButton.classList.toggle('glyphicon-star-empty');
				if (postStarButton.classList.contains('glyphicon-star')) {
					star = 1;
				} else {
					star = 0;
				}

				xhr.open("POST", "<?php echo base_url(); ?>login/get_star", true);
				xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
				xhr.send('star=' + star + '&post_id=' + postId);
				xhr.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						const response = this.responseText;
					}
				}
				starCloseButton.click();
			})

			const starStatus = threadContentArray.starStatus;
			if (starStatus != 0) {
				if (starStatus.stared == 1) {
					postStarButton.classList.remove('glyphicon-star-empty');
					postStarButton.classList.add('glyphicon-star');
				} else {
					postStarButton.classList.add('glyphicon-star-empty');
					postStarButton.classList.remove('glyphicon-star');
				}
			} else {
				postStarButton.classList.add('glyphicon-star-empty');
				postStarButton.classList.remove('glyphicon-star');
			}
		}

		// const mapScript = document.createElement('script');
		// const locationButton = document.getElementById('location');
		// const mapDiv = document.getElementById('map');
		// if (postPage.contains(mapDiv)) {
		// 	locationButton.addEventListener('click', function(){
		// 		mapDiv.classList.toggle('hidden-part');
		// 	})

		// 	var map;
		// 	function initMap() {
		// 		if (navigator.geolocation) {
		// 		navigator.geolocation.getCurrentPosition(function(position) {
		// 			var userLatLng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
		// 			map = new google.maps.Map(document.getElementById('map'), {
		// 			center: userLatLng,
		// 			zoom: 14
		// 			});
		// 			var marker = new google.maps.Marker({
		// 			position: userLatLng,
		// 			map: map,
		// 			title: "Your Location"
		// 			});
		// 		});
		// 		} else {
		// 		console.log("Geolocation is not supported by this browser.");
		// 		// initialize map with default center if geolocation is not supported
		// 		map = new google.maps.Map(document.getElementById('map'), {
		// 			center: {lat: -27.4983477, lng: 153.0123124},
		// 			zoom: 14
		// 		});
		// 		}
		// 	}
			
		// 	mapScript.src = `https://maps.googleapis.com/maps/api/js?key=AIzaSyDBGkw6TXth0AuHIetCx9BLKIL5kKsFwZ0&callback=initMap`;
		// 	mapScript.async = true;
		// 	mapScript.defer = true;
		// 	document.body.appendChild(mapScript);
		// }

		const mapScript = document.createElement('script');
		const locationButton = document.getElementById('location');
		const mapDiv = document.getElementById('map');

		if (postPage.contains(mapDiv)) {
			locationButton.addEventListener('click', function() {
				mapDiv.classList.toggle('hidden-part');
			})

			var map;
			var directionsService;
			var directionsDisplay;
  			var userLatLng;

			function initMap() {
				if (navigator.geolocation) {
				navigator.geolocation.getCurrentPosition(function(position) {
					var userLatLng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
					map = new google.maps.Map(document.getElementById('map'), {
					center: userLatLng,
					zoom: 14
					});

					directionsService = new google.maps.DirectionsService();
					directionsDisplay = new google.maps.DirectionsRenderer();
					directionsDisplay.setMap(map);

					var marker = new google.maps.Marker({
					position: userLatLng,
					map: map,
					title: "Your Location"
					});
					
					map.addListener('click', function(event) {
						var request = {
						origin: userLatLng,
						destination: event.latLng,
						travelMode: 'DRIVING'
						};

						directionsService.route(request, function(result, status) {
						if (status == 'OK') {
							directionsDisplay.setDirections(result);
						} else {
							console.log('Error: ' + status);
						}
						});
					});
				});
				} else {
					console.log("Geolocation is not supported by this browser.");
					// initialize map with default center if geolocation is not supported
					map = new google.maps.Map(document.getElementById('map'), {
						center: {lat: -27.4983477, lng: 153.0123124},
						zoom: 14
					});
				}
			}

			mapScript.src = `https://maps.googleapis.com/maps/api/js?key=AIzaSyDBGkw6TXth0AuHIetCx9BLKIL5kKsFwZ0&callback=initMap`;
			mapScript.async = true;
			mapScript.defer = true;
			document.body.appendChild(mapScript);
		}


		let files;
		const newThreadLogo = document.getElementById('new-thread-logo');
		newThreadLogo.addEventListener('click', function(){
			if (postPage.contains(mapDiv)) {
				document.body.removeChild(mapScript);	
			}

			xhr.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					postPage.innerHTML = this.responseText;
					postPage.classList.remove("align-items-center");

					const cancelButton = document.getElementById('cancel');
					cancelButton.addEventListener('click', function(){
						xhr.onreadystatechange = function() {
							if (this.readyState == 4 && this.status == 200) {
								postPage.innerHTML = this.responseText;
								postPage.classList.add("align-items-center");
							}
						};
						xhr.open("GET", "<?php echo base_url(); ?>login/no_thread", true);
						xhr.send();
					})

					const submitPostButton = document.getElementById('submit-post');
					const selectAlert = document.getElementById('category-select');
					submitPostButton.addEventListener('click', function(event){
						let isActive = false;
						for (let categoryButton of categoryButtons) {
							if (categoryButton.classList.contains('active')) {
								isActive = true;
								break;
							}
						}
						if (!isActive) {
							selectAlert.classList.remove('invisible');
							submitPostButton.disabled = true;
						}
					})

					const categoryButtons = document.querySelectorAll('.category');
					const categoryInput = document.getElementById('category-input');
					for (let categoryButton of categoryButtons) {
						categoryButton.addEventListener('click', function(){
							for (let otherButton of categoryButtons) {
								if (otherButton != categoryButton) {
									otherButton.classList.remove('active');
									otherButton.style.border = "none";
								}
							}

							categoryButton.classList.add('active');
							categoryButton.style.border = "solid black";
							categoryInput.value = categoryButton.value;
							selectAlert.classList.add('invisible');
							submitPostButton.disabled = false;
						})
					}

					const uploadButton = document.getElementById('upload-button');
					const fileIdInput = document.getElementById('file-id');

					uploadButton.addEventListener('click', function(event){
						event.preventDefault();
						
						const formData = new FormData();
						for (let i = 0; i < files.length; i++) {
							formData.append('files[]', files[i]);
						}
						xhr.onreadystatechange = function() {
							if (this.readyState == 4 && this.status == 200) {
								const response = JSON.parse(this.responseText);
								if (response.status == 'success') {
									fileIdInput.value = response.fileIds;
									postAlert.innerHTML = response.message;
									postAlert.classList.add('alert-success');
									postAlert.classList.remove('alert-danger');
									postAlert.classList.remove('hidden-part');
								} else if (response.status == 'error') {
									postAlert.innerHTML = response.message;
									postAlert.classList.remove('alert-success');
									postAlert.classList.add('alert-danger');
									postAlert.classList.remove('hidden-part');
								}
							}
						};
						xhr.open('POST', "<?php echo base_url(); ?>login/upload_file", true);
						xhr.onload = function() {
							if (xhr.status == 413) {
								postAlert.innerHTML = 'File size must be less than 2 MB';
								postAlert.classList.remove('alert-success');
								postAlert.classList.add('alert-danger');
								postAlert.classList.remove('invisible');
							}
						}
						xhr.send(formData);
					})

					const uploadLogo = document.getElementById('upload-logo');
					const chooseFilesArea = document.getElementById('choose-files-area');
					uploadLogo.addEventListener('click', function(){
						chooseFilesArea.classList.toggle('invisible');
						this.classList.toggle('active');
					})
					
					const fileInput = document.getElementById('file-input');
					fileInput.addEventListener("change", handleFileSelect, false);

					const dropArea = document.getElementById('drop-area');
					// Drop zone drag and drop events
					dropArea.addEventListener("dragover", handleDragOver, false);
					dropArea.addEventListener("dragleave", handleDragLeave, false);
					dropArea.addEventListener("drop", handleFileDrop, false);

					function handleFileSelect(event) {
						files = event.target.files;
						show_files(files);
					}

					function handleDragOver(event) {
						event.stopPropagation();
						event.preventDefault();
						event.dataTransfer.dropEffect = "copy";
					}

					function handleDragLeave(event) {
						event.stopPropagation();
						event.preventDefault();
					}

					const fileList = document.querySelector('#choose-files-area ul');
					function handleFileDrop(event) {
						event.stopPropagation();
						event.preventDefault();
						files = event.dataTransfer.files;
						show_files(files);
					}

					function show_files(files) {
						fileList.innerHTML = '';
						if (files.length == 0) {
							fileList.innerHTML = 'No file chosen';
						}
						for (let i = 0; i < files.length; i++) {
							const file = files[i];
							const li = document.createElement('li');
							li.textContent = file.name;
							fileList.appendChild(li);
						}
					}

					const newThreadForm = document.getElementById('new-thread-form');
					const postAlert = document.getElementById('post-alert');

					newThreadForm.addEventListener('submit', function(event) {
						event.preventDefault();
						
						const formData = new FormData(newThreadForm);
						formData.append('current_course', currentCourse);
						xhr.onreadystatechange = function() {
							if (this.readyState == 4 && this.status == 200) {
								const response = JSON.parse(this.responseText);
								if (response.success) {
									const inputs = newThreadForm.querySelectorAll('input, textarea');
									inputs.forEach(input => {
										input.value = '';
									});
									categoryButtons.forEach(categoryButton => {
										categoryButton.style.border = "none";
										categoryButton.classList.remove('active');
									})
									postAlert.innerHTML = response.success;
									postAlert.classList.add('alert-success');
									postAlert.classList.remove('alert-danger');
									postAlert.classList.remove('hidden-part');
								} else if (response.error) {
									postAlert.innerHTML = response.error;
									postAlert.classList.remove('alert-success');
									postAlert.classList.add('alert-danger');
									postAlert.classList.remove('hidden-part');
								}
								offset = 0;
								loadPost();
							}
						};
						xhr.open('POST', newThreadForm.action, true);
						xhr.send(formData);
					})			
				}
			};
			xhr.open("GET", "<?php echo base_url(); ?>login/new_thread", true);
			xhr.send();
			for(let post of posts) {
				post.classList.remove('selectedPost');
			}
		})


		const userButton = document.getElementById('user-logo');
		const profileCloseButton = document.getElementById('profile-close');
		userButton.addEventListener('click', function(){
			window.location.href = '<?php echo base_url('login/profile'); ?>';
			for(let post of posts) {
				post.classList.remove('selectedPost');
			}
		});

		if (document.body.contains(profileCloseButton)) {
			profileCloseButton.addEventListener('click', function(){
				window.location.href = '<?php echo base_url('login/default_page'); ?>';
			})
		}

		const profilePhoto = document.querySelector('.profile-photo');
		if (document.body.contains(profilePhoto)) {
			profilePhoto.addEventListener('click', function(){
				window.location.href = '<?php echo base_url('login/profile_photo'); ?>';
			})
		}

		const resizeButton = document.getElementById('resize-button');
		const imageForm = document.getElementById('image-form');

		if (document.body.contains(imageForm)) {
			postPage.classList.remove('align-items-center');
			const input = document.getElementById('input-image');
			const preview = document.getElementById('preview-image');
			input.addEventListener('change', function() {
				const file = input.files[0];
				const reader = new FileReader();

				reader.addEventListener('load', function() {
					// Set the preview image source to the selected image data URL
					preview.src = reader.result;
				});

				if (file) {
					// Read the selected image as data URL
					reader.readAsDataURL(file);
				}
			});
		}

		const imageBackButton = document.getElementById('image-back');
		if (document.body.contains(imageBackButton)) {
			imageBackButton.addEventListener('click', function(){
				window.location.href = '<?php echo base_url('login/profile'); ?>';
			})
		}

		const searchForm = document.getElementById('search-form');
		const searchInput = document.getElementById('search-term');

		searchInput.addEventListener('input', function() {
			var searchValue = searchInput.value;
			if (searchValue !=  "") {
				const http = new XMLHttpRequest();
				http.open("POST", "<?php echo base_url(); ?>login/search", true);
				http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				http.send("search=" + searchValue);
				http.onload = function() {
					if (http.status == 200) {
						const searchResults = JSON.parse(this.responseText);
						searchResultDiv.innerHTML = "";
						searchResultDiv.classList.remove('hidden-part');
						for (let i = 0; i < searchResults.length; i++) {
							var searchResult = searchResults[i];
							//Create a new li for the search result
							const resultLi = document.createElement('li');
							
							//Create a new a element for the title
							const resultA = document.createElement('a');
							resultA.href = "#";
							resultA.textContent = searchResult.title;

							//Add them to the div
							resultLi.appendChild(resultA);
							searchResultDiv.appendChild(resultLi);

							showPost(resultLi, searchResult);
						}
					}
				};
			} else {
				searchResultDiv.classList.add('hidden-part');
			}
		})
	</script>
</body>
</html>


