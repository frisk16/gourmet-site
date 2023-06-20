<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ReserveController;
use App\Http\Controllers\InquiryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes(['verify' => true]);

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::controller(UserController::class)->middleware(['auth', 'verified'])
->group(function() {
    Route::get('mypage', 'index')->name('mypage');
    Route::get('mypage/edit', 'edit')->name('mypage.edit');
    Route::patch('mypage/edit', 'update')->name('mypage.update');
    Route::get('mypage/edit_password', 'edit_password')->name('mypage.edit_password');
    Route::patch('mypage/edit_password', 'update_password')->name('mypage.update_password');
    Route::get('mypage/subscription', 'subscription')->name('mypage.subscription');
    Route::post('mypage/store_subscribe', 'store_subscribe')->name('mypage.store_subscribe');
    Route::get('mypage/show_credit', 'show_credit')->name('mypage.show_credit');
    Route::patch('mypage/show_credit', 'update_credit')->name('mypage.update_credit');
    Route::get('mypage/delete_member', 'delete_member')->name('mypage.delete_member');
    Route::get('mypage/cancel_delete_member', 'cancel_delete_member')->name('mypage.cancel_delete_member');
    Route::patch('mypage/toggle_delete_flag', 'toggle_delete_flag')->name('mypage.toggle_delete_flag');
});

Route::controller(StoreController::class)->middleware(['auth', 'verified'])
->group(function() {
    Route::get('stores', 'index')->name('stores.index');
    Route::get('search', 'search')->name('stores.search');
    Route::get('stores/{store}', 'show')->name('stores.show');
    Route::post('stores/review', 'store_review')->name('stores.store_review');
    Route::get('search_budget', 'search_budget')->name('stores.search_budget');
});

Route::controller(FavoriteController::class)->middleware(['auth', 'verified'])
->group(function() {
    Route::get('favorites', 'index')->name('favorites.index');
    Route::post('favorites', 'store')->name('favorites.store');
    Route::delete('favorites/{favorite}', 'destroy')->name('favorites.destroy');
});

Route::controller(ReserveController::class)->middleware(['auth', 'verified'])
->group(function() {
    Route::get('reserves', 'index')->name('reserves.index');
    Route::post('reserves', 'store')->name('reserves.store');
    Route::patch('reserves/{reserve}', 'cancel')->name('reserves.cancel');
});

Route::controller(InquiryController::class)
->group(function() {
    Route::get('inquiries', 'index')->name('inquiries.index');
    Route::get('inquiries/confirm', 'confirm')->name('inquiries.confirm');
    Route::post('inquiries', 'store')->name('inquiries.store');
    Route::get('inquiries/complete', 'complete')->name('inquiries.complete');
});
