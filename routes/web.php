<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SubscriptionController;

Route::get('/', function () { return view('home'); });

Route::get('/{nameslug}', [UserController::class, 'showSubscriptionPage']);

Route::post('/subscribe', [SubscriptionController::class, 'createSubscription']);