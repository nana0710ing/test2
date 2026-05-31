<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SellController;
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
Route::get('/', [ItemController::class, 'index']);
Route::get('/item/{item}', [ItemController::class, 'show']);
Route::post('/like/{item}', [LikeController::class, 'store']);
Route::post('/comment/{item_id}', [CommentController::class, 'store']);
Route::get('/mylist', [ItemController::class, 'mylist']);
Route::post('/purchase/{item_id}', [PurchaseController::class, 'store']);
Route::get('/mypage/profile', function () {
    return view('profile.edit');
});
Route::post('/mypage/profile', [ProfileController::class, 'update']);
Route::get('/mypage', function () {
    return view('mypage');
});
Route::get('/sell', [SellController::class, 'create']);
Route::post('/sell', [SellController::class, 'store']);