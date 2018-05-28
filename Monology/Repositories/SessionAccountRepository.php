<?php

namespace Monology\Repositories
{
    use Stage\Auth;

    class SessionAccountRepository implements IAccountRepository
    {
        public function getAccessToken(string $userId)
        {
            try
            {
                session_start();

                if(!isset($_SESSION[$userId])) throw new \Exception('ユーザ ID ' . $userId . ' に関連付けられたアクセス トークンがありません。');

                $userId = $_SESSION[$userId]['userId'];
                $oauthToken = $_SESSION[$userId]['oauthToken'];
                $oauthTokenSecret = $_SESSION[$userId]['oauthTokenSecret'];
            }
            catch(\Exception $ex)
            {
                throw $ex;
            }
            finally
            {
                session_write_close();
            }

            return compact($userId, $oauthToken, $oauthTokenSecret);
        }

        public function saveAccessToken(string $userId, string $token, string $secret)
        {
            session_start();

            $_SESSION[$userId] = [
                'userId' => $userId,
                'oauthToken' => $oauthToken,
                'oauthTokenSecret' => $oauthTokenSecret
            ];

            session_write_close();
        }

        public function deleteAccessToken(string $userId)
        {
            session_start();
            unset($_SESSION[$userId]);
            session_write_close();
        }

        public function getCurrentUserId()
        {
            session_start();
            $userId = isset($_SESSION['currentUserId']) ? $_SESSION['currentUserId'] : null;
            session_write_close();
            
            throw new \Exception('currentUserId はありません。');

            return $userId;
        }

        public function saveCurrentUserId(string $userId)
        {
            session_start();
            $_SESSION['currentUserId'] = $userId;
            session_write_close();
        }

        public function deleteCurrentUserId()
        {
            session_start();
            unset($_SESSION['currentUserId']);
            session_write_close();
        }
    }
}

?>