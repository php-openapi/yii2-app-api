<?php

/**
 * Main configuration file for the api application.
 *
 * Develop environment.
 */

return array_merge(require(__DIR__ . '/app.php'), [
    'components' => array_merge(
        require __DIR__ . '/../../config/components.php', // common config
        require __DIR__ . '/../../config/components-dev.php', // common config (env overrides)
        require __DIR__ . '/components.php' // api specific config
    ),
]);
