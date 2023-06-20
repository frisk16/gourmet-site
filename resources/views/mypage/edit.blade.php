@extends('layouts.app')

@section('title')
{{ config('app.name', 'Laravel') }} | ユーザー情報変更
@endsection

@section('content')

@include('layouts.phone_aside')
<div class="container mt-5">
    @include('messages.message')
    <div class="row">
        <div class="col-12 col-lg-9 mx-auto">
            <div class="card">
                <div class="card-header">
                    会員ステータス：
                    @if(Auth::user()->paid_flag)
                    <strong>
                    有料会員
                        @if(Auth::user()->delete_flag)
                        <span class="text-danger">
                            （{{ date('Y/m/d', strtotime(Auth::user()->delete_date.'-1 day')) }}まで）
                        </span>
                        @endif
                    </strong>
                    @else
                    <strong>無料会員</strong>
                    @endif
                </div>
                <form action="{{ route('mypage.update') }}" method="post">
                    @csrf
                    @method('patch')
                    <div class="card-body">
                        <div class="row my-4">
                            <div class="col-lg-7 mx-auto">
                                <h6 class="title">ユーザー情報変更</h6>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name" class="col-lg-7 col-form-label mx-auto">
                                ユーザー名
                            </label>
                            <div class="col-lg-7 mx-auto">
                                <input type="text" name="name" id="name"
                                class="form-control @error('name') is-invalid @enderror" value="{{ old('name', Auth::user()->name) }}" placeholder="2文字以上10文字以内" required>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="email" class="col-lg-7 col-form-label mx-auto">
                                Eメールアドレス
                            </label>
                            <div class="col-lg-7 mx-auto">
                                <input type="email" name="email" id="email" value="{{ old('email', Auth::user()->email) }}"
                                class="form-control @error('email') is-invalid @enderror" placeholder="xxxxx@yyyy.zzz" required>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="phone" class="col-lg-7 col-form-label mx-auto">
                                電話番号
                            </label>
                            <div class="col-lg-7 mx-auto">
                                <input type="tel" name="phone" id="phone" pattern="[0-9]{2,3}-[0-9]{3,4}-[0-9]{3,4}" value="{{ old('phone', Auth::user()->phone) }}"
                                class="form-control" placeholder="半角ハイフン有り" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="area" class="col-lg-7 col-form-label mx-auto">
                                お住まいの地域
                            </label>
                            <div class="col-lg-7 mx-auto">
                                <select name="area" id="area" class="form-control" required>
                                    @foreach($areas as $area)
                                    <option value="{{ $area }}" @if($area == Auth::user()->area) selected @endif>{{ $area }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="" class="col-lg-7 col-form-label mx-auto">
                                {{ __('Age') }}
                            </label>
                            <div class="col-lg-7 mx-auto">
                                <input type="number" name="age" id="age" required step="1" pattern="^[0-9]+$"
                                class="form-control @error('age') is-invalid @enderror" value="{{ old('age', Auth::user()->age) }}">
                                @error('age')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="job" class="col-lg-7 col-form-label mx-auto">
                                {{ __('Job') }}
                            </label>
                            <div class="col-lg-7 mx-auto">
                                <select name="job" id="job" class="form-control">
                                    @foreach($jobs as $job)
                                    <option value="{{ $job }}" @if($job == Auth::user()->job) selected @endif>{{ $job }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-7 mx-auto text-end">
                                <button type="submit" class="btn btn-outline-info">変更</button>
                            </div>
                        </div>

                        @if(Auth::user()->paid_flag)

                            @if(Auth::user()->delete_flag)
                            <div class="row">
                                <div class="col-lg-7 mx-auto text-end">
                                    <a href="{{ route('mypage.cancel_delete_member') }}" class="text-info fw-bold">有料会員の解約申請取り消し</a>
                                </div>
                            </div>
                            @else
                            <div class="row">
                                <div class="col-lg-7 mx-auto text-end">
                                    <a href="{{ route('mypage.delete_member') }}">有料会員の解約はこちらから &raquo;</a>
                                </div>
                            </div>
                            @endif

                        @endif

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
