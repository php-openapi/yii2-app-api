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
        'dsn' => 'mysql:host=localhost;dbname=api_db',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8',
    ],
];
