<?php
return [
    'vendorPath' => dirname( dirname( __DIR__ ) ) . '/vendor',
    'name' => 'Vezugruz29.ru',
    'language' => 'ru-RU',
    'sourceLanguage' => 'ru-RU',
    'components' => [
        'formatter'    => [
            'class'             => 'yii\i18n\Formatter',
            'defaultTimeZone'   => 'Europe/Moscow',
            'timeZone'          => 'GMT+3',
            'locale'            => 'ru-RU',
            'dateFormat'        => 'dd MMMM yyyy',
            'datetimeFormat'    => 'dd MMMM yyyy H:i:s',
            'timeFormat'        => 'H:i:s',
            'decimalSeparator'  => ',',
            'thousandSeparator' => ' ',
            'currencyCode'      => 'RUR',
        ],
        'cache'        => [
            'class' => 'yii\caching\FileCache',
        ],
        'assetManager' => [
            'bundles' => [
                'yii\bootstrap\BootstrapAsset'       => [
                    'sourcePath' => '@frontend/web/css/bootstrap/',
                    'css'        => [
                        'css/bootstrap.css',
//                        'css/bootstrap-theme.css'
                    ],
                ],
                'yii\bootstrap\BootstrapPluginAsset' => [
                    'sourcePath' => '@frontend/web/css/bootstrap/',
                    'js'         => [ 'js/bootstrap.js' ]
                ],
            ],
        ],
        'authClientCollection' => [
            'class'   => \yii\authclient\Collection::className(),
            'clients' => [
                'vkontakte' => [
                    'class'        => 'dektrium\user\clients\VKontakte',
                    'clientId'     => 'CLIENT_ID',
                    'clientSecret' => 'CLIENT_SECRET',
                ],
                'yandex'    => [
                    'class'        => 'dektrium\user\clients\Yandex',
                    'clientId'     => 'CLIENT_ID',
                    'clientSecret' => 'CLIENT_SECRET'
                ],
                'facebook'  => [
                    'class'        => 'dektrium\user\clients\Facebook',
                    'clientId'     => 'CLIENT_ID',
                    'clientSecret' => 'CLIENT_SECRET',
                ],
                'twitter'   => [
                    'class'          => 'dektrium\user\clients\Twitter',
                    'consumerKey'    => 'CONSUMER_KEY',
                    'consumerSecret' => 'CONSUMER_SECRET',
                ],
                'google'    => [
                    'class'        => 'dektrium\user\clients\Google',
                    'clientId'     => 'CLIENT_ID',
                    'clientSecret' => 'CLIENT_SECRET',
                ],
                'linkedin'  => [
                    'class'        => 'dektrium\user\clients\LinkedIn',
                    'clientId'     => 'CLIENT_ID',
                    'clientSecret' => 'CLIENT_SECRET'
                ],
            ],
        ],
    ],
    'modules'    => [
        'user' => [
            'class'                    => 'dektrium\user\Module',
            // you will configure your module inside this file
            // or if need different configuration for frontend and backend you may
            // configure in needed configs
//            'adminPermission' => 'role, permission',
            'admins'                   => [ 'beckson' ],
            'modelMap'        => [
                'User' => 'frontend\models\user\User',
            ],
//            'enableGeneratingPassword' => true, // Автоматическая генерация пароля
            'enableFlashMessages'      => false,
             'controllerMap' => [
                'admin' => [
                    'class'  => 'dektrium\user\controllers\AdminController',
                    'layout' => '/dashboard', // Admin-layout
                ],
                'settings' => [
                    'class' => 'frontend\controllers\user\SettingsController'
                ],
                'profile' => [
                    'class' => 'frontend\controllers\user\ProfileController'
                ],
            ],
            // Отправка писем
            'mailer'                   => [
                'sender'                => [ 'no-reply@myhost.com' => 'Administrator' ],
                // or ['no-reply@myhost.com' => 'Sender name']
                'welcomeSubject'        => 'Welcome subject',
                'confirmationSubject'   => 'Confirmation subject',
                'reconfirmationSubject' => 'Email change subject',
                'recoverySubject'       => 'Recovery subject',
            ]
        ],
        'rbac' => 'dektrium\rbac\RbacWebModule',
    ],
];
