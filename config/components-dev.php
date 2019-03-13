<?php

/**
 * General application components that are used in web, api and console application.
 *
 * Overrides for production environment.
 */

return array_merge(
    [
    ],
    file_exists($localConfig = __DIR__ . '/components-dev.local.php') ? require $localConfig : []
);
