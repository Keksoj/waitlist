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

    public function updateWelcomingMessage(Request $request)
    {
        $incomingFields = $request->validate([
            'welcoming_message' => 'required', // TODO: sanitize for anything funky, postgresql injections and whatnot
        ]);

        $user = Auth::user();

        $user->update($incomingFields);

        return view('welcomingMessage', ['user' => $user]);
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



    public function updateConfirmationMessage(String $nameslug, Request $request)
    {
        $incomingFields = $request->validate([
            'confirmation_message' => 'required', // TODO: sanitize for anything funky, postgresql injections and whatnot
        ]);

        $user = Auth::user();

        if ($user->nameslug !== $nameslug) {
            abort(401, "Unauthorized. Who are you? How did you even get here?");
        }

        User::update($incomingFields);

        return view('confirmationMessage', ['user' => $user]);
    }

    public function accessLogin(Request $request)
    {
        if ($request['nameslug'] != null) {
            $user = User::where('nameslug', $request['nameslug'])->first();

            if ($user) {
                return view('login', ['user' => $user]);
            } else {
                abort(404, 'User {$nameslug} not found');
            }
        }

        return view('login');
    }

    public function login(Request $request)
    {
        $incomingFields = $request->validate([
            'nameslug' => ['required', 'exists:users,nameslug'],
            'password' => ['required'],
        ]);

        if (Auth::attempt([
            'nameslug' => $incomingFields['nameslug'],
            'password' => $incomingFields['password']
        ])) {
            $request->session()->regenerate();
        } else {
            return back()->withErrors(['password', 'not recognized']);
        }

        return redirect('/admin');
    }

    public function logout()
    {
        $user = Auth::user();

        Auth::logout();
        return view('subscriptionForm', ['user' => $user]);
    }
}
