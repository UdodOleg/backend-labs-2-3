<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\SubscriptionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::middleware('api')->group(function () {
    // Маршруты для подписчиков
    Route::apiResource('subscribers', SubscriberController::class);
    
    // Маршруты для подписок
    Route::apiResource('subscriptions', SubscriptionController::class);
});