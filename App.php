<?php

namespace Monology
{
    $start = microtime(true);

    // require_once './vendor/autoload.php';
    require_once '../stage/Stage.php';
    
    use Stage\AppModel;
    use Stage\Auth;
    use Stage\Controls;
    use Stage\Data;
    use Stage\Pattern\Wire;
    use Stage\System;
    use Monology\Repositories;
    use Monology\Services;

    class App extends Wire\WireApplication
    {
        public function __construct()
        {
            $this->initializeComponent(__FILE__, __NAMESPACE__);
        }

        protected function onInitialize()
        {
            $this->registerUriScheme('st-repos', $this->settings['BaseUri'].'.repos/');

            $pdo = new \PDO(sprintf('mysql:dbname=%s;host=localhost;charset=utf8mb4;', $this->settings['DatabaseName']), $this->settings['DatabaseUserName'], $this->settings['DatabasePassword']);
            $this->container->set(\PDO::class, $pdo);

            $this->auth = new Auth\Authentication($pdo);
            $this->auth->sessionPath = parse_url($this->settings['BaseUri'], PHP_URL_PATH);
            $this->auth->authenticate();
            $this->container->set(Auth\Authentication::class, $this->auth);
            $this->container->set(Services\ITimelineService::class, $this->container->get(Services\LocalTimelineService::class));
        }

        protected function onRequest($method, $uri)
        {
            $path = $this->ignoreBaseUri($uri->hostAndPath);

            // REST
            if($method == 'GET' && $path == '.repos/messages/')
            {
                $tl = $this->container->get(Services\ITimelineService::class);
                $this->view = new Controls\JSONPage();
                $this->view->value = $tl->getTimeline([]);
                $this->view->render();
            }
            else if($method == 'POST' && $path == '.repos/message/create/')
            {
                $tl = $this->container->get(Services\ITimelineService::class);
                $body = json_decode(file_get_contents('php://input'), true);
                $this->view = new Controls\JSONPage();
                $this->view->value = $tl->createStatus($body['body']);
                $this->view->render();
            }
            // Views
            else if($path == 'auth/login/')
            {
                $this->display('Auth', ['mode' => 'login']);
            }
            else if($path == 'auth/logout/')
            {
                $this->display('Auth', ['mode' => 'logout']);
            }
            else if($path == '')
            {
                $this->display('Timeline', []);
            }
            else
            {
                $this->display('Error', array('code' => '404'));
            }
        }
    }

    (new App())->run();

    $finish = microtime(true);

    // print $finish - $start;
}
    
?>