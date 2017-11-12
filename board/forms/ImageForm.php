<?php
/**
 * File: ImageForm.php
 * Email: becksonq@gmail.com
 * Date: 11.11.2017
 * Time: 22:11
 */

namespace board\forms;

use yii\base\Model;
use yii\web\UploadedFile;

class ImageForm extends Model
{
    /**
     * @var UploadedFile[]
     */
    public $files;

    public function rules()
    {
        return [
            [ 'files', 'each', 'rule' => [ 'image' ] ],
        ];
    }

    public function beforeValidate()
    {
        if ( parent::beforeValidate() ) {
            $this->files = UploadedFile::getInstances( $this, 'files' );
            return true;
        }
        return false;
    }
}