@extends('layouts.app')

@section('title')
{{ config('app.name', 'Laravel') }} | {{ $category_name }}店一覧
@endsection

@section('content')

@include('layouts.phone_aside')

<div class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            @if(request()->has('category_id'))
            <img src="{{ asset($store_img[request()->category_id]) }}" class="carousel-img">
            @else
            <img src="{{ asset($store_img) }}" class="carousel-img">
            @endif
            <div class="carousel-caption mb-5">
                <h2 class="title category-title text-dark">
                    {{ $category_name }}店系列
                </h2>
            </div>
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
                    {{ $category_name }}店｜{{ $stores_count }} 件
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
