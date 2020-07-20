<div class="login-modal">
</div>

<div class="login-modal-wrap">
  <div class="login-modal-content">
    <div class="login-modal-content-wrap">
      <div class="close">×</div>
      <?= $this->Form->create() ?>
      <fieldset>
        <legend><?= __('ユーザー名とパスワードを入力してください') ?></legend>
        <?= $this->Form->control('email') ?>
        <?= $this->Form->control('password') ?>
      </fieldset>
      <?= $this->Form->button(__('Login')) ?>
      <?= $this->Form->end() ?>
    </div>
  </div>
</div>