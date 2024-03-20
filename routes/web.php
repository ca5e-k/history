<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LifeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RelationController;
use App\Http\Controllers\MutualFollowsController;
use App\Http\Controllers\MessageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// welcome.blade.phpを読み込んでいるということ
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Language Switcher Route 言語切替用ルートだよ
Route::get('language/{locale}', function ($locale) {
    app()->setLocale($locale);
    session()->put('locale', $locale);
    return redirect()->back();
});

Route::resource('post',PostController::class);
Route::resource('life',LifeController::class);

Route::post('/like/{post}',[LikeController::class,'like'])->name('like');
Route::post('/unlike/{post}',[LikeController::class,'unlike'])->name('unlike');

Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');

Route::get('/users/{user}/posts', [UserController::class, 'showPosts'])->name('users.posts.show');

Route::post('/follow/{user}', [RelationController::class, 'follow'])->name('follow');
Route::delete('/unfollow/{user}', [RelationController::class, 'unfollow'])->name('unfollow');


// 相互フォローユーザーを一覧表示
Route::get('/messages/index', [MutualFollowsController::class, 'index'])->name('messages.index');

// メッセージルームの表示
Route::get('/messages/{roomId}', [MessageController::class, 'show'])->name('messages.show');

// メッセージを送信するためのルーター
Route::post('/messages/{roomId}/send', [MessageController::class, 'send'])->name('messages.send');

require __DIR__.'/auth.php';