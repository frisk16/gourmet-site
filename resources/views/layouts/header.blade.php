<nav class="navbar navbar-expand-lg navbar-light shadow-sm fixed-top">
    <div class="container">
        <div class="navbar-brand @guest w-auto @endguest">
            <a href="{{ url('/') }}" class="text-dark text-decoration-none">
                {{ config('app.name', 'Laravel') }}
            </a>
        </div>

        @auth
        <form action="{{ route('stores.search') }}" method="get" class="me-auto d-flex">
            <input type="text" name="keyword" id="keyword" class="form-control" placeholder="店舗名で検索" value="@if(request()->has('keyword')) {{ request()->keyword }} @endif" required>
            <button type="submit" class="btn btn-primary" id="search-btn">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </form>
        @endauth

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <i class="fa-solid fa-bars" style="color: #aff;"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif

                    <li class="nav-item">
                        <a href="{{ route('inquiries.index') }}" class="nav-link">
                            お問い合わせ
                        </a>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            ようこそ、{{ Auth::user()->name }} 様
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a href="{{ route('mypage') }}" class="dropdown-item">
                                マイページへ
                            </a>
                            <a href="{{ route('favorites.index') }}" class="dropdown-item">
                                お気に入り一覧
                            </a>
                            <a href="{{ route('inquiries.index') }}" class="dropdown-item">
                                お問い合わせ
                            </a>
                        </div>

                        <a href="" class="nav-link d-lg-none" id="aside-open-btn">
                            <i class="fa-solid fa-store"></i>
                            カテゴリーから探す
                        </a>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
