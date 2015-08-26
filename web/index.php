<?php

// web/index.php
require_once __DIR__ . '/../vendor/autoload.php';

$app = new Silex\Application();
$app['debug'] = true;

$app->get('/{name}', function ($name) use ($app) {
    return 'Hello ' . $app->escape($name);
});

$app->run();

Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem('../templates');
$twig = new Twig_Environment($loader, [
//    'cache' => '../cache',
]);
$template = $twig->loadTemplate('index.html.twig');
echo $template->render([

    'title' => 'hello',
]);
