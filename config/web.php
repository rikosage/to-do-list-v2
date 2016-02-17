<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'defaultRoute' => "task",
    'language' => 'en-US',
    'bootstrap' => ['log'],
    'components' => [
        'i18n' => [
            'translations' => [
                'msg*' => [ // другие заголовки
                    'class' => 'yii\i18n\PhpMessageSource', 
                    'basePath' => '@app/messages',// путь к файлам перевода
                    'sourceLanguage' => 'ru-RU', // // Язык с которого переводиться (данный язык использован в текстах сообщений).
 
                ],     
            ],
        ],
        'request' => [
            'cookieValidationKey' => "1234s",
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

        //Здесь полагается определить настройки почтового сервера.
        //По умолчанию используется mail.ru
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host'  => 'smtp.mail.ru',
                'username' => '', //Email-адрес, с которого будут отправляться уведомления
                'password' => '', //Пароль пользователя
                'port'     => '587',
                'encryption' => 'tls', 
            ],
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
