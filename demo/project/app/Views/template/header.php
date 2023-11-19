<html>

<head>
    <title>Discussion</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.css">
    <script src="<?php echo base_url(); ?>assets/js/jquery-3.6.0.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <style>
        .selectedPost {
        background-color: #d9e6f2;
        border-radius: 25px;
        border-bottom: solid white;
        }

        .course_background {
            background-color: #d9e6f2;
        }

        .post {
            height: 80px; 
            padding: 10px; 
            border-bottom-style: solid;
        }

        .star_post {
            height: 100px; 
            padding: 10px; 
            border-bottom-style: solid;
        }

        .title {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            font-weight: bold;
        }

        .hidden-part {
            display: none;
        }

        .comment {
            border-bottom: solid grey; 
            padding: 10px;
        }

        #map {
            height: 500px;
        }

        .profile-photo {
            width: 100px;
            height: 100px;
            overflow: hidden;
            border-radius: 50%;
        }

        .profile-photo img {
            width: auto;
            height: 100%;
            object-fit: cover;
        }

        #search-result {
        background-position: 10px 12px;
        background-repeat: no-repeat;
        width: 100%;
        font-size: 16px;
        padding: 12px 20px 12px 40px;
        border: 1px solid #ddd;
        margin-bottom: 12px;
        }

        #search-result {
        list-style-type: none;
        padding: 0;
        margin: 0;
        }

        #search-result li a {
        border: 1px solid #ddd;
        margin-top: -1px; /* Prevent double borders */
        background-color: #f6f6f6;
        padding: 12px;
        text-decoration: none;
        font-size: 18px;
        color: black;
        display: block
        }

        #search-result li a:hover:not(.header) {
        background-color: #eee;
        }
    </style>
</head>

<body>
    <div class="d-flex flex-row h-100 w-100">
        <ul class="nav nav-pills flex-column justify-content-center align-items-center bg-light" style="width: 5%; height: 100%; border-right-style: solid; font-size: 25px;">
            <li class="mb-auto" id="user-logo" style="margin-top: 10px;">
                <a href="#" title="User">
                    <span class="glyphicon glyphicon-user"></span>
                </a>
            </li>
            <li id="course-logo">
                <a href="#" title="Courses">
                    <span class="glyphicon glyphicon-tasks"></span>
                </a>
            </li>
            <li id="thread-logo">
                <a href="#" title="Threads">
                    <span class="glyphicon glyphicon-comment"></span>
                </a>
            </li>
            <li class="mb-auto" id="star-logo">
                <a href="#" title="Starred">
                    <span class="glyphicon glyphicon-star"></span>
                </a>
            </li>
        </ul>
        <div class="d-flex flex-column" style="height: 100%; width: 95%;">
            <ul class="nav bg-light justify-content-center" style="border-bottom-style: solid; padding-top: 10px; height: 8%; z-index: 1;">
                <li class="mr-auto">
                    <a class="navbar-brand mr-auto">Discussion</a>
                </li>
                <li class="mr-auto">
                    <div class="form-inline" id="search-form">
                        <div class="input-group">
                            <input type="text" size="50" id="search-term" class="form-control" placeholder="Search posts" name="search-term">
                        </div>
                    </div>
                    <ul id="search-result" class="bg-light hidden-part">
                        <!-- <li><a href="#">Adele</a></li>
                        <li><a href="#">Agnes</a></li> -->
                    </ul>
                </li> 
                <li style="margin-right: 10px;">
                    <button class="btn btn-primary btn-lg my-2 my-sm-0" type="button" id="new-thread-logo">
                        <span class="glyphicon glyphicon glyphicon glyphicon-edit">&nbsp;NewThread</span>
                    </button>
                </li>   
            </ul>
        
        
    

    

