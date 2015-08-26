<?php

require_once __DIR__ . '/../vendor/autoload.php';

$app = new Silex\Application();
$app['debug'] = true;

/**
 * default route
 */
$app->get('/', function () use ($app) {
    return 'Hello ';
});

/**
 * main route
 */
$app->get('/{name}/{sec}', function ( $sec,$name) {
    return 'Hello ' . $name . $sec;
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

