<?php
/**
 * File: DeleteAdsAsset.php
 * Email: becksonq@gmail.com
 * Date: 19.05.2018
 * Time: 19:15
 */

namespace frontend\assets;

use yii\web\AssetBundle;

class DeleteAdsAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $js = [
        'js/delete-ads.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
    ];

    public function init()
    {
        $this->js[] = YII_DEBUG ? 'js/delete-ads.js' : 'js/delete-ads.min.js';
        parent::init();
    }
}