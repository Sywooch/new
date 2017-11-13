<?php
/**
 * File: FontAwesomeAsset.php
 * Email: becksonq@gmail.com
 * Date: 13.11.2017
 * Time: 22:24
 */

namespace frontend\assets;


use yii\web\AssetBundle;

class FontAwesomeAsset extends AssetBundle
{
    public $sourcePath = '@vendor/fortawesome/font-awesome';
    public $css = ['css/font-awesome.min.css'];
}