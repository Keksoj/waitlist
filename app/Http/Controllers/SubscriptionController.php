<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\User;
use App\Support\Helpers;
use Illuminate\Validation\Rule;
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
            'cf-turnstile-response' => ['required', Rule::turnstile()],
            'user_id' => ['required', 'exists:users,id'],
            'name' =>  ['required', 'min:3'],
            'telephone' => ['required'],
            'email' => [],
            'commentary' => [],
        ]);


        $incomingFields['cancellation_code'] = Helpers::randomString();

        // TODO: prevent email and telephone reuse (to prevent flooding)
        $subscription = Subscription::create($incomingFields);

        if ($subscription == null) {
            return back()->withErrors(['failed', __('could-not-create-subscription')]);
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

    /**
     * From a user perspective
     */
    public function deleteSubscription(Subscription $subscription)
    {
        if (!Auth::check()) {
            return redirect('/');
        }

        $user = Auth::user();

        if ($user->id === $subscription['user_id']) {
            $subscription->delete();
        }

        return back();
    }

    /**
     * From a subscriber perspective
     */
    public function requestCancellation(Request $request)
    {
        $incomingInput = $request->validate([
            'cancellation_code' => ['required', 'size:7', 'alpha']
        ]);

        $subscription = Subscription::where('cancellation_code', $incomingInput['cancellation_code'])->first();

        if ($subscription) {
            return view('confirmCancellation', ['subscription' => $subscription]);
        }

        return back()->withErrors(['Not found', __('waitinglist.subscription-not-found')]);
    }

    public function confirmCancellation(Request $request)
    {
        $incomingInput = $request->validate([
            'cancellation_code' => ['required', 'size:7', 'alpha']
        ]);

        Subscription::where('cancellation_code', $incomingInput['cancellation_code'])->delete();

        return redirect('cancel-subscription')->with('success', __('waitinglist.cancel-success'));
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

        return back();
    }
}
