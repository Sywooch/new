<?php
return [
    'vendorPath' => dirname( dirname( __DIR__ ) ) . '/vendor',
    'name' => 'Vezugruz29.ru',
    'language' => 'ru-RU',
    'sourceLanguage' => 'ru-RU',
    'components' => [
        'cache'                => [
            'class' => 'yii\caching\FileCache',
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
//                'RegistrationForm' => 'common\models\RegistrationForm',
            ],
            // Автоматическая генерация пароля
//            'enableGeneratingPassword' => true,
            'enableFlashMessages'      => false,

             // Admin-layout
             'controllerMap' => [
                'admin' => [
                    'class'  => 'dektrium\user\controllers\AdminController',
                    'layout' => '/admin-layout',
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
