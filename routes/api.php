<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\OrderController;

Route::middleware(['api','checkApiToken','throttle:60,1'])->controller(AuthController::class)->group(function(){
    Route::post('/register', 'register');
    Route::post('/login', 'login');

    Route::middleware(['auth:sanctum'])->group(function () {
        Route::post('/logout', 'logout');
        Route::apiResource('/orders', OrderController::class)->except(['create', 'edit']);
        Route::patch('/orders/{id}/status', [OrderController::class, 'status'])->name('orders.status');
    });
});


