<?php

/**
 * General application components that are used in web, api and console application.
 *
 * Overrides for test environment.
 */

return array_merge([
    'mailer' => [
        'class' => \yii\swiftmailer\Mailer::class,
        'useFileTransport' => true,
    ],
    'db' => [
        'class' => yii\db\Connection::class,
        'dsn' => 'mysql:host=db-test;dbname=api_db_test', // for docker
        //'dsn' => 'mysql:host=localhost;dbname=api_db_test', // use this when mysql runs on your local host
        'username' => 'api_test',
        'password' => 'apisecret',
        'charset' => 'utf8',
        'schemaMap' => [
            // add support for MariaDB JSON columns
            'mysql' => SamIT\Yii2\MariaDb\Schema::class
        ],
    ],
],

file_exists($localConfig = __DIR__ . '/components-test.local.php') ? require $localConfig : []
);
