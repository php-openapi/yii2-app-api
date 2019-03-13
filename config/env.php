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
Yii::setAlias('@root', dirname(__DIR__));
Yii::setAlias('@api', '@root/api');
Yii::setAlias('@console', '@root/console');
Yii::setAlias('@backend', '@root/backend');
Yii::setAlias('@common', '@root/common');
Yii::setAlias('@logs', '@root/logs');

require __DIR__ . '/events.php';
