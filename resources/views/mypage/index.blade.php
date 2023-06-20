@extends('layouts.app')

@section('title')
{{ config('app.name', 'Laravel') }} | マイページ
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
                            <span class="text-danger">（{{ date('Y/m/d', strtotime(Auth::user()->delete_date.'-1 day')) }} まで）</span>
                            @endif
                        </strong>
                    @else
                        <strong>無料会員</strong>
                    @endif
                </div>
                <div class="card-body">
                    <a href="{{ route('mypage.edit') }}" class="mypage_link">
                        <div class="row mb-5">
                            <div class="col-3 text-end my-auto">
                                <i class="fa-3x fa-solid fa-user-pen"></i>
                            </div>
                            <div class="col-7">
                                <div class="row">
                                    <div class="col-12 mb-3 border-bottom border-info">
                                        <strong>会員情報の変更</strong>
                                    </div>
                                    <div class="col-12">
                                        <p>ユーザー名、Eメールアドレス、お住まいの地域、電話番号の変更</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="{{ route('mypage.edit_password') }}" class="mypage_link">
                        <div class="row mb-5">
                            <div class="col-3 text-end my-auto pe-4">
                                <i class="fa-3x fa-solid fa-key"></i>
                            </div>
                            <div class="col-7">
                                <div class="row">
                                    <div class="col-12 mb-3 border-bottom border-info">
                                        <strong>パスワード変更</strong>
                                    </div>
                                    <div class="col-12">
                                        <p>設定中のパスワードを変更</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>

                    @if(Auth::user()->paid_flag)

                    <a href="{{ route('mypage.show_credit') }}" class="mypage_link">
                        <div class="row mb-5">
                            <div class="col-3 text-end my-auto pe-4">
                                <i class="fa-3x fa-solid fa-credit-card"></i>
                            </div>
                            <div class="col-7">
                                <div class="row">
                                    <div class="col-12 mb-3 border-bottom border-info">
                                        <strong>クレジットカード登録情報</strong>
                                    </div>
                                    <div class="col-12">
                                        <p>クレジットカードデータ照会</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="{{ route('reserves.index') }}" class="mypage_link">
                        <div class="row mb-5">
                            <div class="col-3 text-end my-auto pe-4">
                                <i class="fa-3x fa-regular fa-calendar-days"></i>
                            </div>
                            <div class="col-7">
                                <div class="row">
                                    <div class="col-12 mb-3 border-bottom border-info">
                                        <strong>予約履歴</strong>
                                    </div>
                                    <div class="col-12">
                                        <p>履歴照会、予約キャンセル</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>

                    @else

                    <a href="{{ route('mypage.subscription') }}" class="mypage_link">
                        <div class="row mb-5">
                            <div class="col-3 text-end my-auto">
                                <i class="fa-3x fa-solid fa-comments-dollar"></i>
                            </div>
                            <div class="col-7">
                                <div class="row">
                                    <div class="col-12 mb-3 border-bottom border-info">
                                        <strong>有料会員へのアップグレード</strong>
                                    </div>
                                    <div class="col-12">
                                        <p>クレジットカードの登録必須</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>

                    @endif

                    <a href="" data-bs-toggle="modal" data-bs-target="#logoutModal" class="mypage_link">
                        <div class="row mb-5">
                            <div class="col-3 text-end my-auto pe-4">
                                <i class="fa-3x fa-solid fa-right-from-bracket"></i>
                            </div>
                            <div class="col-7">
                                <div class="row">
                                    <div class="col-12 mb-3 border-bottom border-info">
                                        <strong>ログアウト</strong>
                                    </div>
                                    <div class="col-12">
                                        <p>ログインページへ戻ります</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    @include('modals.logout_modal')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
