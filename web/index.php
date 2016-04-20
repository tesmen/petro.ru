<?php
error_reporting(0);

require_once '/../vendor/autoload.php';
require_once 'PetrobaltSpecGenerator.php';
require_once 'Detail.php';

class PetroBalt
{
    private $silexApp;
    private $twigEnv;


    public function __construct()
    {
        $this->twigLoader = new Twig_Loader_Filesystem('templates');
        $this->twigEnv = new Twig_Environment($this->twigLoader, []);

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

        $this->silexApp->get('/educationCenter', function () {
            return $this->newsListAction();
        });

        $this->silexApp->get('/news{id}', function () {
            return $this->newsReadAction();
        });

        $this->silexApp->get('/contacts', function () {
            return $this->contactsAction();
        });

        $this->silexApp->get('/maintenance', function () {
            return $this->contactsAction();
        });

        $this->silexApp->get('/crunch', function () {
            return $this->crunchAction();
        });

        $this->silexApp->post('/crunch', function () {
            return $this->crunchAction(true);
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
        include('templates/projects1.php');
        $template = $this->twigEnv->loadTemplate('projects.html.twig');

        return $template->render([
            'title'    => "Проекты",
            'page'     => 'projects',
            'projects' => $projects,
        ]);
    }

    public function newsListAction()
    {
        $template = $this->twigEnv->loadTemplate('news.html.twig');

        return $template->render([
            'title' => "Учебный центр",
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

    public function crunchAction($isPost = false)
    {
        $resultFileName = null;
        $message = null;
        $success = null;

        if ($isPost) {
            try {
                $uploadDir = '/uploads/';
                $uploadFile = __DIR__ . $uploadDir . basename($_FILES['userfile']['name']);

                if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadFile)) {
                    //  echo "Файл корректен и был успешно загружен.\n";
                }

                $resultFileName = 'csv/' . $_FILES['userfile']['name'];
                $resultFileName = str_replace('xlsx', 'csv', $resultFileName);
                $spec = new PetrobaltSpecGenerator($uploadFile);
                $success = $spec->getMyCsv($resultFileName);
            } catch (\Exception $e) {
                $message = $e->getMessage();
            }
        }

        $template = $this->twigEnv->loadTemplate('crunch.html.twig');

        return $template->render([
            'title'    => "Супер Эксель",
            'page'     => 'maintenance',
            'fileLink' => $resultFileName,
            'message'  => $message,
            'success'  => $success
        ]);
    }
}

$site = new PetroBalt($app);
