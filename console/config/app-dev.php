<?php

/**
 * Main configuration file for the console application.
 *
 * Develop environment.
 */

$config = array_merge(require(__DIR__ . '/app.php'), [
    'components' => array_merge(
        require __DIR__ . '/../../config/components.php', // common config
        require __DIR__ . '/../../config/components-dev.php', // common config (env overrides)
        require __DIR__ . '/components.php' // console specific config
    ),
]);

// enable Gii module
$config['bootstrap'][] = 'gii';
$config['modules']['gii'] = [
    'class' => yii\gii\Module::class,
    // add ApiGenerator to Gii module
    'generators' => require __DIR__ . '/../../config/gii-generators.php',
];

return $config;
