<div class="modal fade" id="testModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4><div class="modal-title" id="myModalLabel">ログアウト確認画面</div></h4>
            </div>
            <div class="modal-body">
                <label>ログアウトしますか？</label>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
                <?= $this->Html->link('はい','/users/logout',['class'=>'btn btn-danger']) ?>
            </div>
        </div>
    </div>
</div>