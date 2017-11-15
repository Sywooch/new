<?php
/**
 * User: beckson
 * Date: 15.11.2017
 * Time: 16:47
 * Email: becksonq@gmail.com
 */

namespace board\entities;

use yii\web\UploadedFile;

class Image
{
    public static function create( UploadedFile $file )
    {
        $image = new static();
        $image->file = $file;
        return $image;
    }
}