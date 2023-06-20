@extends('layouts.app')

@section('title')
{{ config('app.name', 'Laravel') }} | 有料会員解約手続き
@endsection

@section('content')

@include('layouts.phone_aside')
<div class="container mt-5">
    @include('modals.delete_member_modal')
    <div class="row">
        <div class="col-12 col-lg-9 mx-auto">
            <div class="card">
                <div class="card-header">
                    有料会員解約申請
                </div>
                <div class="card-body">
                    <h6 class="text-danger text-center">※以下の内容をご確認ください。</h6>
                    <hr>
                    <div class="row">
                        <div class="col-12 col-lg-7 mx-auto">
                            <ul>
                                <li>解約申請した時点で今月支払った分の利用期間が残っている場合は、今月分の終了日までそのままお使いいただけます。</li>
                                <li>今月分の利用期間終了後、解約処理が開始されます。</li>
                                <li>解約処理後は無料会員として引き続きサイトをご利用いただけます。</li>
                                <li>有料会員解約処理が完了したと同時に、登録したクレジットカードのデータも削除されます。</li>
                                <li><strong>途中、解約申請を取り消したい場合は「マイページ」&raquo;「会員情報の変更」ページ内の「有料会員の解約申請取り消し」リンクから取り消し手続きが行えます。　※今月分の利用期間が残っている場合に限る</strong></li>
                            </ul>
                            <p class="mb-2 border-bottom border-secondary">あなたの残りの利用期間：<strong class="text-danger">{{ $diff_day }} 日</strong></p>
                            <p>上記の内容を確認し、よろしければ以下のボタンを押してください。</p>
                            <a href="" class="btn btn-outline-danger d-block my-3" data-bs-toggle="modal" data-bs-target="#deleteMemberModal">解約申請</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
