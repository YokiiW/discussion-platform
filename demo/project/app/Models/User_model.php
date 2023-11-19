<?php

namespace APP\Models;

use CodeIgniter\Model;

class User_model extends Model
{
    public function login($username, $password)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('Users');
        $builder->where('name', $username);
        $query = $builder->get()->getRowArray();

        if ($query && password_verify($password, $query['password'])) {
            return true;
        } else{
            return false;
        }
    }

    public function getUserProfile($username)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('Users');
        $builder->where('name', $username);
        $query = $builder->get();

        return $query->getRowArray();
    }

    public function updateUserProfile($username, $newEmail, $newPhone)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('Users');
        $data = [
            'email' => $newEmail,
            'phone' => $newPhone,
        ];

        $builder->where('name', $username);
        
        if ($builder->update($data)) {
            return true;
        } else {
            return false;
        }
    }

    public function getUserCourses($username)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('user_courses');
        $builder->select('course_name');
        $builder->where('user_name', $username);
        $query = $builder->get();
        
        return $query->getResultArray();
    }

    public function getCourses()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('Courses');
        $builder->select('name');
        $query = $builder->get();

        return $query->getResultArray();
    }

    public function checkEmailExists($email)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('Users');
        $builder->where('email', $email);
        $query = $builder->get();

        return $query->getRow();
    }

    public function deleteCourse($username)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('user_courses');
        $builder->where('user_name', $username);
        $builder->delete();
    }

    public function insertCourse($username, $course)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('user_courses');
        $data = [
            'user_name' => $username,
            'course_name' => $course
        ];
        $builder->insert($data);
    }
}