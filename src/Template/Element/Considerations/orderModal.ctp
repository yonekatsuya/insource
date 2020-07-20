<div class="consideration-order-modal">
</div>

<div class="consideration-order-modal-wrap">
  <div class="consideration-order-modal-content">
    <div class="consideration-order-modal-content-wrap">
      <div class="close">×</div>
      <div class="title">
        お申し込み確認
      </div>
      <?= $this->Form->create($order,['url'=>['controller'=>'Orders','action'=>'store']]) ?>
      <?= $this->Form->hidden('consideration-flag',['value'=>'flag','class'=>'consideration-flag']) ?>
      <?= $this->Form->hidden('consideration-order-id',['value'=>'','class'=>'consideration-order-id']) ?>
      <div class="consideration-seminar-name">研修名：<span></span></div>
      <div class="consideration-seminar-date">日付：<span></span></div>
      <div class="consideration-seminar-time">時間：<span></span></div>
      <div class="consideration-seminar-amount">料金：<span></span></div>
      <div class="consideration-seminar-place">場所：<span></span></div>
      <div class="consideration-seminar-remain">残り席：<span></span></div>
      <?= $this->Form->button('Submit') ?>
      <?= $this->Form->end() ?>
    </div>
  </div>
</div>