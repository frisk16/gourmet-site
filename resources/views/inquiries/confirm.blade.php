@extends('layouts.app')

@section('title')
{{ config('app.name', 'Laravel') }} | 入力確認
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
    <div class="row">
        <div class="col-12 col-lg-9 mx-auto">
            <div class="card">
                <div class="card-header">
                    入力内容の確認
                </div>
                <div class="card-body">
                    <form action="{{ route('inquiries.store') }}" method="post">
                        @csrf
                        <div class="row mb-3">
                            <label class="col-11 col-md-9 col-form-label mx-auto">
                                お名前
                            </label>
                            <div class="col-11 col-md-9 mx-auto">
                                <strong class="text-warning">{{ request()->name }}</strong>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-11 col-md-9 col-form-label mx-auto">
                                {{ __('Email') }}
                            </label>
                            <div class="col-11 col-md-9 mx-auto">
                                <strong class="text-warning">{{ request()->email }}</strong>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-11 col-md-9 col-form-label mx-auto">
                                {{ __('Type') }}
                            </label>
                            <div class="col-11 col-md-9 mx-auto">
                                <strong class="text-warning">{{ request()->type }}</strong>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-11 col-md-9 col-form-label mx-auto">
                                {{ __('Title') }}
                            </label>
                            <div class="col-11 col-md-9 mx-auto">
                                <strong class="text-warning">{{ request()->title }}</strong>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-11 col-md-9 col-form-label mx-auto">
                                {{ __('Content') }}
                            </label>
                            <div class="col-11 col-md-9 mx-auto">
                                <strong class="text-warning">{!! nl2br(request()->content) !!}</strong>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-11 col-md-9 mx-auto">
                                <p>※上記の内容でお間違えなければ以下の送信ボタンをクリックしてください。</p>

                                <input type="hidden" name="name" value="{{ request()->name }}">
                                <input type="hidden" name="email" value="{{ request()->email }}">
                                <input type="hidden" name="type" value="{{ request()->type }}">
                                <input type="hidden" name="title" value="{{ request()->title }}">
                                <input type="hidden" name="content" value="{{ request()->content }}">

                                <button type="submit" class="btn btn-outline-info">送信</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
