@extends('layouts.app')

@section('title')
{{ config('app.name', 'Laravel') }} | 検索結果
@endsection

@section('content')

@include('layouts.phone_aside')

<div class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="{{ asset('img/top.jpg') }}" class="carousel-img">
            <div class="carousel-caption mb-5">
                <h1 class="title search-title text-dark">Gourmet Site</h1>
            </div>
        </div>
    </div>
</div>

<div class="container mt-3">
    <div class="row">
        @include('layouts.aside')

        <div class="col-12 col-lg-9">
            <div class="card mb-5">
                @if($stores->first())
                <div class="card-header">
                    検索結果｜{{ $stores->count() }} 件
                </div>
                <div class="card-body">
                    <div class="row">

                        @foreach($stores as $store)
                        <div class="col-6 col-lg-3 mb-5">
                            <a href="{{ route('stores.show', $store) }}">
                                @if($store->image)
                                <img src="{{ asset($store->image) }}" class="img-fluid">
                                @else
                                <img src="{{ asset('img/dummy.png') }}" class="img-fluid">
                                @endif
                            </a>
                            <p class="ps-2">{{ $store->name }}</p>
                            <div class="score-area">
                                <span class="back-score">{{ str_repeat('★', 5) }}</span>
                                <span class="ave-score" style="width: {{ $store->total_score['ave'] * 20 }}%">{{ str_repeat('★', 5) }}</span>
                                <strong class="count-score">（{{ $store->total_score['count'] }}）</strong>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
                @else

                <div class="card-header">
                    検索結果｜0 件
                </div>
                <div class="card-body">
                    <div class="row">
                        <h5 class="text-center my-5">
                            <i class="fa-3x fa-solid fa-magnifying-glass"></i>
                            <p class="mt-3">お探しの店舗は見つかりませんでした</p>
                        </h5>
                    </div>
                </div>
                @endif

            </div>
        </div>
    </div>
</div>
@endsection
