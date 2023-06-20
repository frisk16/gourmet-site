@extends('layouts.app')

@section('title')
{{ config('app.name', 'Laravel') }} | クレジットカード照会
@endsection

@push('scripts')
<script src="https://js.stripe.com/v3/"></script>
<script src="{{ asset('js/updateSubscription.js') }}"></script>
@endpush

@section('content')

@include('layouts.phone_aside')

<div class="back-ground"></div>
<div class="loading"></div>

<div class="container mt-5">
    @include('messages.message')
    <div class="row">
        <div class="col-12 col-lg-9 mx-auto">
            <div class="card mb-3">
                <div class="card-header">
                    登録中のクレジットカード
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-lg-4">
                            カード会社：<strong>{{ $card->brand }}</strong>
                        </div>
                        <div class="col-12 col-lg-4">
                            番号：<strong>{{ str_repeat('*', 12).$card->last4 }}</strong>
                        </div>
                        <div class="col-12 col-lg-4">
                            期限：<strong>{{ $card->exp_year }}年 / {{ $card->exp_month }}月</strong>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header">
                    登録中のプラン：有料会員
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-lg-4">
                            登録日：<strong>{{ $created_sub }}</strong>
                        </div>
                        <div class="col-12 col-lg-4">
                            月額料金：<strong class="text-warning">￥300 円支払い</strong>
                        </div>
                        <div class="col-12 col-lg-4">
                            次回の支払い日：
                            <strong>
                                @if(Auth::user()->delete_flag)
                                なし
                                @else
                                {{ $next_payment }}
                                @endif
                            </strong>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    カード情報変更
                </div>
                <div class="card-body credit-form">
                    <form action="{{ route('mypage.update_credit') }}" method="post" name="submitForm">
                        @csrf
                        @method('patch')
                        <input type="hidden" name="paymentMethodId" value="">
                        <div class="card-body">
                            <div class="row mb-3">
                                <label for="card-holder-name" class="col-12 col-lg-8 mx-auto">
                                    カード名義人
                                </label>
                                <div class="col-12 col-lg-8 mx-auto">
                                    <input type="text" id="card-holder-name" placeholder="アルファベット" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="card-form" class="col-12 col-lg-8 mx-auto">
                                    カード情報
                                </label>
                                <div class="col-12 col-lg-8 mx-auto">
                                    <div id="card-form" class="border-bottom border-dark"></div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-12 col-lg-8 mx-auto text-end">
                                    <button id="card-button" data-secret="{{ $intent->client_secret }}" class="btn btn-outline-info">
                                        カード情報を変更
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
