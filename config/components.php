<?php

/**
 * General application components that are used in web and console application.
 *
 * Included by api/config/app.php, console/config/app.php and backend/config/app.php
 */

return [
    'cache' => [
        'class' => yii\caching\FileCache::class,
        'cachePath' => '@root/runtime/cache',
    ],
];
