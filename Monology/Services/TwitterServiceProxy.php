<?php

namespace Monology\Services
{
    use Stage\Auth;
    use Abraham\TwitterOAuth\TwitterOAuth;
    use Monology\Repositories;

    class TwitterServiceProxy implements ITwitterServiceProxy
    {
        private $accountRepository = null;
        private $callbackUri = null;
        private $key = null;
        private $secret = null;
        private $connection = null;

        private $currentUserId = null;
        private $users = [];

        public function __construct(Repositories\IAccountRepository $ar, string $callbackUri, string $key, string $secret)
        {
            $this->accountRepository = $ar;
            $this->callbackUri = $callbackUri;
            $this->key = $key;
            $this->secret = $secret;

            try
            {
                $this->currentUserId = $this->accountRepository->getCurrentUserId();
                $this->users[$this->currentUserId] = $this->accountRepository->getAccessToken($this->currentUserId);
            }
            catch(\Exception $ex)
            {
                $this->users = [];
            }

            // if(false)
            if(isset($_COOKIE['oauthTokenOnetime']) && isset($_COOKIE['oauthTokenSecretOnetime']))
            {
                $this->connection = new TwitterOAuth($this->key, $this->secret, $_COOKIE['oauthTokenOnetime'], $_COOKIE['oauthTokenSecretOnetime']);
            }
            else if(count($this->users) > 0)
            {
                $this->connection = new TwitterOAuth($this->key, $this->secret, $this->users[$this->currentUserId]['accessToken'], $this->users[$this->currentUserId]['accessTokenSecre']);
            }
            else
            {
                $this->connection = new TwitterOAuth($this->key, $this->secret);
            }

        }

        public function login(string $id, string $password, bool $isMemory)
        {
            throw new \BadMethodCallException('TwitterServiceProxy::login');
        }

        public function logout()
        {
            $accessToken = $this->accountRepository->getAccessToken($this->accountRepository->getCurrentUserId());
            $this->connection->post('oauth2/invalidate_token', ['access_token' => $accessToken['accessToken']]);
            $this->accountRepository->deleteAccessToken($this->accountRepository->getCurrentUserId());
        }

        public function authenticate(array $params)
        {
            try
            {
                if(array_key_exists('oauthToken', $params) && array_key_exists('oauthVerifier', $params))
                {
                    if($params['oauthToken'] !== $_COOKIE['oauthTokenOnetime'])
                    {
                        throw new \Exception('接続に失敗しました。');
                    }

                    $accessToken = $this->connection->oauth('oauth/access_token', ['oauth_verifier' => $params['oauthVerifier']]);
                    $this->accountRepository->saveCurrentUserId($accessToken['user_id']);
                    $this->accountRepository->saveAccessToken($accessToken['user_id'], $accessToken['oauth_token'], $accessToken['oauth_token_secret']);
                }
                else if(array_key_exists('id', $params) && array_key_exists('password', $params))
                {
                }
                else
                {
                    $paramKeys = implode(', ', array_keys($params));
                    throw new \Exception('パラメータが不足しています。' . implode(', ', $paramKeys) . ' のみが '. self::class .' に渡されました。');
                }
            }
            catch(\Exception $ex)
            {
                throw $ex;
            }
            finally
            {
                setcookie('oauthTokenOnetime', '', time() - 86400);
                setcookie('oauthTokenSecretOnetime', '', time() - 86400);
            }
        }

        public function getAuthenticationUri()
        {
            $requestToken = $this->connection->oauth('oauth/request_token', ['oauth_callback' => $this->callbackUri]);
            $uri = $this->connection->url('oauth/authenticate', ['oauth_token' => $requestToken['oauth_token'], 'force_login' => true]);
            setcookie('oauthTokenOnetime', $requestToken['oauth_token']);
            setcookie('oauthTokenSecretOnetime', $requestToken['oauth_token_secret']);

            return $uri;
        }

        public function isSessionValid(array $savedSession = null)
        {
            try
            {
                $res = $this->connection->get('account/verify_credentials', ['skip_Status' => 'true', 'include_entities' => 'false']);

                if(isset($res->errors)) return false;

                $this->isAuthorized = true;

                return true;
            }
            catch(\Exception $ex)
            {
                return false;
            }
        }

        public function setSessionPath(string $path)
        {
            throw new \BadMethodCallException('TwitterServiceProxy::setSessionPath');
        }

        public function isAuthorized()
        {
            throw new \BadMethodCallException('TwitterServiceProxy::isAuthorized');
        }

        private $currentUser = null;

        public function getCurrentUser()
        {
            throw new \BadMethodCallException('TwitterServiceProxy::getCurrentUser');
        }
    }
}

?>