<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SubscriptionController;

Route::get('/', function () {
    return view('home');
});

Route::get('/cancel-subscription', function() { return view('cancelSubscription'); } );
Route::post('/deletion-code', [SubscriptionController::class, 'requestDeletion']);
Route::delete('/confirm-cancellation', [SubscriptionController::class, 'deleteSubscriptionWithCode']);


Route::get('/{nameslug}', [UserController::class, 'showSubscriptionForm']);

Route::get('/{nameslug}/admin', [UserController::class, 'accessAdminPage']);

Route::get('/{nameslug}/edit-welcome', [UserController::class, 'accessEditWelcomingMessage']);
Route::post('/{nameslug}/edit-welcome', [UserController::class, 'updateWelcomingMessage']);

Route::get('/{nameslug}/edit-confirmation', [UserController::class, 'accessEditConfirmationMessage']);
Route::post('/{nameslug}/edit-confirmation', [UserController::class, 'updateConfirmationMessage']);

Route::get('/{nameslug}/edit-password', [UserController::class, 'accessEditPassword']);
Route::post('/{nameslug}/edit-password', [UserController::class, 'updatePassword']);


Route::post('/logout', [UserController::class, 'logout']);
Route::post('/login', [UserController::class, 'login']);

Route::post('/subscribe', [SubscriptionController::class, 'createSubscription']);
Route::post('/{nameslug}/subscribe', [SubscriptionController::class, 'createSubscription']);

Route::post('/{nameslug}/create-note', [SubscriptionController::class, 'createNote']);

Route::delete('/subscription/{subscription}', [SubscriptionController::class, 'deleteSubscription']);
