<div class="back-ground"></div>

<div class="phone-aside">
    <div class="row">
        <div class="col-12 text-end mb-3">
            <div id="aside-close-btn">
                <i class="fa-solid fa-backward"></i>
                閉じる
            </div>
        </div>
        <div class="col-12">
            <h6 class="text-center">料理の種類</h6>
            <hr>
        </div>
        <div class="col-10 mx-auto mb-5">
            <ul>
                @foreach(App\Models\Category::all() as $category)
                <li>
                    <a href="{{ route('stores.index', ['category_id' => $category->id]) }}"
                    @if(request()->category_id == $category->id)
                    class="text-primary"
                    @endif
                    >
                        {{ $category->name }} ({{ $category->stores()->count() }})
                        @if(request()->category_id == $category->id)
                            &raquo;
                        @endif
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
        <div class="col-12">
            <h6 class="text-center">予算で検索</h6>
            <hr>
            <form action="{{ route('stores.search_budget') }}" method="get" class="budget mb-3">
                <div class="d-flex">
                    <select name="people" id="people" class="form-control">
                        @for($i = 1; $i <= 10; $i++)
                            <option value="{{ $i }}">{{ $i }}人</option>
                        @endfor
                    </select>
                    <input type="number" name="budget" id="budget" placeholder="予算額で検索" pattern="^[0-9]+$" required
                    class="form-control @error('budget') is-invalid @enderror">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </div>
                @error('budget')
                    <span class="budget-error-msg">
                        {{ $message }}
                    </span>
                @enderror
            </form>
        </div>
    </div>
</div>
