<?php

require_once __DIR__ . '/../vendor/autoload.php';



class PetroBalt
{
    private $silexApp;
    private $twigEnv;


    public function __construct()
    {
        Twig_Autoloader::register();
        $this->twigLoader = new Twig_Loader_Filesystem('../templates');
        $this->twigEnv = new Twig_Environment($this->twigLoader, []);

        $this->silexApp = new Silex\Application();
        $this->silexApp['debug'] = true;
        $this->loadRoutes();
        $this->silexApp->run();
    }

    public function init()
    {

    }

       public function loadRoutes()
    {
        $this->silexApp->get('/', function () {
            return $this->mainAction();
        });

        $this->silexApp->get('/about', function () {
            return $this->aboutAction();
        });

        $this->silexApp->get('/articles', function () {
            return $this->articlesListAction();
        });

        $this->silexApp->get('/articles/{id}', function () {
            return $this->articleAction();
        });

        $this->silexApp->get('/projects', function () {
            return $this->projectsListAction();
        });

        $this->silexApp->get('/projects{id}', function () {
            return $this->projectAction();
        });

        $this->silexApp->get('/news', function () {
            return $this->newsListAction();
        });

        $this->silexApp->get('/news{id}', function () {
            return $this->newsReadAction();
        });

        $this->silexApp->get('/contacts', function () {
            return $this->contactsAction();
        });

//        $this->silexApp->get('/{name}/{sec}', function ($sec, $name) {
//            return $this->aboutAction();
//        });
    }

    public function mainAction()
    {
        $template = $this->twigEnv->loadTemplate('main.html.twig');
        return $template->render([
            'title' => 'Главная',
        ]);
    }

    public function aboutAction()
    {
        $template = $this->twigEnv->loadTemplate('about.html.twig');
        return $template->render([
            'title' => 'О Компании'
        ]);
    }

    public function articlesListAction()
    {
        $template = $this->twigEnv->loadTemplate('articles.html.twig');
        return $template->render([
            'title' => 'Статьи'
        ]);
    }

    public function projectsListAction()
    {
        $template = $this->twigEnv->loadTemplate('projects.html.twig');
        return $template->render([
            'title' => "Проекты"
        ]);
    }

    public function newsListAction()
    {
        $template = $this->twigEnv->loadTemplate('news.html.twig');
        return $template->render([
            'title' => "Новости"
        ]);
    }

    public function contactsAction()
    {
        $template = $this->twigEnv->loadTemplate('contacts.html.twig');
        return $template->render([
            'title' => "Контакты"
        ]);
    }
}

$site = new PetroBalt($app);
