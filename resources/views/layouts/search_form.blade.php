<div class="mb-3">
    <div class="card">
        <div class="card-header">
            キーワードから検索
        </div>
        <div class="card-body">
            <form action="{{ route('stores.search') }}" method="get">
                <div class="row mb-2 d-lg-none">
                    <span class="ms-2 d-lg-none fw-bold" id="aside-open-btn">
                        <i class="fa-solid fa-folder-minus"></i>
                        絞り込む
                    </span>
                </div>
                <div class="row">
                    <div class="col-3 col-lg-2 mx-auto">
                        <select name="type" id="" class="form-control">
                            <option value="name" selected>店舗名</option>
                            <option value="commission">予算額</option>
                        </select>
                    </div>
                    <div class="col-9 col-lg-8 mx-auto d-flex">
                        <input type="text" name="keyword" id="keyword" class="form-control" placeholder="キーワードを入力" value="@if(request()->has('keyword')) {{ request()->keyword }} @endif" required>
                        <button type="submit" class="btn btn-outline-primary">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
