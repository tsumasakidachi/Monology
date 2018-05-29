<?php

namespace Monology\Services
{
    use Stage\Data;
    use Monology\Models;
    use Monology\Services;

    class TwitterTimelineService implements Services\ITimelineService
    {
        private $twitterService;

        function __construct(Services\ITwitterServiceProxy $ts)
        {
            $this->twitterService = $ts;
        }
        
        public function getTimeline(array $params) : array
        {
            $rows = $this->twitterService->get('statuses/home_timeline', ['count' => 200]);
            $result = [];

            foreach($rows as $r)
            {
                $m = new Models\Status();
                $m->number = $r->id;
                $m->body = $r->text;
                $m->createdTime = new \DateTime($r->created_at);
                $m->createdTime->setTimeZone(new \DateTimeZone('Asia/Tokyo'));
                $m->createdTimeString = $m->createdTime->format(Data\Text::$dateTime);
                $m->displayName = $r->user->name;
                $m->userId = $r->user->screenName;
                
                $result[] = $m;
            }

            return $result;
        }

        public function getStatus(string $statusId) : Models\Status
        {
            return new Models\Status();
        }

        public function createStatus(string $body) : void
        {
            if(empty($body)) throw new \InvalidArgumentException('body');

            $this->twitterService->post('statuses/update', ['status' => $body]);
        }

        public function deleteStatus(string $statusId) : void
        {
            if(empty($statusId)) throw new \InvalidArgumentException('body');

            $this->twitterService->post('statuses/destroy/' . $statusId, []);
        }

    }
}

?>