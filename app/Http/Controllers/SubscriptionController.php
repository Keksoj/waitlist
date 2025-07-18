<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\User;
use App\Models\Note;
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

        $confirmation_message = User::where('id', $subscription->user_id)->get()->first()?->confirmation_message;

        return view(
            'confirmation',
            [
                'subscription' => $subscription,
                'confirmation_message' => $confirmation_message
            ]
        );
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

    public function createNote(Request $request)
    {
        $user = Auth::user();

        // TODO: sanitize the content
        $incomingFields = $request->validate([
            'content' => ['required'],
            'subscription_id' => ['required', 'exists:subscriptions,id']
        ]);

        $subscription = Subscription::where('id', $incomingFields['subscription_id'])->get()->first();

        if (!$subscription->belongsTo($user)) {
            abort(403, "Who are you? How did you get here?");
        }

        $subscription->notes()->create($incomingFields);

        $subscriptions = Subscription::with('notes')->where('user_id', $user->id)->get();

        return view('admin', ['user' => $user, 'subscriptions' => $subscriptions]);
    }
}
