<?php

/**
 * Main configuration file for the backend application.
 */

return [
    'id' => 'backend',

    'basePath' => dirname(__DIR__),
   	'vendorPath' => dirname(__DIR__, 2) . '/vendor',
    'runtimePath' => dirname(__DIR__, 2) . '/runtime/backend',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'controllerNamespace' => 'backend\controllers',

    'bootstrap' => ['log'],

    'params' => require(__DIR__ . '/../../config/params.php'),
];
