<?php

namespace App\Models;

use CodeIgniter\Model;

class Post extends Model
{
    public function post($title, $category, $author, $content, $course)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('Posts');
        $post = [
            'title' => $title,
            'category' => $category,
            'author' => $author,
            'content' => $content,
            'course_name' => $course,
        ];

        if ($builder->insert($post)) {
            return $db->insertID();
        } else {
            return false;
        }
    }

    public function getPost($course, $offset, $limit)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('Posts');
        $builder->where('course_name', $course);

        $total_rows = $builder->countAllResults(false);

        $builder->limit($limit, $offset);
        $query = $builder->get();

        return [
            'post' => $query->getResultArray(),
            'total_rows' => $total_rows,
        ];
    }

    public function comment($post_id, $content, $author)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('post_comments');
        $comment = [
            'post_id' => $post_id,
            'content' => $content,
            'author' => $author,
        ];

        if ($builder->insert($comment)) {
            return true;
        } else {
            return false;
        }
    }

    public function getComment($post_id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('post_comments');
        $builder->where('post_id', $post_id);
        $query = $builder->get();

        return $query->getResultArray();
    }

    public function getFileId($post_id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('post_files');
        $builder->select('file_id');
        $builder->where('post_id', $post_id);
        $query = $builder->get();
        $result = array_column($query->getResultArray(), 'file_id');

        return $result;
    }

    public function getFiles($fileIds)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('Upload');
        $result = [];
        foreach ($fileIds as $id) {
            $builder->where('file_id', $id);
            $query = $builder->get();
            $result[] = $query->getResultArray()[0];
        }
        return $result;
    }

    public function insert_files($fileIds, $post_id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('post_files');
        foreach ($fileIds as $id) {
            $data = [
                'file_id' => $id,
                'post_id' => $post_id,
            ];
            $builder->insert($data);
        }
    }

    public function likes($like, $post_id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('Posts');
        $builder->where('id', $post_id);
        if ($like == 1) {
            $builder->set('likes', 'likes + 1', FALSE);
        } else {
            $builder->set('likes', 'likes - 1', FALSE);
        }
        $builder->update();

        $builder->where('id', $post_id);
        $result = $builder->get()->getResultArray();
        $like_num = array_column($result, 'likes');
        return $like_num;
    }

    public function like_status($username, $post_id, $like)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('user_likes');

        // Check if the user has already liked the post
        $builder->select('id');
        $builder->where('user_name', $username);
        $builder->where('post_id', $post_id);
        $result = $builder->get()->getRow();

        $builder->where('user_name', $username);
        $builder->where('post_id', $post_id);
        if ($result) {
            if ($like == 1) {
                $builder->set('liked', 1);
            } else {
                $builder->set('liked', 0);
            }
            $builder->update();
        } else {
            $data = [
                'user_name' => $username,
                'post_id' => $post_id,
                'liked' => 1
            ];
            $builder->insert($data);
        }
    }

    public function star_status($username, $post_id, $star)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('user_stars');

        // Check if the user has already liked the post
        $builder->select('id');
        $builder->where('user_name', $username);
        $builder->where('post_id', $post_id);
        $result = $builder->get()->getRow();

        $builder->where('user_name', $username);
        $builder->where('post_id', $post_id);
        if ($result) {
            if ($star == 1) {
                $builder->set('stared', 1);
            } else {
                $builder->set('stared', 0);
            }
            $builder->update();
        } else {
            $data = [
                'user_name' => $username,
                'post_id' => $post_id,
                'stared' => 1
            ];
            $builder->insert($data);
        }
    }

    public function get_like_status($username, $post_id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('user_likes');

        $builder->select('liked');
        $builder->where('user_name', $username);
        $builder->where('post_id', $post_id);
        $result = $builder->get()->getRow();

        return $result;
    }

    public function get_star_status($username, $post_id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('user_stars');

        $builder->select('stared');
        $builder->where('user_name', $username);
        $builder->where('post_id', $post_id);

        return $builder->get()->getRow();;
    }

    public function get_favorite_id($username)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('user_stars');

        $builder->select('post_id');
        $builder->where('user_name', $username);
        $builder->where('stared', 1);
        
        $result = $builder->get()->getResultArray();
        return array_values($result);
    }

    public function get_favorite_post($ids)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('Posts');

        $result = [];
        foreach ($ids as $id) {
            $builder->where('id', $id);
            $query = $builder->get();
            $result[] = $query->getResultArray()[0];
        }

        return $result;
    }
}