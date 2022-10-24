<?php

/**
 * component configuration overrides for the console application.
 */

return [
    'log' => [
        'traceLevel' => YII_DEBUG ? 3 : 0,
        'flushInterval' => 1,
        'targets' => [
            [
                'class' => yii\log\FileTarget::class,
                'exportInterval' => 1,
                'levels' => ['error', 'warning'],
                'logFile' => '@logs/console-app.error.log',
                'logVars' => [],
            ],
            [
                'class' => yii\log\FileTarget::class,
                'exportInterval' => 1,
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
