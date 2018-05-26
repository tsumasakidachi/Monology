<?php
    
namespace Monology\ViewModels
{
    use Stage\Pattern\Wire;
    use Stage\Data;
    use Monology\Services;
    use Monology\Models;

    class TimelinePageViewModel extends Wire\AuthViewModel
    {
        private $timelineService;

        public function __construct(\Stage\Auth\IAuthenticationService $auth, Services\ITimelineService $mr)
        {
            parent::__construct($auth);
            $this->timelineService = $mr;
        }

        public function onRequested(Array $states)
        {
            if($this->auth->isAuthorized)
            {
                $this->refreshHomeTimeline();

                /*
                for($i = 0; $i < 5000; $i++)
                {
                    $this->messages[] = new Models\Message([
                        'number' => $i,
                        'body' => $this->test,
                        'created_time' => '2018-02-17 00:00:00',
                        'display_name' => '園田',
                        'user_id' => 'sonoda'
                    ]);
                }
                */
            }
        }

        #region properties

        public $messages = [];

        #endregion

        #region timeline

        public function refreshHomeTimeline()
        {
            $this->messages = $this->timelineService->getTimeline([]);
        }

        #endregion
    }
}

?>