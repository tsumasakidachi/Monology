<?php

namespace Monology\Repositories
{
    interface IAccountRepository
    {
        public function getAllAccessToken();
        public function getAccessToken(string $userId);
        public function saveAccessToken(string $userId, string $token, string $secret);
        public function deleteAccessToken(string $userId);
        public function getCurrentUserId();
        public function saveCurrentUserId(string $userId);
        public function deleteCurrentUserId();
    }
}

?>