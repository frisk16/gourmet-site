@extends('layouts.app')

@section('title')
{{ config('app.name', 'Laravel') }} | お気に入り
@endsection

@section('content')

@include('layouts.phone_aside')
<div class="container mt-5">
    <div class="row">
        <div class="col-12 col-lg-9 mx-auto">
            <div class="card">
                <div class="card-header">
                    お気に入り登録数 | {{ $favorites->count() }} 件
                </div>
                <div class="card-body">
                @if($favorites->first())
                    @foreach($favorites as $favorite)
                        <div class="row mb-3">
                            <div class="col-3 my-auto">
                                <a href="{{ route('stores.show', $favorite->store_id) }}">
                                    @if($favorite->store->image)
                                    <img src="{{ asset($favorite->store->image) }}" class="img-fluid">
                                    @else
                                    <img src="{{ asset('img/dummy.png') }}" class="img-fluid">
                                    @endif
                                </a>
                            </div>
                            <div class="col-9 my-auto">
                                <h6 class="border-bottom border-white mb-2">{{ $favorite->name }}</h6>
                                <div class="row">
                                    <div class="col-12 mb-4">
                                        <div class="score-area">
                                            <span class="back-score">{{ str_repeat('★', 5) }}</span>
                                            <span class="ave-score" style="width: {{ $favorite->store()->first()->total_score['ave'] * 20 }}%">{{ str_repeat('★', 5) }}</span>
                                            <strong class="count-score">（{{ $favorite->store()->first()->total_score['count'] }}）</strong>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6 mb-3">
                                        1人あたりの手数料：<strong>￥{{ $favorite->store()->first()->commission }} 円</strong>
                                    </div>
                                    <div class="col-12 col-lg-6 d-flex justify-content-end">
                                        <a href="{{ route('stores.show', $favorite->store_id) }}" class="btn btn-outline-secondary me-2">詳細</a>
                                        <form action="{{ route('favorites.destroy', $favorite->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger">
                                                <i class="fa-solid fa-heart-crack"></i>
                                                お気に入り解除
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <h5 class="text-center my-5 text-secondary">
                        <i class="fa-3x fa-solid fa-star"></i>
                        <p class="mt-3">登録中のお気に入りはありません</p>
                    </h5>
                @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
