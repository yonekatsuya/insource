<h3 class="text-center seminar-order-title">申し込み研修一覧</h3>

<table class="table table-bordered table-striped table-hover">
  <thead>
    <tr>
      <th scope="col">開催日</th>
      <th scope="col">時間</th>
      <th scope="col">研修名</th>
      <th scope="col">受講料</th>
      <th scope="col">開催地</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($orders as $item) : ?>
    <tr>
      <?php
      $date = explode("/",$item[0]->date);
      $date = $date[2] . '/' . $date[0] . '/' . $date[1];
      ?>
      <input type="hidden" class="seminar-id" value="<?= $item[0]->id ?>">
      <td class="date"><?= 20 . $date ?></td>
      <td class="time"><?= $item[0]->from_time . ' ~ ' . $item[0]->to_time ?></td>
      <td class="name"><?= $item[0]->name ?></td>
      <td class="amount"><?= $item[0]->amount ?></td>
      <td class="place"><?= $item[0]->place ?></td>
      <td>
        <button class="btn btn-info seminar-cancel-btn" data-toggle="modal" data-target="#testModal1">キャンセル</button>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>