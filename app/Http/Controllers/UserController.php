<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
}
