<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SubscriptionController;

Route::get('/', function () {
    return view('home');
});

Route::get('/{nameslug}', [UserController::class, 'showSubscriptionForm']);
Route::get('/{nameslug}/admin', [UserController::class, 'accessAdminPage']);

Route::post('/logout', [UserController::class, 'logout']);
Route::post('/login', [UserController::class, 'login']);

Route::post('/subscribe', [SubscriptionController::class, 'createSubscription']);
Route::delete('/subscription/{subscription}', [SubscriptionController::class, 'deleteSubscription']);
