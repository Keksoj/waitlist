<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function showSubscriptionForm(String $nameslug, Request $request)
    {
        $user = User::where('nameslug', $nameslug)->first();

        if (!$user) {
            abort(404);
        }

        return view('subscriptionForm', ['user' => $user]);
    }

    public function accessAdminPage(String $nameslug, Request $request)
    {
        $user = User::where('nameslug', $nameslug)->first();

        if (!$user) {
            abort(404, 'This practitioner does not exist');
        }

        if (Auth::check()) {
            $subscriptions = Subscription::with('notes')->where('user_id', $user->id)->get();
            return view('admin', ['user' => $user, 'subscriptions' => $subscriptions]);
        } else {
            $subscriptions = [];
            return view('login', ['user' => $user]);
        }
    }

    public function accessEditWelcomingMessage()
    {
        if (Auth::check()) {
            return view('welcomingMessage', ['user' => Auth::user()]);
        } else {
            abort(403, "Who are you? How did you get here?");
        }
    }

    public function updateWelcomingMessage(String $nameslug, Request $request)
    {
        $incomingFields = $request->validate([
            'welcoming_message' => 'required', // TODO: sanitize for anything funky, postgresql injections and whatnot
        ]);

        $user = Auth::user();

        if ($user->nameslug !== $nameslug) {
            abort(401, "Unauthorized. Who are you? How did you even get here?");
        }

        $user->update($incomingFields);

        return view('welcomingMessage', ['user' => $user]);
    }

    public function accessEditPassword()
    {
        if (Auth::check()) {
            return view('editPassword', ['user' => Auth::user()]);
        } else {
            abort(403, "Who are you? How did you get here?");
        }
    }

    public function updatePassword(Request $request)
    {

        $user = $request->user();

        $validatedInput = $request->validate([
            'current_password' => ['required'],
            'new_password' => ['required'], // TODO: add Password::defaults but customize the defaults in AuthServiceProvider
            'new_password_confirmation' => ['required', 'same:new_password']
        ]);

        if (!Hash::check($validatedInput['current_password'], $user->password)) {
            return back()->withErrors(['current_password' => 'The current password is incorrect']);
        }

        $user->password = bcrypt($validatedInput['new_password']);
        $user->save();

        return back()->with('success', 'Password updated successfully!');
    }

    public function accessEditConfirmationMessage()
    {
        if (Auth::check()) {
            return view('confirmationMessage', ['user' => Auth::user()]);
        } else {
            abort(403, "Who are you? How did you get here?");
        }
    }

    public function updateConfirmationMessage(String $nameslug, Request $request)
    {
        $incomingFields = $request->validate([
            'confirmation_message' => 'required', // TODO: sanitize for anything funky, postgresql injections and whatnot
        ]);

        $user = Auth::user();

        if ($user->nameslug !== $nameslug) {
            abort(401, "Unauthorized. Who are you? How did you even get here?");
        }

        $user->update($incomingFields);

        return view('confirmationMessage', ['user' => $user]);
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
        } else {
            return back()->withErrors(['password', 'not recognized']);
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
        return redirect('/' . $nameslug . '/admin');
    }
}
