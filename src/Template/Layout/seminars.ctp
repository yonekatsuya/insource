<!DOCTYPE html>
<html lang="ja">
<head>
  <?= $this->Html->charset() ?>
  <title>
    <?= $this->fetch('title') ?>
  </title>
  <?php
  echo $this->Html->css('bootstrap.min.css');
  echo $this->Html->css('main.css');
  echo $this->fetch('meta');
  echo $this->fetch('css');
  echo $this->fetch('script');
  ?>
</head>
<body>
  <div class="container">
    <div class="content">
      <?= $this->fetch('content') ?>
    </div>
  </div>

  <?php
  echo $this->Html->script('jquery-3.5.1.slim.min.js');
  echo $this->Html->script('bootstrap.bundle.min.js');
  echo $this->Html->script('main.js');
  ?>
</body>
</html>