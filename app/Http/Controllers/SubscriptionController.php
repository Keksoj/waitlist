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


        $incomingFields['deletion_code'] = randomString();

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

        return redirect('/' . $user->nameslug . '/admin');
    }

    /**
     * From a subscriber perspective
     */
    public function requestDeletion(Request $request)
    {
        $incomingInput = $request->validate([
            'deletion_code' => ['required', 'size:7', 'alpha']
        ]);

        $subscription = Subscription::where('deletion_code', $incomingInput['deletion_code'])->first();

        if ($subscription) {
            return view('confirmCancellation', ['subscription' => $subscription]);
        }

        return back()->withErrors(['not found', 'This subscription is not to be found. Maybe it has been deleted already']);
    }

    public function deleteSubscriptionWithCode(Request $request)
    {
        $incomingInput = $request->validate([
            'deletion_code' => ['required', 'size:7', 'alpha']
        ]);

        Subscription::where('deletion_code', $incomingInput['deletion_code'])->delete();

        return redirect('cancel-subscription')
            ->with('success', 'Subscription cancelled successfully. All your data has been removed from the database');
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

        return redirect("/{$user->nameslug}/admin");
    }
}

function randomString(int $length = 7): string
{
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

    $result = '';

    for ($i = 0; $i < $length; $i++) {
        $result .= $characters[random_int(0, strlen($characters) - 1)];
    }

    return $result;
}
