<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SellController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
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
Route::get('/purchase/{item}', [PurchaseController::class, 'create'])->name('purchase.create');
Route::post('/purchase/{item}', [PurchaseController::class, 'store'])->name('purchase.store');
Route::get('/mypage/profile', function () {
    return view('profile.edit');
    })->middleware(['auth', 'verified']);
Route::post('/mypage/profile', [ProfileController::class, 'update']);
Route::get('/mypage', function () {
    return view('mypage');
})->middleware(['auth', 'verified']);
Route::get('/sell', [SellController::class, 'create']);
Route::post('/sell', [SellController::class, 'store']);
Route::get('/purchase/address/{item_id}', function ($item_id) {
    return view('address', compact('item_id'));
});
Route::post('/purchase/address/{item_id}', function ($item_id) {
    $user = auth()->user();

    $user->update([
        'postal_code' => request('postal_code'),
        'address' => request('address'),
        'building' => request('building'),
    ]);

    return redirect('/purchase/' . $item_id);
});
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');