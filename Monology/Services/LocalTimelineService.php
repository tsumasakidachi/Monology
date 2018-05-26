<?php

namespace Monology\Services
{
    use Stage\Data;
    use Stage\Auth;
    use Monology\Models;
    use Monology\Repositories;

    class LocalTimelineService implements ITimelineService
    {
        private $auth;
        private $timelineRepository;

        public function __construct(Auth\IAuthenticationService $auth, Repositories\TimelineRepository $tr)
        {
            $this->auth = $auth;
            $this->timelineRepository = $tr;
        }

        public function getTimeline(array $options) : array
        {
            if(!$this->auth->isAuthorized) throw new \ErrorException("ログインしていません");

            $statuses = [];
            
            foreach($this->timelineRepository->getAll() as $r)
            {
                $s = new Models\Status($r);
                $s->number = $r['id'];
                $s->body = $r['body'];
                $s->createdTime = new \DateTime($r['created_time']);
                $s->createdTimeString = $s->createdTime->format(Data\Text::$dateTime);
                $s->displayName = $r['display_name'];
                $s->userId = $r['user_id'];
                $statuses[] = $s;
            }

            return $statuses;
        }

        public function getStatus(string $statusId): Models\Status
        {
            throw new \InvalidMethodCallException('LocalTimelineService::getStatus');
        }

        public function createStatus(string $body) : void
        {
            if(!$this->auth->isAuthorized) throw new \ErrorException("ログインしていません");
            if(empty($body)) throw new \InvalidArgmentException('本文が空です');
            if(mb_strlen($body) > 200) throw new \ErrorExeption("本文が長すぎます");

            $userId = $this->auth->currentUser->number;
            $body = Data\Text::unifyLineBreak($body);
            $createdAt = new \DateTime();

            $this->timelineRepository->save($userId, $createdAt, $body);
        }

        public function deleteStatus(string $statusId) : void
        {
            throw new \InvalidMethodCallException('LocalTimelineService::deleteStatus');
        }
    }
}