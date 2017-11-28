<?php
$params = array_merge(
    require( __DIR__ . '/../../common/config/params.php' ),
    require( __DIR__ . '/../../common/config/params-local.php' ),
    require( __DIR__ . '/params.php' ),
    require( __DIR__ . '/params-local.php' )
);

return [
    'id'                  => 'app-frontend',
    'basePath'            => dirname( __DIR__ ),
    'bootstrap'           => [ 'log' ],
    'controllerNamespace' => 'frontend\controllers',
    'components'          => [
        'request'      => [
            'csrfParam'           => '_csrf-frontend',
            'cookieValidationKey' => 'ear8GcRjBGXQgKVwfEpbApyj7Fb0UKXk',
            'baseUrl'             => '',
        ],
        'session'      => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log'          => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets'    => [
                [
                    'class'  => 'yii\log\FileTarget',
                    'levels' => [ 'error', 'warning' ],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager'   => [
            'enablePrettyUrl' => true,
            'showScriptName'  => false,
            'rules'           => [
            ],
        ],
        'assetManager' => [
            'bundles' => [
                'yii\web\JqueryAsset' => [
                    'jsOptions' => [ 'position' => \yii\web\View::POS_HEAD ],
                ],
            ],
        ],
    ],
    'modules'             => [
        'user' => [
            // following line will restrict access to admin controller from frontend application
            'as frontend' => 'dektrium\user\filters\FrontendFilter',
            'layout'      => '@frontend/views/layouts/blank'
        ],
    ],
    'params'              => $params,
];
