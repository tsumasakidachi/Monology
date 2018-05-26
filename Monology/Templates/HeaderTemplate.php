<header class="clearfix">
<div class="navigations">
<h1 id="logo"><a href="<?= self::h(Stage\System\Application::$current->settings['BaseUri']); ?>"><?= self::h($this->resources['SiteName']); ?></a></h1>
</div>
<div class="commands">
<ul class="listView horizontal">
<?php if($this->dataContext instanceof \Stage\Pattern\Wire\AuthViewModel) { ?>
<?php if($this->dataContext->auth->isAuthorized) { ?>
<li class="listViewItem"><a href="<?= self::h(Stage\System\Application::$current->settings['BaseUri']); ?>account/" id="accountButton"><?= self::h($this->dataContext->auth->currentUser->displayName); ?></a></li>
<li class="listViewItem"><a href="<?= self::h($this->resources['LogoutPageUri']); ?>" id="logoutButton">ログアウト</a></li>
<?php } else { ?>
<li class="listViewItem"><a href="<?= self::h($this->resources['LoginPageUri']); ?>">ログイン</a></li>
<?php } ?>
<?php } ?>
</ul>
</div>
</header>
