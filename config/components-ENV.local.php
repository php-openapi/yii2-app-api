<?php
/**
 * Template for local configuration adjustments.
 *
 * You can copy this file to the following environments to override component configurations locally:
 *
 * - components-dev.local.php
 * - components-prod.local.php
 * - components-test.local.php
 */

return [
    'db' => [
        'class' => yii\db\Connection::class,
        'dsn' => 'mysql:host=db;dbname=api_db', // for docker
        //'dsn' => 'mysql:host=localhost;dbname=api_db', // use this when mysql runs on your local host
        'username' => 'api',
        'password' => 'apisecret',
        'charset' => 'utf8',
        'schemaMap' => [
            // add support for MariaDB JSON columns
            'mysql' => SamIT\Yii2\MariaDb\Schema::class
        ],
    ],
];
