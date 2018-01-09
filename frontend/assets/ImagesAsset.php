<?php
/**
 * User: beckson
 * Date: 09.01.2018
 * Time: 12:26
 * Email: becksonq@gmail.com
 */

namespace frontend\assets;

use yii\web\AssetBundle;

class ImagesAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [];
    public $js = [
        'js/fileupload.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'dosamigos\fileupload\FileUploadUIAsset',
        'frontend\assets\AppAsset',
    ];
}