<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessageController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// ルームを新規作成するためのルーター
Route::post('/messages/create-or-get-room', [MessageController::class, 'createOrGetRoom']);

// メッセージを表示するためのルーター
// Route::get('/messages/{roomId}', [MessageController::class, 'getMessages']);

// Route::middleware('auth:api')->group(function () {
//     Route::get('/room/{receiverId}', 'MessageController@createOrGetRoom');
//     Route::get('/messages/{roomId}', 'MessageController@getMessages');
// });
