<div class="order-modal">
</div>

<div class="order-modal-wrap">
  <div class="order-modal-content">
    <div class="order-modal-content-wrap">
      <div class="close">×</div>
      <div class="title">
        お申し込み確認
      </div>
      <?= $this->Form->create($order,['url'=>['controller'=>'Orders','action'=>'store']]) ?>
      <?= $this->Form->hidden('order-id',['value'=>'','class'=>'order-id']) ?>
      <div class="seminar-name">研修名：<span></span></div>
      <div class="seminar-date">日付：<span></span></div>
      <div class="seminar-time">時間：<span></span></div>
      <div class="seminar-amount">料金：<span></span></div>
      <div class="seminar-place">場所：<span></span></div>
      <div class="seminar-remain">残り席：<span></span></div>
      <?= $this->Form->button('Submit') ?>
      <?= $this->Form->end() ?>
    </div>
  </div>
</div>