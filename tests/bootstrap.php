<?php

require_once __DIR__.'/../vendor/autoload.php';

$envs = [
    'ALGOLIA_APPLICATION_ID_1',
    'ALGOLIA_ADMIN_KEY_1',
];

foreach ($envs as $env) {
    if (!is_string(getenv($env))) {
        echo "Environment variable $env is undefined, please set one.";
        exit(255);
    }
}

unset($envs, $env);
