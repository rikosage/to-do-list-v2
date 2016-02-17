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
                'models*' => [ // заголовки для моделей
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/messages', // путь к файлам перевода
                    'sourceLanguage' => 'ru-RU', // Язык с которого переводиться (данный язык использован в текстах сообщений).
                ],
                'msg*' => [ // другие заголовки
                    'class' => 'yii\i18n\PhpMessageSource', 
                    'basePath' => '@app/messages',// путь к файлам перевода
                    'sourceLanguage' => 'ru-RU', // // Язык с которого переводиться (данный язык использован в текстах сообщений).
 
                ],     
            ],
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '123',
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
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
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
