<div class="container search-box">
  <div class="row">
    <?= $this->Form->create($entity,['type'=>'get','url'=>['action'=>'search']]) ?>
    <span class="col-4">研修名：<?= $this->Form->text('name') ?></span>

    <span class="col-4">
    開催地：<?= $this->Form->select('place',
            ['北海道'=>'北海道','青森'=>'青森','岩手'=>'岩手','秋田'=>'秋田','宮城'=>'宮城','山形'=>'山形','福島'=>'福島','新潟'=>'新潟','栃木'=>'栃木','茨城'=>'茨城','群馬'=>'群馬','東京'=>'東京','埼玉'=>'埼玉','神奈川'=>'神奈川','千葉'=>'千葉','山梨'=>'山梨','静岡'=>'静岡','愛知'=>'愛知','岐阜'=>'岐阜','石川'=>'石川','富山'=>'富山','福井'=>'福井','長野'=>'長野','三重'=>'三重','京都'=>'京都','和歌山'=>'和歌山','奈良'=>'奈良','大阪'=>'大阪','兵庫'=>'兵庫','山口'=>'山口','岡山'=>'岡山','鳥取'=>'鳥取','島根'=>'島根','広島'=>'広島','香川'=>'香川','高知'=>'高知','愛媛'=>'愛媛','徳島'=>'徳島','福岡'=>'福岡','長崎'=>'長崎','佐賀'=>'佐賀','大分'=>'大分','宮崎'=>'宮崎','熊本'=>'熊本','鹿児島'=>'鹿児島','沖縄'=>'沖縄'],['empty'=>'項目を選んでください']) ?>
    </span>

    <span class="col-4">
    開催日：<?= $this->Form->text('from_date',['class'=>'datepicker']) ?> ~
            <?= $this->Form->text('to_date',['class'=>'datepicker']) ?>
    </span>
  </div>
  <div class="row search-box-submit justify-content-end">
    <div class="col-1 text-right">
      <?= $this->Form->submit('検索',['class'=>'btn btn-primary']) ?>
      <?= $this->Form->end() ?>
    </div>
    <div class="col-2 text-left">
      <?= $this->Html->link('リセット','/seminars',['class'=>'btn btn-info']) ?>
    </div>
  </div>
</div>

<table class="table table-bordered table-striped table-hover seminar-index-table">
  <thead>
    <tr>
      <th scope="col">開催日</th>
      <th scope="col">時間</th>
      <th scope="col">研修名</th>
      <th scope="col">受講料</th>
      <th scope="col">開催地</th>
      <th scope="col">残り席</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($seminars as $item) : ?>
    <tr>
      <?php
      $date = explode("/",$item->date);
      $date = $date[2] . '/' . $date[0] . '/' . $date[1];
      ?>
      <input type="hidden" class="seminar-id" value="<?= $item->id ?>">
      <td class="date"><?= 20 . $date ?></td>
      <td class="time"><?= $item->from_time . ' ~ ' . $item->to_time ?></td>
      <td class="name"><?= $item->name ?></td>
      <td class="amount"><?= $this->Number->format($item->amount,['after'=>'円']) ?></td>
      <td class="place"><?= $item->place ?></td>
      <?php
      if ($item->remain === 'on') {
        echo '<td class="remain">◯</td>';
      } else {
        echo '<td class="remain">×</td>';
      }
      ?>
      <td>

      <!-- 申し込み済かどうか判定 -->
      <?php if (in_array($item->id,$order_seminars)) : ?>
        <!-- 申し込み済であれば、申し込み済ボタンのみ表示 -->
        <button class="btn btn-dark" style="opacity:0.4;">申し込み済</button>
      <?php else : ?>
        <!-- 申し込み済でなければ、検討リストボタンを表示する -->
        <?php if (in_array($item->id,$login_seminars)) : ?>
          <!-- 検討リスト追加済であれば、検討リスト追加済のボタンを表示する -->
          <button class="btn btn-dark" style="opacity:0.4;">検討追加済み</button><br>
        <?php else : ?>
          <button class="btn btn-primary consider-btn">検討リストへ</button><br>
        <?php endif; ?>

        <button class="btn btn-danger order">お申し込み</button>
      <?php endif; ?>

      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<div class="paginator">
  <ul class="pagination justify-content-center">
      <?= $this->Paginator->first(' << first ') ?>
      <?= $this->Paginator->prev(' < prev ') ?>
      <?= $this->Paginator->numbers() ?>
      <?= $this->Paginator->next(' next > ') ?>
      <?= $this->Paginator->last(' last >> ') ?>
  </ul>
</div>