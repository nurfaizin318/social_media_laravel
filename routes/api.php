<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FriendShipController;
use App\Http\Controllers\LikesController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

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

    Route::get('/{id}', [FriendShipController::class, 'showRequestFrindship'])->middleware('auth:api')->name('firndshipRequestList');
    Route::get('/friend/{id}', [FriendShipController::class, 'showFriendList'])->middleware('auth:api')->name('friendList');
    Route::post('/request', [FriendShipController::class, 'requestFriendship'])->middleware('auth:api')->name('requestFriendship');
    Route::post('/accept', [FriendShipController::class, 'acceptFriendship'])->middleware('auth:api')->name('acceptFriendship');
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'post'
], function ($router) {

    Route::get('/{id}', [PostController::class, 'index'])->middleware('auth:api')->name('postList');
    Route::post('/store', [PostController::class, 'store'])->middleware('auth:api')->name('postStore');
    Route::post('/update/{id}', [PostController::class, 'update'])->middleware('auth:api')->name('postUpdate');
    Route::delete('/{id}', [PostController::class, 'destroy'])->middleware('auth:api')->name('postDelete');


});

Route::group([
    'middleware' => 'api',
    'prefix' => 'like'
], function ($router) {

    Route::post('/store', [LikesController::class, 'store'])->middleware('auth:api')->name('likeStore');
    Route::delete('/{id}', [LikesController::class, 'destroy'])->middleware('auth:api')->name('likeDelete');
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'comment'
], function ($router) {
    Route::get('/{id}', [CommentController::class, 'index'])->middleware('auth:api')->name('postStore');
    Route::post('/store', [CommentController::class, 'store'])->middleware('auth:api')->name('addComment');
    Route::delete('/{id}', [CommentController::class, 'destroy'])->middleware('auth:api')->name('deleteComment');
    Route::post('/update', [CommentController::class, 'update'])->middleware('auth:api')->name('updateComment');
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'message'
], function ($router) {
    Route::get('/{id}', [MessageController::class, 'index'])->middleware('auth:api')->name('showMessage');
    Route::post('/send', [MessageController::class, 'store'])->middleware('auth:api')->name('storeMessage');
    Route::get('/room/{room_id}', [MessageController::class, 'show'])->middleware('auth:api')->name('storeMessage');

});

Route::group([
    'middleware' => 'api',
    'prefix' => 'user'
], function ($router) {
    Route::get('/{id}', [UserController::class, 'summary'])->middleware('auth:api')->name('getAllData');


});



