<?php

/**
 * component configuration overrides for the console application.
 */

return [
    'log' => [
        'traceLevel' => YII_DEBUG ? 3 : 0,
        'targets' => [
            [
                'class' => yii\log\FileTarget::class,
                'levels' => ['error', 'warning'],
                'logFile' => '@logs/console-app.error.log',
                'logVars' => [],
            ],
            [
                'class' => yii\log\FileTarget::class,
                'levels' => ['info'],
                'logFile' => '@logs/console-app.info.log',
                'logVars' => [],
                'except' => [
                    'yii\db\*',
                ],
            ],
        ],
    ],
];
