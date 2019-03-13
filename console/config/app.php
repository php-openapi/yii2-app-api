<?php

/**
 * Main configuration file for the console application.
 */

return [
    'id' => 'console',

    'bootstrap' => ['log', /*'queue'*/],

    'basePath' => dirname(__DIR__),
    'vendorPath' => dirname(__DIR__, 2) . '/vendor',
    'runtimePath' => dirname(__DIR__, 2) . '/runtime/console',

    'controllerNamespace' => 'console\commands',

    // TODO configure migrations
    'controllerMap' => [
        'migrate' => [
            'class' => \yii\console\controllers\MigrateController::class,
            'migrationPath' => [
                // internal
                '@common/migrations',
            ],
//            'migrationNamespaces' => [
//                'zhuravljov\yii\queue\monitor\migrations',
//            ],
        ],
    ],
];
