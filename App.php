<?php

namespace Monology
{
    $start = microtime(true);

    require_once './vendor/autoload.php';
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
            session_set_cookie_params(0, parse_url($this->settings['BaseUri'], PHP_URL_PATH));

            $pdo = new \PDO(sprintf('mysql:dbname=%s;host=localhost;charset=utf8mb4;', $this->settings['DatabaseName']), $this->settings['DatabaseUserName'], $this->settings['DatabasePassword']);
            $this->container->set(\PDO::class, $pdo);
            
            $this->auth = $this->container->get(Auth\Authentication::class);
            $this->auth->setSessionPath(parse_url($this->settings['BaseUri'], PHP_URL_PATH));
            $this->auth->isSessionValid();
            $this->container->set(Auth\IAuthenticationService::class, $this->auth);

            $accounts = new Repositories\DatabaseAccountRepository($pdo, $this->auth);
            $this->container->set(Repositories\IAccountRepository::class, $accounts);

            $twitter = new Services\TwitterServiceProxy(
                $accounts,
                $this->settings['ApplicationCallbackUri'],
                $this->settings['ApplicationKey'],
                $this->settings['ApplicationSecret']);
            $this->container->set(Services\ITwitterServiceProxy::class, $twitter);

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
            else if($path == 'account/connect/' && isset($_REQUEST['oauth_token']) && isset($_REQUEST['oauth_verifier']))
            {
                $this->display('Accounts', [
                    'command' => 'connect',
                    'oauthToken' => $_REQUEST['oauth_token'],
                    'oauthVerifier' => $_REQUEST['oauth_verifier']
                    ]);
            }
            else if($path == 'account/connect/')
            {
                $this->display('Accounts', [
                    'command' => 'connect'
                ]);
            }
            else if($path == 'account/')
            {
                $this->display('Accounts', []);
            }
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