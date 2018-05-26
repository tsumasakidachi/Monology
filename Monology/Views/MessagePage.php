<?php

namespace Monology\Views
{
    use Stage\System;
    use Stage\Pattern\Wire;
    use Stage\Controls;
    use Stage\Data;

    class MessagePage extends Wire\LayoutAwarePage
    {
        public function __construct()
        {
            $this->initializeComponent(__FILE__);
        }

        /*
        protected function content()
        {
            if($_POST['command'] == 'MessageCreation')
            {
                $body = $_POST['body'];

                if(!empty($body))
                {
                    $this->dataContext->post($body);
                }

                $this->relocateInternal(System\Application::$current->settings['BaseUri']);
            }

?>
<article id="content">
<?php if($this->dataContext->auth->isAuthorized) { ?>
<form id="sendingMessage" method="post" action="./">
<p><input type="hidden" id="mode" name="command" value="MessageCreation"></p>
<p id="submit"><textarea id="body" name="body" cols="60" rows="4"></textarea><button type="submit">送信</button></p>
</form>
<?php } ?>
<div class="listView messagesView">
<p><a href="./test/">テスト</a></p>
<?php foreach($this->dataContext->messages as $msg) { ?>
<div class="messagesViewItem">
<p class="createdTime"><?= self::h($msg->displayName) ?> <span title="<?= self::h($msg->createdTime->format(Data\Text::$dateTime)) ?>"><?= self::h(Data\Text::dateTime($msg->createdTime->getTimestamp(), TRUE, TRUE)) ?></span></p>
<p class="body"><?= self::nltobr(self::h($msg->body)) ?></p>
</div>
<?php } ?>
</div>
</article>
<?php
        }
        */

        protected function onRenderHeader()
        {
            $this->loadTemplate('./Monology/Templates/HeaderTemplate.php');
        }

        protected function onRenderFooter()
        {
            $this->loadTemplate('./Monology/Templates/FooterTemplate.php');
        }
    }
}

?>