@extends('layouts.app')

@push('scripts')
    <script src="{{ asset('js/storesShow.js') }}"></script>
@endpush

@section('title')

{{ config('app.name', 'Laravel') }} | {{ $store->name }}

@endsection

@section('content')

@include('layouts.phone_aside')
<div class="container mt-5">
    @include('messages.message')
    <div class="row">

        @include('layouts.aside')

        <div class="col-12 col-lg-9">
            <div class="card">
                <div class="tab-area">
                    <a href="{{ route('stores.show', $store) }}"
                    @if(request()->type != 'reserve' && request()->type != 'review')
                        class="active"
                    @endif
                    >
                        詳細
                    </a>
                    <a href="?type=reserve"
                    @if(request()->type == 'reserve')
                        class="active"
                    @endif
                    >
                        予約
                    </a>
                    <a href="?type=review"
                    @if(request()->type == 'review')
                        class="active"
                    @endif
                    >
                        レビュー
                    </a>
                </div>
                <div class="card-header">
                    <h6>
                        {{ $header_title }}
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-lg-5 mb-3">
                            @if($store->image)
                            <img src="{{ asset($store->image) }}" class="img-fluid">
                            @else
                            <img src="{{ asset('img/dummy.png') }}" class="img-fluid">
                            @endif
                        </div>

                        <div class="col-12 col-lg-7">
                            <h5 class="area-title mb-1">
                                <i class="fa-solid fa-store"></i>
                                {{ $store->name }}
                            </h5>
                            <div class="score-area mb-5">
                                <span class="back-score">{{ str_repeat('★', 5) }}</span>
                                <span class="ave-score" style="width: {{ $store->total_score['ave'] * 20 }}%">{{ str_repeat('★', 5) }}</span>
                                <strong class="count-score">（{{ $store->total_score['count'] }}）</strong>
                            </div>

                            @if(request()->type != 'reserve' && request()->type != 'review')
                                @if($favorite)
                                    <form action="{{ route('favorites.destroy', $favorite) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fa-solid fa-heart-crack"></i>
                                            お気に入り解除
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('favorites.store') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="store_id" value="{{ $store->id }}">
                                        <input type="hidden" name="name" value="{{ $store->name }}">
                                        <button type="submit" class="btn btn-outline-danger">
                                            <i class="fa-solid fa-heart"></i>
                                            お気に入りに追加する
                                        </button>
                                    </form>
                                @endif

                                <hr>
                                <h6 class="area-title">概要</h6>
                                <p class="mb-3">{!! nl2br($store->description) !!}</p>

                                <h6 class="area-title">詳細情報</h6>
                                <p>1人あたりの手数料： <strong class="text-warning">￥{{ $store->commission }}円</strong></p>
                                <p>電話番号： {{ $store->tel }}</p>
                                <p>住所： {{ $store->address }}</p>
                            @endif

                            @if(request()->type == 'reserve')
                                @if(Auth::user()->reserves()->where('name', $store->name)->first())
                                    <h5 class="text-center my-5">
                                        <i class="fa-2x fa-solid fa-user-check"></i>
                                        <p class="mt-3">既に予約済みです</p>
                                    </h5>
                                @else
                                    <form action="{{ route('reserves.store') }}" method="post" name="reserve_form">
                                        @csrf
                                        <input type="hidden" name="store_id" value="{{ $store->id }}">
                                        <input type="hidden" name="name" value="{{ $store->name }}">
                                        <input type="hidden" name="commission" value="{{ $store->commission }}">
                                        <div class="row mb-3">
                                            <label for="date" class="col-12 col-lg-3 text-lg-end">
                                                ご予約日
                                            </label>
                                            <div class="col-12 col-lg-7">
                                                <input type="text" name="date" id="date" class="form-control @error('date') is-invalid @enderror" placeholder="ご予約日を選択" required>

                                                @error('date')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="time" class="col-12 col-lg-3 text-lg-end">
                                                ご予約時間
                                            </label>
                                            <div class="col-12 col-lg-7">
                                                <input type="text" name="time" id="time" class="form-control @error('time') is-invalid @enderror" placeholder="ご予約時間を選択" required>

                                                @error('time')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="people" class="col-12 col-lg-3 text-lg-end">
                                                ご予約される人数
                                            </label>
                                            <div class="col-12 col-lg-7">
                                                <select name="people" id="people" class="form-control">
                                                    @for($i = 1; $i <= 10; $i++)
                                                    <option value="{{ $i }}">{{ $i }}人</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-12 col-lg-10 text-end">
                                                @if(Auth::user()->paid_flag)
                                                <a href="" data-bs-toggle="modal" data-bs-target="#reserveModal" class="btn btn-outline-info" id="reserveBtn">
                                                    <i class="fa-solid fa-users"></i>
                                                    以上の内容で予約
                                                </a>
                                                @else
                                                <a href="" class="btn btn-outline-secondary disabled">
                                                    <i class="fa-solid fa-users"></i>
                                                    有料会員登録後に予約可能
                                                </a>
                                                @endif
                                            </div>
                                        </div>
                                        @include('modals.reserve_modal')
                                    </form>
                                @endif
                            @endif

                            @if(request()->type == 'review')
                                <form action="{{ route('stores.store_review') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="store_id" value="{{ $store->id }}">
                                    <div class="row mb-3">
                                        <label class="col-12 col-lg-3 text-lg-end">
                                            お名前
                                        </label>
                                        <div class="col-12 col-lg-8">
                                            {{ Auth::user()->name }} 様
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="score" class="col-12 col-lg-3 text-lg-end">
                                            評価
                                        </label>
                                        <div class="col-12 col-lg-8">
                                            <select name="score" id="score" class="form-control" required>
                                                <option value="">-- 選択 --</option>

                                                @for($i = 5; $i >= 1; $i--)
                                                <option value="{{ $i }}">{{ str_repeat('★', $i) }}</option>
                                                @endfor

                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="comment" class="col-12 col-lg-3 text-lg-end">
                                            コメント
                                        </label>
                                        <div class="col-12 col-lg-8">
                                            <textarea name="comment" id="comment" rows="5"
                                            class="form-control @error('comment') is-invalid @enderror" placeholder="10文字以上、10000文字以内" required></textarea>

                                            @error('comment')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-12 col-lg-11 text-end">
                                            @if(Auth::user()->paid_flag)
                                            <button type="submit" class="btn btn-outline-info">
                                                <i class="fa-solid fa-comment"></i>
                                                この内容で投稿
                                            </button>
                                            @else
                                            <button class="btn btn-outline-secondary disabled">
                                                <i class="fa-solid fa-comment"></i>
                                                有料会員登録後にレビュー可能
                                            </button>
                                            @endif
                                        </div>
                                    </div>
                                </form>

                                {{--↓ <div class="col-12 col-lg-7 mx-auto"> end ↓--}}
                                </div>

                                {{--↓ <div class="row"> end ↓--}}
                                </div>

                                <div class="row">
                                    <div class="col-12 col-lg-10 mx-auto">
                                        <hr>
                                        <h5 class="area-title">
                                            <i class="fa-solid fa-comments"></i>
                                            レビュー一覧
                                        </h5>
                                        @if($reviews->first())
                                            @foreach($reviews as $review)
                                            <div class="card-body comment-area mb-4">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="row">
                                                            <div class="col-12 col-lg-6">
                                                                <strong>名前：</strong><span class="text-warning">{{ $review->name }}</span> 様
                                                            </div>
                                                            <div class="col-12 col-lg-6 text-lg-end">
                                                                <strong>投稿時間：</strong><span class="text-info">{{ $review->created_at }}</span>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <p class="mb-2"><strong>評価：</strong><span class="text-warning">{{ str_repeat('★', $review->score) }}</span></p>
                                                        <strong>コメント</strong>
                                                        <p class="ps-3">{!! nl2br($review->comment) !!}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        @else
                                            <h5 class="text-center my-5">
                                                <i class="fa-3x fa-solid fa-comment-slash"></i>
                                                <p class="mt-3">まだレビューがありません</p>
                                            </h5>
                                        @endif
                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
