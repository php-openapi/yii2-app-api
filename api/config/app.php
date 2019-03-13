<?php

/**
 * Main configuration file for the api application.
 */

return [
    'id' => 'api',

    'basePath' => dirname(__DIR__),
   	'vendorPath' => dirname(__DIR__, 2) . '/vendor',
    'runtimePath' => dirname(__DIR__, 2) . '/runtime/api',

    'controllerNamespace' => 'api\controllers',

    'bootstrap' => ['log'],

    'params' => require(__DIR__ . '/../../config/params.php'),
];
