<div class="modal fade" id="cancelModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5>予約キャンセル</h5>
            </div>
            <div class="modal-body">
                <p class="mb-3">以下の店舗の予約をキャンセルします、本当によろしいですか？</p>
                <p>店舗名：<strong id="store_name"></strong></p>
                <p>ご来店日：<strong id="reserve_date"></strong></p>
                <p>ご来店時刻：<strong id="reserve_time"></strong></p>
            </div>
            <div class="modal-footer">
                <form action="" method="post" name="cancelForm">
                    @csrf
                    @method('patch')
                    <span class="btn btn-secondary" data-bs-dismiss="modal">閉じる</span>
                    <button type="submit" class="btn btn-danger">キャンセルする</button>
                </form>
            </div>
        </div>
    </div>
</div>
