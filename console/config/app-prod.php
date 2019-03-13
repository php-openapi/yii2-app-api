<?php

/**
 * Main configuration file for the console application.
 *
 * Production environment.
 */

return array_merge(require(__DIR__ . '/app.php'), [
    'components' => array_merge(
        require __DIR__ . '/../../config/components.php', // common config
        require __DIR__ . '/../../config/components-prod.php', // common config (env overrides)
        require __DIR__ . '/components.php' // console specific config
    ),
]);
