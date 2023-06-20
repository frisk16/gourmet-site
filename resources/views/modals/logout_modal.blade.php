<div class="modal fade" id="logoutModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                ログアウト
            </div>
            <form action="{{ route('logout') }}" method="post">
                @csrf
                <div class="modal-body">
                    <p>ログアウトしますか？</p>
                </div>
                <div class="modal-footer">
                    <span class="btn btn-secondary" data-bs-dismiss="modal">閉じる</span>
                    <button type="submit" class="btn btn-danger">ログアウト</button>
                </div>
            </form>
        </div>
    </div>
</div>
