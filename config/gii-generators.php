<?php

/**
 * Configure yiisoft/yii2-gii Module::$generators
 */
return [
    'api' => [
        'class' => \cebe\yii2openapi\generator\ApiGenerator::class,
        'urlConfigFile' => '@api/config/url-rules.rest.php',
        'controllerNamespace' => 'api\\controllers',
        'modelNamespace' => 'common\\models',
        'fakerNamespace' => 'common\\models\\faker',
        'migrationPath' => '@common/migrations',
    ],
];
