<?php

if (getenv('YII_ENV')) {
    define('YII_ENV', getenv('YII_ENV'));
    define('YII_DEBUG', YII_ENV !== 'prod');
}

list($pathInfo) = explode('?', $_SERVER["REQUEST_URI"], 2);

if (is_file(__DIR__ . '/web/' . ltrim($pathInfo, '/'))) {
    return false;
} else {
    $_SERVER['SCRIPT_NAME'] = '/index.php';
    $_SERVER['PHP_SELF'] = '/index.php';
    $_SERVER['SCRIPT_FILENAME'] = __DIR__ . '/web/index.php';
    include __DIR__ . '/web/index.php';
}
