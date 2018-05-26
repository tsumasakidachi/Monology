<?php
    
namespace Monology\Repositories
{
    use Stage\System;

    class TimelineRepository
    {
        private $pdo;

        public function __construct(\PDO $pdo)
        {
            $this->pdo = $pdo;
        }

        public function getAll()
        {
            $file = System\Application::$current->getAppFolder()->getFile('/Monology/Queries/MessagesSelectionQuery.sql');
            $c = $this->pdo->prepare($file->readText());
            $c->execute();

            if($c->errorCode() != 00000)
            {
                $error = $c->errorInfo();
                throw new \Exception($error[2], $error[0]);
            }

            return $c->fetchAll(\PDO::FETCH_ASSOC);
        }

        public function save(string $userId, \DateTime $createdAt, string $body)
        {
            $file = System\Application::$current->getAppFolder()->getFile('/Monology/Queries/MessageCreationQuery.sql');
            $c = $this->pdo->prepare($file->readText());
            $c->bindValue(':1', $userId);
            $c->bindValue(':2', $createdAt->format(\DateTime::ATOM));
            $c->bindValue(':3', $body);
            $c->execute();

            if($c->errorCode() != 00000)
            {
                $error = $c->errorInfo();
                throw new \Exception($error[2], $error[0]);
            }
        }

        public function delete(string $userId, string $statusId)
        {
            
        }
    }
}

?>