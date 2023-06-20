<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Stripe\StripeClient;

class UserController extends Controller
{
    private function subscriptions_retrieve($stripe)
    {
        $sub_id = Auth::user()->subscriptions()->first()->stripe_id;

        return $stripe->subscriptions->retrieve($sub_id);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('mypage.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $areas = [
            '北海道','青森県','岩手県','宮城県','秋田県',
            '山形県','福島県','茨城県','栃木県','群馬県',
            '埼玉県','千葉県','東京都','神奈川県','新潟県',
            '富山県','石川県','福井県','山梨県','長野県',
            '岐阜県','静岡県','愛知県','三重県','滋賀県',
            '京都府','大阪府','兵庫県','奈良県','和歌山県',
            '鳥取県','島根県','岡山県','広島県','山口県',
            '徳島県','香川県','愛媛県','高知県','福岡県',
            '佐賀県','長崎県','熊本県','大分県','宮崎県',
            '鹿児島県','沖縄県'
        ];

        $jobs = [
            '製造業','建築業','設備業','運輸業',
            '流通業','農林水産業','印刷・出版業','金融業・保険業',
            '不動産業','IT・情報通信業','サービス業','教育・研究機関',
            '病院・医療機関','官公庁・自治体','法人団体','その他',
        ];

        return view('mypage.edit', compact('areas', 'jobs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => [
                'required', 'string', 'min:2', 'max:10',
                Rule::unique('users')->ignore(Auth::id()),
            ],
            'email' => [
                'required', 'string',
                Rule::unique('users')->ignore(Auth::id()),
            ],
            'age' => [
                'required', 'integer', 'min:18',
            ],
        ], [
            'name.min' => ':min 文字以上で入力してください。',
            'name.max' => ':max 文字以内で入力してください。',
            'name.unique' => 'そのユーザー名は既に使用されています。',
            'email.unique' => 'そのEメールアドレスは既に使用されています。',
            'age.min' => ':min 歳以上から登録可能です。'
        ]);

        $user = Auth::user();

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->area = $request->input('area');
        $user->age = $request->input('age');
        $user->job = $request->input('job');
        $user->update();

        return to_route('mypage')->with('edit_user', 'ユーザー情報を変更しました。');
    }

    public function edit_password()
    {
        return view('mypage.edit_password');
    }

    public function update_password(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ], [
            'password.min' => '最低 :min 文字以上で入力してください。',
            'password.confirmed' => '確認用パスワードと一致しません。',
        ]);

        $user = Auth::user();

        if(password_verify($request->input('current_password'), $user->password)) {
            $user->password = bcrypt($request->input('password'));
            $user->update();

            return to_route('mypage')->with('edit_password', 'パスワードを変更しました。');
        } else {
            return to_route('mypage.edit_password')->with('error_password', '現在のパスワードが一致しません。');
        }
    }

    public function subscription()
    {
        if(Auth::user()->paid_flag) {
            return to_route('mypage');
        } else {
            $intent = Auth::user()->createSetupIntent();

            return view('mypage.subscription', compact('intent'));
        }
    }

    public function store_subscribe(Request $request)
    {
        $request->user()->newSubscription(
            'default', config('payment.price_id')
        )->create($request->paymentMethodId);

        $user = Auth::user();
        $user->paid_flag = true;
        $user->update();

        return to_route('mypage')->with('store_subscribe', '有料会員登録が完了しました。');
    }

    public function show_credit()
    {
        if(Auth::user()->paid_flag) {
            $user = Auth::user();
            $stripe = new StripeClient(config('payment.stripe_secret_key'));

            $intent = $user->createSetupIntent();
            $payment_method = $stripe->customers->retrieve($user->stripe_id)->invoice_settings->default_payment_method;
            $card = $stripe->paymentMethods->retrieve($payment_method)->card;

            $next_payment_timestanp = $this->subscriptions_retrieve($stripe)->current_period_end;
            $next_payment = date('Y/m/d', $next_payment_timestanp);
            $created_sub_timestanp = $this->subscriptions_retrieve($stripe)->created;
            $created_sub = date('Y/m/d', $created_sub_timestanp);

            return view('mypage.show_credit', compact('card', 'intent', 'next_payment', 'created_sub'));
        } else {
            return to_route('mypage');
        }
    }

    public function update_credit(Request $request)
    {
        $request->user()->updateDefaultPaymentMethod($request->input('paymentMethodId'));

        return to_route('mypage.show_credit')->with('update_credit', 'カード情報が更新されました。');
    }

    public function delete_member()
    {
        if(Auth::user()->paid_flag && !Auth::user()->delete_flag) {
            $stripe = new StripeClient(config('payment.stripe_secret_key'));
            $current_timestamp = strtotime(date(now()));
            $end_timestamp = $this->subscriptions_retrieve($stripe)->current_period_end;
            $diff_day = floor(($end_timestamp - $current_timestamp) / 60 / 60 / 24);

            return view('mypage.delete_member', compact('diff_day'));
        } else {
            return to_route('mypage');
        }
    }

    public function cancel_delete_member()
    {
        if(Auth::user()->paid_flag && Auth::user()->delete_flag) {
            $stripe = new StripeClient(config('payment.stripe_secret_key'));
            $current_timestamp = strtotime(date(now()));
            $end_timestamp = $this->subscriptions_retrieve($stripe)->current_period_end;
            $diff_day = floor(($end_timestamp - $current_timestamp) / 60 / 60 / 24);
            return view('mypage.cancel_delete_member', compact('diff_day'));
        } else {
            return to_route('mypage');
        }
    }

    public function toggle_delete_flag()
    {
        $user = Auth::user();
        $stripe = new StripeClient(config('payment.stripe_secret_key'));
        $sub_id = $user->subscriptions()->first()->stripe_id;

        if($user->delete_flag) {
            $stripe->subscriptions->update($sub_id, [
                'cancel_at_period_end' => false,
            ]);
            $user->delete_date = '';
            $user->delete_flag = false;
            $user->update();

            return to_route('mypage')->with('del_delete_flag', '解約申請がキャンセルされました。');
        } else {
            $stripe->subscriptions->update($sub_id, [
                'cancel_at_period_end' => true,
            ]);
            $end_timestamp = $this->subscriptions_retrieve($stripe)->current_period_end;
            $user->delete_date = date('Y/m/d', $end_timestamp);
            $user->delete_flag = true;
            $user->update();

            return to_route('mypage')->with('add_delete_flag', '解約申請が完了致しました。');
        }
    }
}
