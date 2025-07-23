<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Subscription;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SubscriptionController;

Route::get('/', function () {
    return app(UserController::class)->showSubscriptionForm('doctor-example', request());
});

Route::middleware('auth')->group(function () {
    Route::get('/edit-welcome', function () {
        return view('welcomingMessage', ['user' => Auth::user()]);
    })->name('user.edit-welcome');

    Route::post('/edit-welcome', [UserController::class, 'updateWelcomingMessage'])->name('user.update-welcome');

    Route::get('/admin', function () {
        $user = Auth::user();
        $subscriptions = Subscription::with('notes')->where('user_id', $user->id)->get();
        return view('admin', ['user' => $user, 'subscriptions' => $subscriptions]);
    })->name('user.admin');


    Route::get(
        '/edit-confirmation',
        function () {
            return view('confirmationMessage', ['user' => Auth::user()]);
        }
    )->name('user.edit-confirmation');

    Route::post(
        '/edit-confirmation',
        [UserController::class, 'updateConfirmationMessage']
    )->name('user.update-confirmation');

    Route::get(
        '/edit-password',
        function () {
            return view('editPassword', ['user' => Auth::user()]);
        }
    )->name('user.edit-password');

    Route::post('/edit-password', [UserController::class, 'updatePassword'])->name('user.update-password');
    Route::post('/create-note', [SubscriptionController::class, 'createNote'])->name('user.create-note');

    Route::delete('/subscription/{subscription}', [SubscriptionController::class, 'deleteSubscription'])->name('user.delete-subscription');
});

Route::post('/logout', [UserController::class, 'logout'])->name('user.logout');

Route::get('/login', [UserController::class, 'accessLogin'])->name('login');
Route::post('/login', [UserController::class, 'login'])->name('user.login');

Route::get('/cancel-subscription', function () {
    return view('cancelSubscription');
})->name('guest.cancel-subscription');

Route::post('/request-cancellation', [SubscriptionController::class, 'requestCancellation'])->name('guest.request-cancellation');
Route::delete('/confirm-cancellation', [SubscriptionController::class, 'confirmCancellation'])->name('guest.confirm-cancellation');



Route::post('/subscribe', [SubscriptionController::class, 'createSubscription'])->name('guest.subscribe');

Route::get('/{nameslug}', [UserController::class, 'showSubscriptionForm']);

Route::get('/{nameslug}/admin', [UserController::class, 'accessLogin']);
Route::get('/{nameslug}/login', [UserController::class, 'accessLogin']);
