<div class="register-modal">
</div>

<div class="register-modal-wrap">
  <div class="register-modal-content">
    <div class="register-modal-content-wrap">
      <div class="close">×</div>
      <?= $this->Form->create($user,['url'=>['controller'=>'Users','action'=>'add']]) ?>
      <fieldset>
        <legend><?= __('Add User') ?></legend>
        <?php
          echo $this->Form->control('name');
          echo $this->Form->control('email');
          echo $this->Form->control('password');
        ?>
      </fieldset>
      <?= $this->Form->button(__('Submit')) ?>
      <?= $this->Form->end() ?>
    </div>
  </div>
</div>