<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SubscriptionController;

Route::get('/', function () {
    return view('home');
});

Route::get('/{nameslug}', [UserController::class, 'showSubscriptionPage']);
Route::get('/{nameslug}/admin', [UserController::class, 'showAdminPage']);

Route::post('/subscribe', [SubscriptionController::class, 'createSubscription']);
Route::post('/logout', [UserController::class, 'logout']);
Route::post('/login', [UserController::class, 'login']);
