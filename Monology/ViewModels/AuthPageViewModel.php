<?php
    
namespace Monology\ViewModels
{
    use Stage\Pattern\Wire;
    use Monology\Repositories;

    class AuthPageViewModel extends Wire\AuthViewModel
    {
        public function onRequested(Array $params)
        {
            // if($_SERVER['REQUEST_METHOD'] == 'POST')
            {
                switch($params['mode'])
                {
                    case 'logout':
                        $this->mode = 'logout';
                        break;
                    case 'login':
                        $this->mode = 'login';
                        break;
                }
            }
        }

        public function login($id, $password, $isMemory)
        {
            if(empty($id)) throw new \InvalidArgumentException('id');
            if(empty($password)) throw new \InvalidArgumentException('password');
            if(!is_bool($isMemory)) throw new \InvalidArgumentException('isMemory');
            
            $this->auth->login($id, $password, $isMemory);
        }

        public function logout()
        {
            $this->auth->logout();
        }

        public $mode;
    }
}

?>