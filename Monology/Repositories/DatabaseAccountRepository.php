<?php

namespace Monology\Repositories
{
    use Stage\Auth;

    class DatabaseAccountRepository implements IAccountRepository
    {
        private $pdo;
        private $authenticationService;

        public function __construct(\PDO $pdo, Auth\IAuthenticationService $as)
        {
            $this->pdo = $pdo;
            $this->authenticationService = $as;
        }

        public function getAllAccessToken()
        {
            $currentUser = $this->authenticationService->getCurrentUser();
            $c = $this->pdo->prepare(file_get_contents(\Monology\App::$current->appFolderPath . '/Monology/Queries/AAllccessTokenSelectionQuery.sql'));
            $c->bindParam(':1', $currentUser->number);
            $c->bindParam(':2', $userId);
            $c->execute();

            if($c->errorCode() != 00000)
            {
                $error = $c->errorInfo();
                throw new \Exception($error[2], $error[0]);
            }
            
            $row = $c->fetchAll(\PDO::FETCH_ASSOC);
            
            return $row;
        }

        public function getAccessToken(string $userId)
        {
            $currentUser = $this->authenticationService->getCurrentUser();
            $c = $this->pdo->prepare(file_get_contents(\Monology\App::$current->appFolderPath . '/Monology/Queries/AccessTokenSelectionQuery.sql'));
            $c->bindParam(':1', $currentUser->number);
            $c->bindParam(':2', $userId);
            $c->execute();

            if($c->errorCode() != 00000)
            {
                $error = $c->errorInfo();
                throw new \Exception($error[2], $error[0]);
            }
            
            $row = $c->fetch(\PDO::FETCH_ASSOC);
            
            return $row;
        }

        public function saveAccessToken(string $userId, string $token, string $secret)
        {
            $currentUser = $this->authenticationService->getCurrentUser();
            $c = $this->pdo->prepare(file_get_contents(\Monology\App::$current->appFolderPath . '/Monology/Queries/AccessTokenInsertionQuery.sql'));
            $c->bindParam(':1', $currentUser->number);
            $c->bindParam(':2', $userId);
            $c->bindParam(':3', $token);
            $c->bindParam(':4', $secret);
            $c->execute();

            if($c->errorCode() != 00000)
            {
                $error = $c->errorInfo();
                throw new \Exception($error[2], $error[0]);
            }
        }

        public function deleteAccessToken(string $userId)
        {
            throw new \BadMethodCallException('DatabaseAccountRepository::deleteAccessToken');
        }

        public function getCurrentUserId()
        {
            $currentUser = $this->authenticationService->getCurrentUser();
            $c = $this->pdo->prepare(file_get_contents(\Monology\App::$current->appFolderPath . '/Monology/Queries/CurrentAccountSelectionQuery.sql'));
            $c->bindParam(':1', $currentUser->number);
            $c->execute();

            if($c->errorCode() != 00000)
            {
                $error = $c->errorInfo();
                throw new \Exception($error[2], $error[0]);
            }

            $row = $c->fetch(\PDO::FETCH_ASSOC);

            if($row == null) throw new \Exception('CurrentUserId は保存されていません。');

            return $row['userId'];
        }

        public function saveCurrentUserId(string $userId)
        {
            $currentUser = $this->authenticationService->getCurrentUser();
            $c = $this->pdo->prepare(file_get_contents(\Monology\App::$current->appFolderPath . '/Monology/Queries/CurrentAccountInsertionQuery.sql'));
            $c->bindParam(':1', $currentUser->number);
            $c->bindParam(':2', $userId);
            $c->execute();

            if($c->errorCode() != 00000)
            {
                $error = $c->errorInfo();
                throw new \Exception($error[2], $error[0]);
            }
        }

        public function deleteCurrentUserId()
        {
            $currentUser = $this->authenticationService->getCurrentUser();
            $c = $this->pdo->prepare(file_get_contents(\Monology\App::$current->appFolderPath . '/Monology/Queries/CurrentAccountDeletionQuery.sql'));
            $c->bindParam(':1', $currentUser->number);
            $c->execute();

            if($c->errorCode() != 00000)
            {
                $error = $c->errorInfo();
                throw new \Exception($error[2], $error[0]);
            }
        }
    }
}

?>