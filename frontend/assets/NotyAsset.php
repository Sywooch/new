<?php

namespace frontend\assets;

use yii\web\AssetBundle;

class NotyAsset extends AssetBundle
{
    public $sourcePath = '@vendor/needim/noty/lib';
    public $depends = [
        'yii\web\JqueryAsset'
    ];

    public function init()
    {
        $this->js[] = YII_DEBUG ? 'noty.js' : 'noty.min.js';
        $this->css[] = YII_DEBUG ? 'noty.css' : 'noty.css';
        parent::init();
    }
}