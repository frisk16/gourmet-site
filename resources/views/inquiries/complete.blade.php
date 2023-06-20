@extends('layouts.app')

@section('title')
{{ config('app.name', 'Laravel') }} | 送信完了
@endsection

@section('content')

@auth
    @include('layouts.phone_aside')
@endauth

<div class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="{{ asset('img/top.jpg') }}" class="carousel-img">
            <div class="carousel-caption mb-5">
                <h2 class="title inquiry-title text-dark">Gourmet Site</h2>
            </div>
        </div>
    </div>
</div>

<div class="container">

    @include('messages.message')

    <div class="row">
        <div class="col-12 col-lg-9 mx-auto">
            <div class="card">
                <div class="card-header">
                    問い合わせ完了
                </div>
                <div class="card-body">
                    <div class="row my-5">
                        <h5 class="text-center">
                            <i class="fa-3x fa-regular fa-envelope"></i>
                            <p class="mt-3">問い合わせが完了しました。</p>
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
