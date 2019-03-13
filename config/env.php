<?php

if (!defined('YII_ENV')) {
    if (is_file($env = __DIR__ . '/../env.php')) {
        include($env);
    } else {
        define('YII_DEBUG', false);
        define('YII_ENV', 'prod');
    }
}

require(__DIR__ . '/../vendor/autoload.php');
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');

// register aliases
Yii::setAlias('@root', __DIR__ . '/..');
Yii::setAlias('@api', __DIR__ . '/../api');
Yii::setAlias('@console', __DIR__ . '/../console');
Yii::setAlias('@backend', __DIR__ . '/../backend');
Yii::setAlias('@common', __DIR__ . '/../common');
Yii::setAlias('@logs', __DIR__ . '/../logs');

require __DIR__ . '/events.php';
