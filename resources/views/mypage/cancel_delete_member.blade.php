@extends('layouts.app')

@section('title')
{{ config('app.name', 'Laravel') }} | 解約申請取り消し
@endsection

@section('content')

@include('layouts.phone_aside')
<div class="container mt-5">
    <div class="row">
        <div class="col-12 col-lg-9 mx-auto">
            <div class="card">
                <div class="card-header">
                    解約申請の取り消し
                </div>
                <div class="card-body">
                    <h5 class="text-center">あなたの解約日「<span class="text-danger">{{ Auth::user()->delete_date }}</span>」</h5>
                    <h5 class="text-center">（あと<span class="text-danger">{{ $diff_day }}</span>日）</h5>
                    <hr>
                    <div class="row">
                        <div class="col-12 col-lg-10 mx-auto text-center">
                            <p>今月分の利用期間が残っている場合のみ有効です。</p>
                            <p>解約申請のキャンセルをしてよろしいですか？</p>
                            <form action="{{ route('mypage.toggle_delete_flag') }}" method="post" class="mt-3">
                                @csrf
                                @method('patch')
                                <a href="{{ route('mypage.edit') }}" class="btn btn-outline-secondary">いいえ</a>
                                <button type="submit" class="btn btn-outline-primary">はい</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
