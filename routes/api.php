<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FriendShipController;
use App\Http\Controllers\PostController;

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh'])->middleware('auth:api');
    Route::post('/me', [AuthController::class, 'me'])->middleware('auth:api');
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'friendship'
], function ($router) {

    Route::post('/', [FriendShipController::class, 'showRequestFrindship'])->middleware('auth:api')->name('firndshipRequestList');
    Route::post('/friend', [FriendShipController::class, 'showFriendList'])->middleware('auth:api')->name('friendList');
    Route::post('/request', [FriendShipController::class, 'requestFriendship'])->middleware('auth:api')->name('requestFriendship');
    Route::post('/accept', [FriendShipController::class, 'acceptFriendship'])->middleware('auth:api')->name('acceptFriendship');
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'post'
], function ($router) {

    Route::post('/', [PostController::class, 'index'])->middleware('auth:api')->name('postList');
    Route::post('/store', [PostController::class, 'store'])->middleware('auth:api')->name('postStore');
    Route::post('/delete', [PostController::class, 'destroy'])->middleware('auth:api')->name('postDelete');


});
