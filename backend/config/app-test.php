<?php

/**
 * Main configuration file for the backend application.
 *
 * Test environment.
 */

return array_merge(require(__DIR__ . '/app.php'), [
    'components' => array_merge(
        require __DIR__ . '/../../config/components.php', // common config
        require __DIR__ . '/../../config/components-test.php', // common config (env overrides)
        require __DIR__ . '/components.php' // backend specific config
    ),
]);
