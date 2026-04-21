<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
Route::get('/test/{greeting?}', 
function ($greeting = 'Goodmorning') {
return $greeting . '=おはようございます';
});
Route::get('/', [TestController::class, 'index']);