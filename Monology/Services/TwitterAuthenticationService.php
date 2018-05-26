<?php

namespace Monology\Services
{
    use Stage\Auth;
    use Abraham\TwitterOAuth\TwitterOAuth;

    class TwitterAuthenticationService implements Auth\IAuthenticationService
    {
        public function login(string $id, string $password, bool $isMemory)
        {

        }
        public function logout()
        {}

        public function authenticate(array $savedSession = null)
        {}
    }
}

?>