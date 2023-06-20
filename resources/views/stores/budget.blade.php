@extends('layouts.app')

@section('title')
{{ config('app.name', 'Laravel') }} | 検索結果
@endsection

@section('content')

@include('layouts.phone_aside')

<div class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <img src="{{ asset('img/top.jpg') }}" class="carousel-img">
        <div class="carousel-caption mb-5">
            <h2 class="title search-title text-dark">
                予算額検索
            </h2>
        </div>
    </div>
</div>

<div class="container mt-3">
    @include('messages.message')
    <div class="row">
        @include('layouts.aside')

        <div class="col-12 col-lg-9">
            <div class="card">
                <div class="card-header">
                    <strong>
                        {{ request()->people }} 人あたり {{ request()->budget }} 円以内
                    </strong>
                    <p>該当店舗｜{{ $stores->count() }} 件</p>
                </div>
                <div class="card-body">
                    <div class="row">

                        @if($stores->first())
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
                        @else
                        <div class="col-12">
                            <h5 class="text-center my-5">
                                <i class="fa-3x fa-solid fa-store"></i>
                                <p class="mt-3">該当する店舗がありません</p>
                            </h5>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
