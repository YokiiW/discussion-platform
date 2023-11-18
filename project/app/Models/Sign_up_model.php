<?php

namespace App\Models;

use CodeIgniter\Model;

class Upload extends Model
{
    public function sign_up($name, $email, $password, $phone)
    {
        $user = [
            'name' => $name,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'phone' => $phone,
        ];
        $db = \Config\Database::connect();
        $builder = $db->table('Users');
        if ($builder->insert($user)) {
            $default_courses = ['INFS7202', 'DECO7250', 'CSSE7023', 'CSSE7201']; 
            $user_courses_builder = $db->table('user_courses');
            foreach ($default_courses as $course_name) {
                $data = [
                    'user_name' => $name,
                    'course_name' => $course_name,
                ];
                $user_courses_builder->insert($data);
            }
            return true;
        } else {
            return false;
        }
    }
      
}