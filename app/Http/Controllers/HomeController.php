<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Store;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $new_stores = Store::orderBy('created_at', 'desc')->limit(4)->get();
        $stores = Store::all();

        $pop_stores = [];
        foreach($stores as $store) {
            if($store->total_score['ave'] > 4) {
                $pop_stores[] = [
                    'id' => $store->id,
                    'image' => $store->image,
                    'name' => $store->name,
                    'ave' => $store->total_score['ave'],
                    'count' => $store->total_score['count'],
                ];
            }
        }

        return view('home', compact('new_stores', 'pop_stores'));
    }
}
