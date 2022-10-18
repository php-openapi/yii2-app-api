<?php

/**
 * component configuration overrides for the backend application.
 */

return [
    'request' => [
        'cookieValidationKey' => file_get_contents(__DIR__ . '/cookie-validation.key'),
    ],
    'errorHandler' => [
        'errorAction' => 'site/error',
    ],
    'urlManager' => [
        'enablePrettyUrl' => true,
        'enableStrictParsing' => true,
        'showScriptName' => false,
        'rules' => require(__DIR__ . '/url-rules.php'),
    ],
    'log' => [
        'traceLevel' => YII_DEBUG ? 3 : 0,
        'targets' => [
            [
                'class' => yii\log\FileTarget::class,
                'levels' => ['error', 'warning'],
                'logFile' => '@logs/backend-app.error.log',
                'except' => [
                    'yii\web\HttpException*',
                ],
            ],
            [
                'class' => yii\log\FileTarget::class,
                'levels' => ['error', 'warning'],
                'logFile' => '@logs/backend-http.error.log',
                'categories' => [
                    'yii\web\HttpException*',
                ],
            ],
            [
                'class' => yii\log\FileTarget::class,
                'levels' => ['info'],
                'logFile' => '@logs/backend-app.info.log',
                'logVars' => [],
                'except' => [
                    'yii\db\*',
                ],
            ],
        ],
    ],
];
