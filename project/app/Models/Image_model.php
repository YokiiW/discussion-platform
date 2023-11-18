<?php

namespace App\Models;

use CodeIgniter\Model;
use Imagick;

class ImageModel extends Model
{
    public function resize($path, $filename, $width, $height)
    {
        $imagick = new \Imagick($path.$filename);
        $imagick->resizeImage($width, $height, Imagick::FILTER_LANCZOS, 1);
        $imagick->writeImage($path.'resize_'.$filename);
        $imagick->clear();
        $imagick->destroy();
        return 'resize_'.$filename;
    }
    
    public function addWatermark($path, $filename, $text)
    {
        $imagick = new \Imagick($path.$filename);
        $draw = new \ImagickDraw();
        $draw->setFontSize(50);
        $draw->setFillColor('white');
        $draw->setStrokeColor('black'); 
        $draw->setStrokeWidth(1);
        $draw->setGravity(Imagick::GRAVITY_CENTER);
        $draw->annotation(10, 10, $text);
        $imagick->drawImage($draw);
        $imagick->writeImage($path.'watermark_'.$filename);
        $imagick->clear();
        $imagick->destroy();
        return 'watermark_'.$filename;
    }

    public function rotate($path, $filename, $degrees)
    {
        $imagick = new \Imagick($path.$filename);
        $imagick->rotateImage(new \ImagickPixel(), $degrees);
        $imagick->writeImage($path.'rotate_'.$filename);
        $imagick->clear();
        $imagick->destroy();
        return 'rotate_'.$filename;
    }

    public function upload($imageName)
    {
        $image = [
            'image_name' => $imageName,
        ];
        $db = \Config\Database::connect();
        $builder = $db->table('Image');
        if ($builder->insert($image)) {
            return true;
        } else {
            return false;
        }
    }
}