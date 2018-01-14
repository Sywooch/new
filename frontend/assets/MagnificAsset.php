<?php
/**
 * File: MagnificAsset.php
 * Email: becksonq@gmail.com
 * Date: 12.01.2018
 * Time: 17:38
 */

namespace frontend\assets;


use yii\web\AssetBundle;

class MagnificAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/magnific-popup.css',
    ];
    public $js = [
        'js/jquery.magnific-popup.min.js',
        'js/magnific.init.js'
    ];
    public $cssOptions = [
        'media' => 'screen',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
        'dosamigos\fileupload\FileUploadUIAsset',
        'frontend\assets\AppAsset',
    ];
}