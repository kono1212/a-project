<?php

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
use App\Http\Controllers\DisplayController;
use App\Http\Controllers\ProductController;





Route::resource('products', ProductController::class)->except([
    'index', 'store' // ホームページでの商品表示と出品処理は別途処理されるため、除外する
]);



Auth::routes();
Route::get('/', [DisplayController::class, 'index'])->name('home'); // ホームページの表示

Route::get('/search', [DisplayController::class, 'search'])->name('search');

Route::get('post/{id}', [ProductController::class, 'show'])->name('post.detail');
Route::get('my-post/{id}', [ProductController::class, 'myshow'])->name('my.post');

Route::get('/user/{id}', [DisplayController::class, 'userPage'])->name('user.page');

Route::put('/post/{id}', [ProductController::class, 'update'])->name('post.update');
Route::delete('/post/{id}', [ProductController::class, 'destroy'])->name('post.delete');


Route::post('/purchase/{post}', [ProductController::class, 'purchaseDetail'])->name('purchase.detail');

Route::post('/confirm/{post}', [ProductController::class, 'purchaseConfirm'])->name('purchase.confirm');

Route::post('/complete', [ProductController::class, 'purchaseComplete'])->name('purchase.complete');

Route::post('/users/{user}', [DisplayController::class, 'userUpdate'])->name('user.update');


Route::get('/post', [ProductController::class, 'create'])->name('post.create'); // 商品出品ページの表示
Route::post('/post', [ProductController::class, 'store'])->name('post.store'); // 商品の出品処理

Route::get('/mypage', [DisplayController::class, 'mypage'])->name('mypage'); 
Route::get('/edit', [DisplayController::class, 'editAccount'])->name('user.edit');


Route::delete('/user/delete/confirm/{id}', [DisplayController::class, 'deleteConfirm'])->name('user.delete.confirm');
Route::delete('/user/delete/{id}', [DisplayController::class, 'delete'])->name('user.delete');

Route::get('/top', [DisplayController::class, 'top'])->name('top');

Route::get('/sell', [DisplayController::class, 'sell'])->name('sell'); 

Route::get('/buy-history', [DisplayController::class, 'buyHistory'])->name('buy.history');

Route::get('/sell_history', [DisplayController::class, 'sellHistory'])->name('sell.history');

Route::get('/follow', [DisplayController::class, 'followList'])->name('follow.list');

Route::get('/like', [DisplayController::class, 'likeList'])->name('like.list');

Route::post('/follow/{id}', [DisplayController::class, 'toggleFollow'])->name('follow.toggle');


