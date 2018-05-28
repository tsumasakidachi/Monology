<?php
    
namespace Monology\ViewModels
{
    use Stage\Pattern\Wire;
    use Stage\Data;
    use Stage\Auth;
    use Monology\Services;
    use Monology\Models;

    class AccountsPageViewModel extends Wire\AuthViewModel
    {
        private $command;
        private $twitterService;

        public function __construct(Auth\IAuthenticationService $auth, Services\ITwitterServiceProxy $ts)
        {
            parent::__construct($auth);
            $this->twitterService = $ts;
        }

        public function onRequested(Array $states)
        {
            $this->command = isset($states['command']) ? $states['command'] : null;

            if($this->command == 'connect' && isset($states['oauthToken']) && isset($states['oauthVerifier']))
            {
                $this->twitterService->authenticate([
                    'oauthToken' => $states['oauthToken'],
                    'oauthVerifier' => $states['oauthVerifier']
                ]);
            }
            else if($this->command == 'connect')
            {
                $uri = $this->twitterService->getAuthenticationUri();
                header('Location:' . $uri);
            }
            else
            {

            }
        }
    }
}

?>