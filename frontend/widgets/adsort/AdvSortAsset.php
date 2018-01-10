<?php
/**
 * File: AdvSortAsset.php
 * Email: becksonq@gmail.com
 * Date: 31.12.2017
 * Time: 22:01
 */

namespace frontend\widgets\adsort;


use yii\web\AssetBundle;

class AdvSortAsset extends AssetBundle
{
    public $sourcePath = '@frontend/widgets/adsort/assets';
    public $css = [];
    public $js = [
        'js/advsort.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'frontend\assets\AppAsset'
    ];
}