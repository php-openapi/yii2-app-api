<?php

/**
 * Main configuration file for the backend application.
 *
 * Develop environment.
 */

$config = array_merge(require(__DIR__ . '/app.php'), [
    'components' => array_merge(
        require __DIR__ . '/../../config/components.php', // common config
        require __DIR__ . '/../../config/components-dev.php', // common config (env overrides)
        require __DIR__ . '/components.php' // backend specific config
    ),
]);

// enable Gii module
$config['bootstrap'][] = 'gii';
$config['modules']['gii'] = [
    'class' => yii\gii\Module::class,
    // add ApiGenerator to Gii module
    'generators' => require __DIR__ . '/../../config/gii-generators.php',
    'allowedIPs' => [
        '127.0.0.1', '::1',
        // possible docker subnets
        // 172.16.0.0/12 (gii does not understand CIDR :-/)
        '172.16.*', '172.17.*', '172.18.*', '172.19.*', '172.20.*', '172.21.*', '172.22.*', '172.23.*', '172.24.*', '172.25.*',
        '172.26.*', '172.27.*', '172.28.*', '172.29.*', '172.30.*', '172.31.*',
        // 192.168.0.0/16
        '192.168.*',
        // 10.0.0.0/8
        '10.*',
    ],
];

return $config;
