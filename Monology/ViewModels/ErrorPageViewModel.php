<?php
    
namespace Monology\ViewModels
{
    use Stage\Pattern\Wire;

    class ErrorPageViewModel extends Wire\ViewModel
    {
        public function onRequested(Array $state)
        {
            $this->code = !empty($state['code']) ? $state['code'] : null;
            $this->exception = !empty($state['exception']) ? $state['exception'] : null;

            switch($this->code)
            {
                case '401':
                    $this->httpHeader = 'HTTP/1.1 401 Authorization Required';
                    $this->title = 'Authorization Required';
                    $this->message = 'このページを閲覧するには認証が必要です。';
                    break;
                /*
                case '403':
                    $this->httpHeader = 'HTTP/1.1 403 Forbidden';
                    $this->title = 'ページを表示できません';
                    $this->message = 'ページが存在しないか、非公開です。';
                    break;
                */
                case '403':
                case '404':
                    $this->httpHeader = 'HTTP/1.1 404 Not Found';
                    $this->title = 'ページを表示できません';
                    $this->message = 'ページが存在しないか、非公開です。';
                    break;
                case '500':
                default:
                    $this->httpHeader = 'HTTP/1.1 500 Internal Server Error';
                    $this->title = 'Internal Server Error';
                    $this->message = 'サーバ内部エラーによって処理が中断されました。';
            }
        }

        public $httpHeader;
        public $code;
        public $title;
        public $message;
        public $exception;
    }
}

?>