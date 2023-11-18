<?php

namespace App\Models;

use CodeIgniter\Model;

class Search extends Model
{
   public function search($searchTerm,$courses)
   {
        $db = \Config\Database::connect();
        $builder = $db->table('Posts');

        $result = [];
        
        $builder->groupStart();
        foreach ($courses as $course) {
            $builder->orWhere('course_name', $course);
        }
        $builder->groupEnd();

        $builder->groupStart();
        $builder->like('title', $searchTerm);
        $builder->orLike('content', $searchTerm);
        $builder->groupEnd();

        $query = $builder->get();
        $result = $query->getResultArray();

        return $result;
   }
}