<?php

namespace App\Controllers;

use CodeIgniter\Files\File;

class Login extends BaseController
{    
    public function index()
    {
        $data['error'] = "";
        if (isset($_COOKIE['username']) && isset($_COOKIE['password'])) {
            $this->default_page();
        }
        else {
            if (session()->get('username')) {
                $this->default_page();
            } else {
                echo view('template/header');
                echo view('login', $data);
            }
        } 
    }

    public function check_login() {
        $data['error']= "<div class=\"alert alert-danger\" role=\"alert\"> Incorrect username or password!! </div> ";
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $if_remember = $this->request->getPost('remember');

        $model = model('App\Models\User_model');
        $check = $model->login($username, $password);
        if($check) {
            # Create a session
            $session = session();
            $session->set('username', $username);
            $session->set('password', $hashedPassword);

            if($if_remember)
            {
                setcookie('username', $username, time() + (86499 *30), "/");
                setcookie('password', $hashedPassword, time() + (86499 *30), "/");
                // set_cookie('username', $username, 86400 * 30, "/")
                // set_cookie('password', $password, 86400 * 30, "/")
            }

            return redirect()->to(base_url('login/default_page')); 
        } else {
            echo view('template/header');
            echo view('login', $data);
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        setcookie('username', '', time() - 3600, "/");
        setcookie('password', '', time() - 3600, "/");
        return redirect()->to(base_url('login'));
    }

    public function auto_logout()
    {
        if ($this->get_user_name() == null)
        {
            $this->logout();
        }
    }

    public function get_user_name()
    {
        $username = session()->get('username');
        if (!$username) {
            $username = get_cookie('username');
        }
        return $username;
    }    

    public function default_header()
    {
        $username = $this->get_user_name();
        $model = model('App\Models\User_model');
        $data['courses'] = $model->getUserCourses($username);
        echo view('template/header');
        echo view('main', $data);
    }

    public function default_page()
    {
        $this->default_header();
        echo view('no_thread');
        echo view('template/footer');  
    }

    public function new_thread()
    {
        echo view("new_thread");
    }

    public function no_thread()
    {
        echo view("no_thread");
    }

    public function star_thread()
    {
        $this->default_header();
        echo view("star_thread");
        echo view('template/footer');
    }

    public function open_thread()
    {
        echo view("open_thread");
    }

    public function profile()
    {
        $username = $this->get_user_name();
        $model = model('App\Models\User_model');
        $data['user'] = $model->getUserProfile($username);
        $data['allCourses'] = $model->getCourses();
        $this->default_header();
        echo view('profile', $data);
        echo view('template/footer');
    }

    public function update_profile()
    {
        $model = model('App\Models\User_model');
        $username = $this->get_user_name();
        $data['user'] = $model->getUserProfile($username);

        $rules = [
            'profile_email'    => 'required|valid_email|is_unique[Users.email]',
            'profile_phone'    => 'required|regex_match[/^[0-9]{9}$/]'
        ]; 

        $messages = [
            'profile_email' => [
                'required' => 'The email field is required.',
                'valid_email' => 'The email field must contain a valid email address.',
                'is_unique' => 'This email is already registered.'
            ],
            'profile_phone' => [
                'required' => 'The phone field is required.',
                'regex_match' => 'The phone field must be an Australian phone number.'
            ]
        ];

        if (! $this->validate($rules, $messages)) {
            $data['invalid'] = implode('<br>', $this->validator->getErrors());
            $data['allCourses'] = $model->getCourses();
            $this->default_header();
            echo view('profile', $data);
            echo view('template/footer');
        } else {
            $newEmail = $this->request->getPost('profile_email');
            $newPhone = $this->request->getPost('profile_phone');
    
            $check = $model->updateUserProfile($username, $newEmail, $newPhone);
    
            if($check) {
                session()->set('email', $newEmail);
                session()->set('type', 'update');
                return redirect()->to(base_url('verification'));
            } else {
                $data['error']= "<div class=\"alert alert-danger\" role=\"alert\"> Update failed! </div> ";
                $this->default_header();
                echo view('profile', $data);
                echo view('template/footer');
            }    
        }
    }

    public function update_course()
    {
        $username = $this->get_user_name();
        $model = model('App\Models\User_model');
        $model->deleteCourse($username);

        for ($i = 0; $i < 4; $i++) {
            $courses[] = $this->request->getPost('course'.$i);
            if ($courses[$i] != "...") {
                $model->insertCourse($username, $courses[$i]);
            }
        }
        return redirect()->to(base_url('login/profile'));
    }

    public function check_post()
    {
        $title = $this->request->getPost('title');
        $category = $this->request->getPost('category');
        $author = $this->get_user_name();
        $content = $this->request->getPost('content');
        $course = $this->request->getPost('current_course');
        $fileId = $this->request->getPost('file_id');

        $model = model('App\Models\Post_model');
        $postId = $model->post($title, $category, $author, $content, $course);
        
        if ($postId) {
            if ($fileId != "") {
                $ids = explode(",", $fileId);
                $model->insert_files($ids, $postId);
            }
            $data['success']= 'Post successful!';
        } else {
            $data['error']= 'Post failed! Please try again';
        }

        echo json_encode($data);
    }

    public function show_post()
    {
        $course = $this->request->getPost('current_course');
        $offset = $this->request->getPost('offset');
        $limit = $this->request->getPost('limit');

        $model = model('App\Models\Post_model');
        $result = $model->getPost($course, $offset, $limit);
        $data['total_rows'] = $result['total_rows'];
        $data['post'] = $result['post'];
        
        echo json_encode($data);
    }

    public function check_comment()
    {
        $post_id = $this->request->getPost('post_id');
        $content = $this->request->getPost('content');
        $author = $this->get_user_name();

        $model = model('App\Models\Post_model');
        $check = $model->comment($post_id, $content, $author);

        if ($check) {
            $data['success']= 'Post successful!';
        } else {
            $data['error']= 'Post failed! Please try again';
        }
        echo json_encode($data);   
    }

    public function show_comment()
    {
        $username = $this->get_user_name();
        $post_id = $this->request->getPost('post_id');

        $model = model('App\Models\Post_model');
        $data['comment'] = $model->getComment($post_id);

        $fileIds = $model->getFileId($post_id);

        if (!empty($fileIds)) {
            $data['files'] = $model->getFiles($fileIds);
        }

        $likeStatus = $model->get_like_status($username, $post_id);
        if ($likeStatus != null) {
            $data['likeStatus'] = $likeStatus;
        } else {
            $data['likeStatus'] = 0;
        }

        $starStatus = $model->get_star_status($username, $post_id);
        if ($starStatus != null) {
            $data['starStatus'] = $starStatus;
        } else {
            $data['starStatus'] = 0;
        }

        echo json_encode($data);
    }

    public function get_like()
    {
        $username = $this->get_user_name();
        $post_id = $this->request->getPost('post_id');
        $like = $this->request->getPost('like');

        $model = model('App\Models\Post_model');
        $model->like_status($username, $post_id, $like);
        $like_num = $model->likes($like, $post_id);

        echo json_encode($like_num[0]);
    }

    public function get_star()
    {
        $username = $this->get_user_name();
        $post_id = $this->request->getPost('post_id');
        $star = $this->request->getPost('star');

        $model = model('App\Models\Post_model');
        $model->star_status($username, $post_id, $star);
    }

    public function show_favorite()
    {
        $username = $this->get_user_name();

        $model = model('App\Models\Post_model');
        $ids = $model->get_favorite_id($username);
        $posts = $model->get_favorite_post($ids);

        echo json_encode($posts);
    }

    public function upload_file()
    {
        if(!empty($_FILES['files']['name'][0])) {
            $files = $_FILES['files'];
            $uploadPath = WRITEPATH . 'uploads/';
            $errors = [];
            $fileIds = [];

            for($i = 0; $i < count($files['name']); $i++) {
                $fileName = $files['name'][$i];
                $randomName = uniqid() . '.' . pathinfo($fileName, PATHINFO_EXTENSION);
                $fileTmpName = $files['tmp_name'][$i]; 
                $fileSize = $files['size'][$i];     

                if($fileSize > 2097152){
                    $errors[] = "File size must be less than 2 MB";
                } else {
                    $uploadFile = $uploadPath . $randomName;
                    $moveResult = move_uploaded_file($fileTmpName, $uploadFile);
                    if($moveResult){
                        $uploadedFiles[$i] = $uploadFile;
                        $model = model('App\Models\Upload_model');
                        $fileIds[] = $model->upload($randomName);
                    }
                }
            }
            if(empty($errors)){
                echo json_encode(array('status'=>'success', 'message'=>'Files uploaded successfully', 'fileIds'=>$fileIds));
            }
        } else {
            echo json_encode(array('status'=>'error', 'message'=>'No files were uploaded.'));
        }        
    }

    public function profile_photo()
    {
        $this->default_header();
        echo view('image');
        echo view('template/footer');
    }

    public function process_image()
    {
        $rules = [
            'image' => 'uploaded[image]|ext_in[image,jpg,jpeg,png,gif]',
        ];
        if ($this->validate($rules)) {
            $image = $this->request->getFile('image');
            $button = $this->request->getPost('imageBtn');

            $newName = $image->getRandomName();        
            $path = WRITEPATH . 'uploads/';
            $image->move($path,$newName);
            
            $model = model('App\Models\Image_model');

            if ($button == 'addWatermark') {
                $text = $this->request->getPost('text');
                $watermarkImage = $model->addWatermark($path, $newName, $text);
                $data['watermark'] = '/project/writable/uploads/'.$watermarkImage;
            } else if ($button == 'resize') {
                $height = $this->request->getPost('height');
                $width = $this->request->getPost('width');
                $resizeImage = $model->resize($path, $newName, $width, $height);
                $data['resize'] = '/project/writable/uploads/'.$resizeImage;
            } else if ($button == 'rotate') {
                $degrees = $this->request->getPost('degrees');
                $rotateImage = $model->rotate($path, $newName, $degrees);
                $data['rotate'] = '/project/writable/uploads/'.$rotateImage;
            }

            $data['success'] = 'Image uploaded successfully.';
            $data['imageName'] = $newName;
            
            $this->default_header();
            echo view('image', $data);
            echo view('template/footer');
        } else {
            $data['validation'] = $this->validator;
            $this->default_header();
            echo view('image', $data);
            echo view('template/footer');
        }       
    }

    public function upload_image()
    {
        $imageName = $this->request->getPost('imageName');
        $model = model('App\Models\Image_model');
        $model->upload($imageName);
    }

    public function search()
    {
        $searchTerm = $this->request->getPost('search');
        $username = $this->get_user_name();

        $userModel = model('App\Models\User_model');
        $userCourses = $userModel->getUserCourses($username);
        $courses = array_values($userCourses);
        
        $model = model('App\Models\Search_model');
        $result = $model->search($searchTerm, $courses);

        echo json_encode($result);
    }
}