@extends('layouts.app')

@section('title')
    {{ config('app.name', 'Laravel') }} | パスワード変更
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
                <form action="{{ route('mypage.update_password') }}" method="post">
                    @csrf
                    @method('patch')
                    <div class="card-body">
                        <div class="row my-4">
                            <div class="col-12 col-lg-7 mx-auto">
                                <h6 class="title">パスワード変更</h6>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="current_password" class="col-12 col-lg-7 mx-auto">
                                現在のパスワード
                            </label>
                            <div class="col-12 col-lg-7 mx-auto">
                                <input type="password" name="current_password" id="current_password"
                                class="form-control @if(session('error_password')) is-invalid @endif" placeholder="現在設定中のパスワード" required>

                                @if(session('error_password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ session('error_password') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="password" class="col-12 col-lg-7 mx-auto">
                                新しいパスワード
                            </label>
                            <div class="col-12 col-lg-7 mx-auto">
                                <input type="password" name="password" id="password"
                                class="form-control @error('password') is-invalid @enderror" placeholder="最低8文字以上" required>

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="password_confirmation" class="col-12 col-lg-7 mx-auto">
                                確認用に再度入力
                            </label>
                            <div class="col-12 col-lg-7 mx-auto">
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                class="form-control" placeholder="最低8文字以上" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12 col-lg-7 mx-auto text-end">
                                <button type="submit" class="btn btn-outline-primary">変更</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
