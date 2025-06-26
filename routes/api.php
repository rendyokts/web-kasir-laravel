<?php

use App\Http\Controllers\Api\ApiLoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('mobile')->group(function() {
    Route::post('/loginApi', [ApiLoginController::class, 'loginAPi']);
});