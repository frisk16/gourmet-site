<?php

namespace App\Http\Controllers;

use App\Models\Reserve;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\StripeClient;

class ReserveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->paid_flag) {
            $reserves = Auth::user()->reserves;

            return view('reserves.index', compact('reserves'));
        } else {
            return to_route('home');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|string',
            'time' => 'required|string',
        ], [
            'date.required' => '予約日を指定してください。',
            'time.required' => '予約時間を指定してください。',
        ]);

        $total = $request->input('commission') * $request->input('people');
        $stripe = new StripeClient(config('payment.stripe_secret_key'));
        $payment_method = $stripe->customers->retrieve(Auth::user()->stripe_id)->invoice_settings->default_payment_method;

        Auth::user()->charge(
            $total, $payment_method
        );

        $reserve = new Reserve();
        $reserve->user_id = Auth::id();
        $reserve->age = Auth::user()->age;
        $reserve->job = Auth::user()->job;
        $reserve->date = $request->input('date');
        $reserve->time = $request->input('time');
        $reserve->name = $request->input('name');
        $reserve->total_commission = $total;
        $reserve->people = $request->input('people');
        $reserve->store_id = $request->input('store_id');
        $reserve->save();

        return back()->with('store_reserve', '予約受付が完了しました。');
    }

    public function cancel(Reserve $reserve)
    {
        $reserve->cancel_flag = true;
        $reserve->update();

        return to_route('reserves.index')->with('cancel_reserve', 'キャンセル手続きを申請しました。');
    }
}
