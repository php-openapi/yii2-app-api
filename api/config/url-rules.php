<?php

$customRules = [
    // add your custom URL rules here
];

if (file_exists(__DIR__ . '/url-rules.rest.php')) {
    return array_merge(require __DIR__ . '/url-rules.rest.php', $customRules);
}
return $customRules;
