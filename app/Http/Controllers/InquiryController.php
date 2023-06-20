<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('inquiries.index');
    }

    public function confirm(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:10',
            'title' => 'required|string|max:30',
            'content' => 'required|string|min:10|max:1000',
        ], [
            'name.max' => ':max 文字以内で入力してください。',
            'title.max' => ':max 文字以内で入力してください。',
            'content.min' => ':min 文字以上で入力してください。',
            'content.max' => ':max 文字以内で入力してください。',
        ]);

        if(!$request->name && !$request->email && !$request->type && !$request->title && !$request->content) {
            return to_route('home');
        }

        return view('inquiries.confirm');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inquiry = new Inquiry();
        $inquiry->name = $request->input('name');
        $inquiry->email = $request->input('email');
        $inquiry->type = $request->input('type');
        $inquiry->title = $request->input('title');
        $inquiry->content = $request->input('content');
        $inquiry->save();

        return to_route('inquiries.complete')->with('success_inquiries', '送信が完了しました。');
    }

    public function complete()
    {
        if(!session('success_inquiries')) {
            return to_route('home');
        }

        return view('inquiries.complete');
    }
}
