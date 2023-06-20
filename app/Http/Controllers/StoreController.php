<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\Category;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->has('category_id')) {
            $category_name = Category::find($request->category_id)->name;
            $stores_count = Category::find($request->category_id)->stores()->count();
            $store_img = [
                '1' => 'img/jp_meal.jpg',
                '2' => 'img/west_food.jpg',
                '3' => 'img/sea_food.jpg',
                '4' => 'img/pasta.jpg',
                '5' => 'img/pizza.jpg',
                '6' => 'img/chicken.jpg',
                '7' => 'img/curry.jpg',
            ];
            $stores = Category::find($request->category_id)->stores;
        } else {
            $category_name = '全';
            $stores_count = Store::count();
            $store_img = 'img/top.jpg';
            $stores = Store::all();
        }

        return view('stores.index', compact('category_name', 'stores_count', 'store_img', 'stores'));
    }

    public function search(Request $request)
    {
        $stores = Store::where('name', 'LIKE', "%{$request->keyword}%")->latest()->get();

        return view('search.index', compact('stores'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function show(Store $store, Request $request)
    {
        if($request->type == 'reserve') {
            $header_title = '予約フォーム';
        } elseif($request->type == 'review') {
            $header_title = 'レビュー投稿';
        } else {
            $header_title = '店舗詳細';
        }

        $categories = Category::all();
        $favorite = Auth::user()->favorites()->where('store_id', $store->id)->first();

        $reviews = $store->reviews;

        return view('stores.show', compact('header_title', 'categories', 'store', 'favorite', 'reviews'));
    }

    public function store_review(Request $request)
    {
        $request->validate([
            'comment' => 'required|string|min:10|max:10000',
        ], [
            'comment.min' => ':min 文字以上で入力してください。',
            'comment.max' => ':max 文字以内で入力してください。',
        ]);

        $review = new Review();
        $review->store_id = $request->input('store_id');
        $review->name = Auth::user()->name;
        $review->score = $request->input('score');
        $review->comment = $request->input('comment');
        $review->save();

        return back()->with('store_review', 'レビューを投稿しました。');
    }

    public function search_budget(Request $request)
    {
        $request->validate([
            'budget' => 'required|integer|min:100',
        ], [
            'budget.required' => '予算額を入力してください。',
            'budget.min' => ':min 円以上から検索可能です。',
        ]);

        if(!$request->people && !$request->budget) {
            return to_route('home');
        }

        $pre_commission = floor($request->budget / $request->people);

        $stores = Store::whereBetween('commission', [0, $pre_commission])->get();

        return view('stores.budget', compact('stores'));
    }
}
