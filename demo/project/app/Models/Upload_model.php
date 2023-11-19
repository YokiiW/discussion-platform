<?php

namespace App\Models;

use CodeIgniter\Model;

class Upload extends Model
{
    public function upload($fileName)
    {
        $file = [
            'file_name' => $fileName,
        ];
        $db = \Config\Database::connect();
        $builder = $db->table('Upload');
        if ($builder->insert($file)) {
            return $db->insertID();
        } else {
            return false;
        }
    }
        
}