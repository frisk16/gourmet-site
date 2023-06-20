@extends('layouts.app')

@push('scripts')
<script src="https://js.stripe.com/v3/"></script>
<script src="{{ asset('js/subscription.js') }}"></script>
@endpush

@section('title')
{{ config('app.name', 'Laravel') }} | 有料会員登録
@endsection

@section('content')

@include('layouts.phone_aside')

<div class="back-ground"></div>
<div class="loading"></div>

<div class="container mt-5">
    <div class="row">
        <div class="col-12 col-lg-9 mx-auto">
            <h6 class="title">クレジットカードでの契約</h6>
            <p class="text-danger">※有料会員では月額￥300円の支払いが発生します。</p>
            <div class="card mt-3">
                <div class="card-header">
                    カード情報追加
                </div>

                @if(Auth::user()->delete_flag)
                <div class="card-body">
                    <h5 class="text-center my-5">
                        <i class="fa-3x fa-solid fa-user-slash"></i>
                        <p class="mt-3">有料会員解約後、１ヶ月以内は登録が行えません</p>
                    </h5>
                </div>
                @else
                <form id="setup-form">
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
                                <p>※1回だけクリックしてください。</p>
                                <button id="card-button" data-secret="{{ $intent->client_secret }}" class="btn btn-outline-info">カード情報を追加</button>
                            </div>
                        </div>
                    </div>
                </form>
                <form action="{{ route('mypage.store_subscribe') }}" method="post" name="store_subscribe_form">
                    @csrf
                    <input type="hidden" name="paymentMethodId" value="">
                </form>
                @endif

            </div>
        </div>
    </div>
</div>
@endsection
