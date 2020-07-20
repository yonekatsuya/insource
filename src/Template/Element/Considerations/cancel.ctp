<div class="modal fade" id="testModal3" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4><div class="modal-title" id="myModalLabel">検討リスト削除確認画面</div></h4>
            </div>
            <div class="modal-body">
                <label>本当に検討リストから削除しますか？</label>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
                <?= $this->Form->create($order,['url'=>['controller'=>'Considerations','action'=>'delete']]) ?>
                <?= $this->Form->hidden('consideration-cancel',['value'=>'','class'=>'consideration-cancel']) ?>
                <?= $this->Form->button('はい',['class'=>'btn btn-danger']) ?>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>