<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SubscriptionController;
use App\Models\Subscription;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');



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
    
    Route::post('/edit-confirmation', [UserController::class, 'updateConfirmationMessage'])->name('user.update-confirmation');
    
    Route::get(
        '/edit-password',
        function () {
            return view('editPassword', ['user' => Auth::user()]);
        }
    )->name('user.edit-password');
    
    Route::post('/edit-password', [UserController::class, 'updatePassword']);
});

Route::get('/', function () {
    return view('home');
});

Route::middleware('auth')->group(function () {
});

Route::get('/cancel-subscription', function () {
    return view('cancelSubscription');
});
Route::post('/deletion-code', [SubscriptionController::class, 'requestDeletion']);
Route::delete('/confirm-cancellation', [SubscriptionController::class, 'deleteSubscriptionWithCode']);


Route::post('/logout', [UserController::class, 'logout']);
Route::post('/login', [UserController::class, 'login']);

Route::post('/subscribe', [SubscriptionController::class, 'createSubscription']);
Route::post('/{nameslug}/subscribe', [SubscriptionController::class, 'createSubscription']);

Route::post('/{nameslug}/create-note', [SubscriptionController::class, 'createNote']);

Route::delete('/subscription/{subscription}', [SubscriptionController::class, 'deleteSubscription']);

Route::get('/{nameslug}', [UserController::class, 'showSubscriptionForm']);

Route::get('/{nameslug}/login', [UserController::class, 'accessLogin']);


require __DIR__.'/auth.php';
