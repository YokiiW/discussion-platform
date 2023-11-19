<?php

namespace App\Models;

use CodeIgniter\Model;

class Reset extends Model
{
    public function setToken($email, $token)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('tokens');
        $builder->where('email', $email);
        $query = $builder->get();

        $data = [
            'email' => $email,
            'token' => $token
        ];

        //check if the email already in the database
        if ($query->getRow() == null) {
            $builder->insert($data);
        } else {
            $builder->update($data);
        }
    }
    
    public function getEmailByToken($token)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('tokens');
        $builder->where('token', $token);
        $query = $builder->get()->getRow();

        // check if the token exists and if it is expired
        if ($query == null) {
            return null;
        }
        $expirationTime = strtotime($query->created_at) + (24 * 60 * 60);
        if (time() > $expirationTime) {
            return null;
        }
        return $query;
    }

    public function resetPassword($email, $newPassword)
    {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $db = \Config\Database::connect();
        $builder = $this->db->table('Users');
        $builder->where('email', $email); 
        if ($builder->update(['password' => $hashedPassword])) {
            return true;
        } else {
            return false;
        }
    }

    public function removeToken($email)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('tokens');
        $builder->where('email', $email);
        $builder->delete();
    }
}