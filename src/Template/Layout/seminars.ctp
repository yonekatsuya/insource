<!DOCTYPE html>
<html lang="ja">
<head>
  <?= $this->Html->charset() ?>
  <title>
    <?= $this->fetch('title') ?>
  </title>
  <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
  <?php
  echo $this->Html->css('bootstrap.min.css');
  echo $this->Html->css('main.css');
  echo $this->fetch('meta');
  echo $this->fetch('css');
  echo $this->fetch('script');
  ?>
</head>
<body>
  <header class="header">
    <div class="container">
      <div class="row justify-content-between">
        <div class="align-self-end">
          <?= $this->Html->link('研修管理システム','/seminars',['class'=>'header-title']) ?>
        </div>
        <div>
          <?php if ($this->request->getSession()->read('Auth.User')) : ?>
            <?= $this->Html->link('申し込み一覧','/orders/index',['class'=>'btn btn-info']) ?>
            <button class="btn btn-primary logout" data-toggle="modal" data-target="#testModal">ログアウト</button>
          <?php else : ?>
            <button class="btn btn-info register">新規登録</button>
            <button class="btn btn-primary login">ログイン</button>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </header>

  <div class="bg-warning text-center"><?= $this->Flash->render() ?></div>

  <div class="container">
    <div class="content">
      <?= $this->fetch('content') ?>
    </div>
  </div>

  <?= $this->element('Seminars/registerModal') ?>
  <?= $this->element('Seminars/loginModal') ?>

  <?= $this->element('Seminars/logoutModal') ?>

  <?= $this->element('Orders/orderModal') ?>
  <?= $this->element('Orders/cancelModal') ?>;

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <?php
  echo $this->Html->script('bootstrap.bundle.min.js');
  echo $this->Html->script('main.js');
  ?>
</body>
</html>