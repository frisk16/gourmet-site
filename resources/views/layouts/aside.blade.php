<aside class="d-none d-lg-block col-lg-3">
    <div class="card">
        <div class="card-header">
            料理の種類から絞り込む
        </div>
        <div class="card-body">
            <ul class="ms-3">
                @foreach(App\Models\Category::all() as $category)
                <li>
                    <a href="{{ route('stores.index', ['category_id' => $category->id]) }}"
                    @if(request()->category_id == $category->id)
                    class="text-info text-decoration-underline"
                    @endif
                    >
                        {{ $category->name }} ({{ $category->stores()->count() }})
                        @if(request()->category_id == $category->id)
                        &raquo; &raquo;
                        @endif
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
        <div class="card-header border-top">
            予算から絞り込む
        </div>
        <div class="card-body">
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
</aside>
