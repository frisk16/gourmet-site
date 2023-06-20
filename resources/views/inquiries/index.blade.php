@extends('layouts.app')

@section('title')
{{ config('app.name', 'Laravel') }} | お問い合わせ
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
                    お問い合わせ
                </div>
                <div class="card-body">
                    <form action="{{ route('inquiries.confirm') }}" method="get">
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">
                                お名前
                            </label>
                            <div class="col-md-6">
                                <input type="text" name="name" id="name" required placeholder="10文字以内"
                                value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">
                                {{ __('Email') }}
                            </label>
                            <div class="col-md-6">
                                <input type="email" name="email" id="email" required placeholder="xxxxx@yyyy.zzz"
                                value="{{ old('email') }}" class="form-control">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="type" class="col-md-4 col-form-label text-md-end">
                                {{ __('Type') }}
                            </label>
                            <div class="col-md-6">
                                <select name="type" id="type" required class="form-control">
                                    <option value="">-- 選択 --</option>
                                    <option value="店舗について">店舗について</option>
                                    <option value="支払いについて">支払いについて</option>
                                    <option value="退会手続きについて">退会手続きについて</option>
                                    <option value="その他">その他</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="title" class="col-md-4 col-form-label text-md-end">
                                {{ __('Title') }}
                            </label>
                            <div class="col-md-6">
                                <input type="text" name="title" id="title" required placeholder="30文字以内"
                                class="form-control @error('title') is-invalid @enderror">

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="content" class="col-md-4 col-form-label text-md-end">
                                {{ __('Content') }}
                            </label>
                            <div class="col-md-6">
                                <textarea name="content" id="content" rows="5" required placeholder="10文字以上、1000文字以内"
                                class="form-control @error('content') is-invalid @enderror">{{ old('content') }}</textarea>

                                @error('content')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-10 text-end">
                                <button type="submit" class="btn btn-outline-info">内容の確認</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
