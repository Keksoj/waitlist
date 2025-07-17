<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function showSubscriptionPage(String $nameslug, Request $request)
    {
        $user = User::where('nameslug', $nameslug)->first();

        if (!$user) {
            abort(404);
        }

        return view('subscription', ['user' => $user]);
    }

    public function accessAdminPage(String $nameslug, Request $request)
    {
        $user = User::where('nameslug', $nameslug)->first();

        if (!$user) {
            abort(404, 'This practitioner does not exist');
        }

        if (Auth::check()) {
            // TODO: retrieve subscription and pass them to the admin page
            $subscriptions = Subscription::where('user_id', $user->id)->get();
            return view('admin', ['user' => $user, 'subscriptions' => $subscriptions]);
        } else {
            $subscriptions = [];
            return view('login', ['user' => $user]);
        }
    }

    public function login(Request $request)
    {
        $incomingFields = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'password' => ['required'],
        ]);

        if (Auth::attempt([
            'id' => $incomingFields['user_id'],
            'password' => $incomingFields['password']
        ])) {
            $request->session()->regenerate();
        }

        return redirect('/' . Auth::user()->nameslug . '/admin');
    }

    public function logout(Request $request)
    {
        $incomingFields = $request->validate(
            ['nameslug' => ['required']]
        );
        $nameslug = $incomingFields['nameslug'];

        Auth::logout();
        return redirect('/' . $nameslug);
    }
}
