<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function createSubscription(Request $request)
    {
        $incomingFields = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'name' =>  ['required', 'min:3'],
            'telephone' => ['required'],
            'email' => [],
            'commentary' => [],
        ]);

        $subscription = Subscription::create($incomingFields);

        if ($subscription == null) {
            abort('500');
        }

        return view('confirmation', ['subscription' => $subscription]);
    }
}
