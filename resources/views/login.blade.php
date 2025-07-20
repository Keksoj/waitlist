@extends('layouts.app')

@section('content')
    @auth
        <h1>My waiting list</h1>

        <p>You shouldn't be able to see this page though.</p>

        <form action="/logout" method="POST">
            @csrf
            <input type="hidden" name="nameslug" value="{{ $user->nameslug }}">
            <button>Log out</button>
        </form>
    @else
        <x-errors />

        <div class="center-box-form">
            <h2 class="text-xl font-semibold text-center mb-10">Log in as {{ $user->name }}</h2>
            <form action="/login" method="POST">
                @csrf
                <input type="hidden" name="user_id" value="{{ $user->id }}">
                <input name="password" type="password" placeholder="password"
                    class="w-full p-2 mb-4 border bg-white border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
                <button type="submit"
                    class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600 transition">Login</button>
            </form>
        </div>

    @endauth
@endsection
