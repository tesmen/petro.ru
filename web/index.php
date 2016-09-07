<?php
//error_reporting(0);

require_once '../vendor/autoload.php';

class PetroBalt
{
    private $silexApp;
    private $twigEnv;


    public function __construct()
    {
        $this->twigLoader = new Twig_Loader_Filesystem('templates');
        $this->twigEnv = new Twig_Environment($this->twigLoader, []);
        $this->twigEnv->setCache(false);

        $this->silexApp = new Silex\Application();
        $this->silexApp['debug'] = true;


        $this->loadRoutes();
        $this->silexApp->run();

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

        $this->silexApp->get('/news/{id}', function () {
            return $this->newsReadAction();
        });

        $this->silexApp->get('/contacts', function () {
            return $this->contactsAction();
        });

        $this->silexApp->get('/maintenance', function () {
            return $this->contactsAction();
        });

        $this->silexApp->get('/hidden', function () {
            return $this->hiddenAction();
        });
    }

    public function mainAction()
    {
        $template = $this->twigEnv->loadTemplate('main.html.twig');

        return $template->render([
            'title' => 'Главная',
            'page'  => 'main'
        ]);
    }

    public function aboutAction()
    {
        $template = $this->twigEnv->loadTemplate('about.html.twig');

        return $template->render([
            'title' => 'О Компании',
            'page'  => 'about'
        ]);
    }

    public function articlesListAction()
    {
        $template = $this->twigEnv->loadTemplate('articles.html.twig');

        return $template->render([
            'title' => 'Статьи',
            'page'  => 'articles'
        ]);
    }

    public function projectsListAction()
    {
        $projects = [];
        include('templates/projects1.php');

        return $this->twigEnv->loadTemplate('projects.html.twig')->render([
            'title'    => "Проекты",
            'page'     => 'projects',
            'projects' => $projects,
        ]);
    }

    public function newsListAction()
    {
        $template = $this->twigEnv->loadTemplate('news.html.twig');

        return $template->render([
            'title' => "Новости",
            'page'  => 'educationCenter'
        ]);
    }

    public function contactsAction()
    {
        $template = $this->twigEnv->loadTemplate('contacts.html.twig');

        return $template->render([
            'title' => "Контакты",
            'page'  => 'contacts'
        ]);
    }

    public function maintenanceAction()
    {
        $template = $this->twigEnv->loadTemplate('maintenance.html.twig');

        return $template->render([
            'title' => "На обслуживании",
            'page'  => 'maintenance'
        ]);
    }

    public function hiddenAction()
    {
        return $this->twigEnv->loadTemplate('hidden.html.twig')->render([
            'title' => "Новость",
            'page'  => 'hidden'
        ]);
    }
}

$site = new PetroBalt($app);
