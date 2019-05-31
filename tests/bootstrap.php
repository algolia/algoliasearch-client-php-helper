<?php

require_once __DIR__.'/../vendor/autoload.php';

$envVarNames = array('ALGOLIA_APPLICATION_ID_1', 'ALGOLIA_ADMIN_KEY_1');
foreach ($envVarNames as $name) {
    if (!is_string(getenv($name))) {
        echo "Environment variable $name is undefined, please set one.";
        exit(255);
    }
}
unset($envVarNames, $name);
