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
],

file_exists($localConfig = __DIR__ . '/components-test.local.php') ? require $localConfig : []
);
