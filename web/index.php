<?php

require_once __DIR__ . '/../vendor/autoload.php';

$app = new Silex\Application();
$app['debug'] = true;

class PetroBalt
{
    private $silexApp;

    public function __construct($silexApp){
        $this->silexApp= $silexApp;

        $this->loadRoutes();

        $this->silexApp->run();
    }

    public function init(){

    }

    public function loadRoutes(){
        $app = $this->silexApp;

        $this->silexApp->get('/', function () use ($app) {
            return "/";
        });

        $this->silexApp->get('/{name}/{sec}', function ($sec, $name) {
            return '{name}/{sec} ' . $name . $sec;
        });
    }

    public function mainAction(){

    }
}

$site = new PetroBalt($app);

?>
<!--

Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem('../templates');
$twig = new Twig_Environment($loader, [
//    'cache' => '../cache',
]);

$template = $twig->loadTemplate('index.html.twig');
echo $template->render([

]);
