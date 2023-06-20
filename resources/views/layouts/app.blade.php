<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://npmcdn.com/flatpickr/dist/themes/material_blue.css">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <script src="https://kit.fontawesome.com/f1526c5005.js" crossorigin="anonymous"></script>
    <script src="https://npmcdn.com/flatpickr/dist/flatpickr.min.js"></script>
    <script src="https://npmcdn.com/flatpickr/dist/l10n/ja.js"></script>
</head>

@auth
    @if(Auth::user()->delete_flag)
    <?php
        $user = Auth::user();
        $delete_date = strtotime($user->delete_date);
        $current_date = strtotime(date(now()));
        $next_month = strtotime($user->delete_date.'+1 month');

        if($user->paid_flag) {
            if($delete_date <= $current_date) {
                $user->paid_flag = false;
                $user->update();
                if($next_month <= $current_date) {
                    $user->delete_flag = false;
                    $user->delete_date = '';
                    $user->update();
                }
            }
        } else {
            if($next_month <= $current_date) {
                $user->delete_flag = false;
                $user->delete_date = '';
                $user->update();
            }
        }
    ?>
    @endif
@endauth

<body>
    <div id="app">
        @include('layouts.header')

        <main class="py-4 mt-5">
            @yield('content')
        </main>
    </div>

    @stack('scripts')
    <script>
        const openBtn = document.getElementById('aside-open-btn');
        const closeBtn = document.getElementById('aside-close-btn');
        const aside = document.querySelector('.phone-aside');
        const bg = document.querySelector('.back-ground');
        const asideWidth = aside.clientWidth;

        openBtn.addEventListener('click', e => {
            e.preventDefault();
            bg.style.display = 'block';
            aside.style.transform = 'translateX(0)';
        });

        bg.addEventListener('click', () => {
            bg.style.display = 'none';
            aside.style.transform = `translateX(-${asideWidth}px)`;
        });

        closeBtn.addEventListener('click', () => {
            bg.style.display = 'none';
            aside.style.transform = `translateX(-${asideWidth}px)`;
        });
    </script>
</body>
</html>
