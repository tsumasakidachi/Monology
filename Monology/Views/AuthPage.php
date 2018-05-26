<?php

namespace Monology\Views
{
    use Stage\System;
    use Stage\Pattern\Wire;
    use Stage\Controls;
    use Stage\Data;

    class AuthPage extends Wire\LayoutAwarePage
    {
        public function __construct()
        {
            $this->initializeComponent(__FILE__);
        }

        protected function onRenderContent()
        {
?>
<article id="content">
<?php
        switch($this->dataContext->mode)
        {
            case 'logout':
                $this->title = 'ログアウト';
                $this->logout();
                break;
            case 'login':
                $this->title = 'ログイン';
                // if(isset($_COOKIE['isAuthenticate'])) $this->title = 'アカウントの確認が必要です';
                $this->login();
        }
?>
</article>
<?php
        }

        function login()
        {
            /*
            リファラがサイト外ならトップページへ
            */
            $userId = '';
        
            print '<form method="post" action="./" id="login" name="login">'."\n";
            
            print '<h1 class="headerText">'.self::h($this->title).'</h1>'."\n";

            if($_POST['commandName'] == 'login')
            {
                try
                {
                    $userId = (string)$_POST['userId'];
                    $password = (string)$_POST['password'];
                    $isMemory = $_POST['isMemory'] == 'isMemory' ? true : false;
                    $this->dataContext->login($userId, $password, $isMemory);
                    $this->relocate(System\Application::$current->settings['BaseUri']);
                }
                catch(\Exception $e)
                {
                    print '<p class=""error">'.self::h($e->getMessage()).'</p>'."\n";
                }
            }

            // ID ---------------------------------------------------------
            print '<p>';
            print '<input type="text" placeholder="ユーザ ID" id="userId" name="userId" value="';
            
            print self::h($userId);
            
            print '" size="32"';
            
            // OK なら入力禁止にする
            if($result == 'ok') print ' disabled="disabled"';
            
            print 'autofocus="autofocus" required="required">';
            
            print '</p>'."\n";
            
            // パスワード -------------------------------------------------
            print '<p><input type="password" placeholder="パスワード" id="password" name="password" value="" size="32"';
            
            // OK なら入力禁止にする
            if($result == 'ok') print ' disabled="disabled"';
            print ' required="required">';
            
            print '</p>'."\n";
            
            // 保存 -------------------------------------------------------
            print '<p><label for="isMemory"><input type="checkbox" id="isMemory" name="isMemory" value="isMemory"';
            
            // checked
            if(isset($_COOKIE['isMemory']) || isset($_POST['isMemory'])) print ' checked="checked"';
            
            // OK なら入力禁止にする
            if($result == 'ok') print ' disabled="disabled"';
            
            print '> ログインしたままにする</label></p>'."\n";
            
            print '<p id="submit"><button type="submit" name="commandName" value="login">ログイン</button></p>'."\n";
            
            print '<p class="captionText">他人の ID およびパスワードを使ってログインした場合は、不正アクセス行為の禁止等に関する法律により処罰されます。</p>'."\n";
            print '</form>'."\n";
        }
    
        // ログアウト画面
        function logout()
        {
            print '<form method="post" action="./">'."\n";
            
            print '<h1 class="headerText">'.self::h($this->title).'</h1>'."\n";

            if($_POST['commandName'] == 'logout')
            {
                try
                {
                    $this->dataContext->logout();
                    $this->relocate(System\Application::$current->settings['BaseUri']);
                }
                catch(\Exception $e)
                {
                    print '<p class=""error">'.self::h($e->getMessage()).'</p>'."\n";
                }
            }

            print '<p id="submit"><button type="submit" name="commandName" value="logout">ログアウト</button></p>'."\n";
            print '</form>'."\n";
        }

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