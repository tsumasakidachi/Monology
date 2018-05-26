<?php
    
namespace Monology\ViewModels
{
    use Stage\Pattern\Wire;
    use Stage\Data;
    use Monology\Repositories;

    class MessagePageViewModel extends Wire\AuthViewModel
    {
        private $MessageRepository;

        public function __construct(\Stage\Auth\Authentication $auth, \Monology\Repositories\MessageRepository $mr)
        {
            parent::__construct($auth);
            $this->MessageRepository = $mr;
        }

        public function onRequested(Array $states)
        {
            if($states['mode'] == 'create')
            {
                $this->post($states['body']);
            }
            else if($states['mode'] == 'delete')
            {
                print $states['number'];
            }
        }

        public function post($body)
        {
            if(empty($body)) throw new \InvalidArgumentException('body');
            $this->MessageRepository->post($body);
        }
    }
}

?>