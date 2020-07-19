<table class="table table-bordered table-striped table-hover">
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
      <td><?= $item->year . '/' . $item->month . '/' . $item->date ?></td>
      <td><?= $item->from_time . ' ~ ' . $item->to_time ?></td>
      <td><?= $item->name ?></td>
      <td><?= $item->amount ?></td>
      <td><?= $item->place ?></td>
      <td>
      <?php
      if ($item->remain === 'on') {
        echo '◯';
      } else {
        echo '×';
      }
      ?>
      </td>
      <td>
      <a class="btn btn-primary" href="#" role="button">検討リストへ</a><br>
      <a class="btn btn-danger" href="#" role="button">お申し込み</a>
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