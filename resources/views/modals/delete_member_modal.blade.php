<div class="modal fade" id="deleteMemberModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5>確認</h5>
            </div>
            <div class="modal-body">
                <p>解約申請を行います、本当によろしいですか？</p>
            </div>
            <div class="modal-footer">
                <form action="{{ route('mypage.toggle_delete_flag') }}" method="post">
                    @csrf
                    @method('patch')
                    <span class="btn btn-secondary" data-bs-dismiss="modal">閉じる</span>
                    <button type="submit" class="btn btn-danger">はい</button>
                </form>
            </div>
        </div>
    </div>
</div>
