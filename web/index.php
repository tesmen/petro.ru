<?php

// web/index.php
require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();
$app['debug'] = true;
$app->get('/{name}', function ($name) use ($app) {
    return 'Hello '.$app->escape($name);
});

$app->run();