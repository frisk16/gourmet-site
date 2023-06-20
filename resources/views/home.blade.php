@extends('layouts.app')

@section('title')
{{ config('app.name', 'Laravel') }} | トップページ
@endsection

@section('content')

@include('layouts.phone_aside')

<div class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="{{ asset('img/top.jpg') }}" class="carousel-img">
            <div class="carousel-caption mb-5">
                <h1 class="title top-title text-dark">Gourmet Site</h1>
            </div>
        </div>
    </div>
</div>

<div class="container mt-3">
    @include('messages.message')
    <div class="row">
        @include('layouts.aside')

        <div class="col-12 col-lg-9">
            <div class="card mb-5">
                <div class="card-header">
                    新店舗情報
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach($new_stores as $store)
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
            </div>
            <div class="card">
                <div class="card-header">
                    人気店舗情報
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach($pop_stores as $store)
                        <div class="col-6 col-lg-3 mb-5">

                            <a href="{{ route('stores.show', $store['id']) }}">
                                @if($store['image'])
                                <img src="{{ asset($store['image']) }}" class="img-fluid">
                                @else
                                <img src="{{ asset('img/dummy.png') }}" class="img-fluid">
                                @endif
                            </a>

                            <p class="ps-2">{{ $store['name'] }}</p>
                            <div class="score-area">
                                <span class="back-score">{{ str_repeat('★', 5) }}</span>
                                <span class="ave-score" style="width: {{ $store['ave'] * 20 }}%">{{ str_repeat('★', 5) }}</span>
                                <strong class="count-score">（{{ $store['count'] }}）</strong>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
