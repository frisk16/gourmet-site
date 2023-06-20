@extends('layouts.app')

@section('title')
{{ config('app.name', 'Laravel') }} | 予約履歴
@endsection

@push('scripts')
<script src="{{ asset('js/reservesIndex.js') }}"></script>
@endpush

@section('content')

@include('layouts.phone_aside')
<div class="container mt-5">
    @include('messages.message')
    @include('modals.cancel_modal')
    <div class="row">
        <div class="col-12 col-lg-9 mx-auto">
            <h5 class="area-title border-secondary">
                予約履歴｜{{ $reserves->count() }} 件
            </h5>

            @if($reserves->first())
                @foreach($reserves as $reserve)
                <div class="card mb-3">
                    <div class="card-header d-flex">
                        <div>受付日時：{{ $reserve->created_at }}</div>
                        <h5 class="ms-auto">
                            @if($reserve->cancel_flag)
                            <span class="badge bg-danger">キャンセル中</span>
                            @else
                            <span class="badge bg-primary">予約中</span>
                            @endif
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-lg-4">
                                <a href="{{ route('stores.show', $reserve->store_id) }}">
                                    @if($reserve->store->image)
                                    <img src="{{ asset($reserve->store->image) }}" class="img-fluid">
                                    @else
                                    <img src="{{ asset('img/dummy.png') }}" class="img-fluid">
                                    @endif
                                </a>
                            </div>
                            <div class="col-12 col-lg-8">
                                <h5>{{ $reserve->name }}</h5>
                                <hr>
                                <p>ご来店日：<span>{{ $reserve->date }}</span></p>
                                <p class="mb-3">ご来店時刻：<span>{{ $reserve->time }}</span></p>
                                <p>ご来店人数：<span>{{ $reserve->people }} 人</span></p>
                                <p class="mb-3">合計手数料：<span>￥{{ $reserve->total_commission }} 円</span></p>

                                @if($reserve->cancel_flag)
                                <a href="" class="btn btn-outline-secondary d-block disabled">現在キャンセル手続き中です</a>
                                @else
                                <a href="" class="btn btn-outline-danger d-block" data-bs-toggle="modal" data-bs-target="#cancelModal"
                                data-id="{{ $reserve->id }}"
                                data-name="{{ $reserve->name }}"
                                data-date="{{ $reserve->date }}"
                                data-time="{{ $reserve->time }}"
                                >
                                    この予約をキャンセルする
                                </a>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            @else
            <h5 class="text-center py-5 text-secondary">
                <i class="fa-3x fa-solid fa-store-slash"></i>
                <p class="mt-3">現在予約中の店舗はありません</p>
            </h5>

            @endif
        </div>
    </div>
</div>
@endsection
