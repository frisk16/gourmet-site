<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $favorites = Auth::user()->favorites;

        return view('favorites.index', compact('favorites'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $favorite = new Favorite();

        $favorite->store_id = $request->input('store_id');
        $favorite->user_id = Auth::id();
        $favorite->name = $request->input('name');
        $favorite->save();

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Favorite  $favorite
     * @return \Illuminate\Http\Response
     */
    public function destroy(Favorite $favorite)
    {
        $store_id = Favorite::find($favorite->id)->store_id;

        $favorite->delete();

        return back();
    }
}
