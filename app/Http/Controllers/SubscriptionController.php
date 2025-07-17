<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function createSubscription(Request $request)
    {

        // TODO: sanitize email
        // TODO: sanitize telephone
        // TODO: sanitize commentary (no more than 1000 chars)
        // TODO: sanitize name


        $incomingFields = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'name' =>  ['required', 'min:3'],
            'telephone' => ['required'],
            'email' => [],
            'commentary' => [],
        ]);

        // TODO: prevent email and telephone reuse (to prevent flooding)
        $subscription = Subscription::create($incomingFields);

        if ($subscription == null) {
            abort('500');
        }

        return view('confirmation', ['subscription' => $subscription]);
    }

    public function deleteSubscription(Subscription $subscription)
    {

        if (!Auth::check()) {
            return redirect('/');
        }

        $user = Auth::user();

        if ($user->id === $subscription['user_id']) {
            $subscription->delete();
        }

        return redirect('/' . $user->nameslug . '/admin');
    }
}
