@extends('layouts.app')

@section('content')
    @auth
        <h1 class="top-h1">{{ __('waitinglist.app-title') }}</h1>

        <div class="center-box-form">
            <p class="small-paragraph">{{ __('waitinglist.you-are-logged-in') }}</p>

            <form action="{{ route('user.logout') }}" method="POST" class="direction-button">
                @csrf
                <input type="hidden" name="nameslug" value="{{ $user->nameslug }}">
                <button>{{ __('actions.log_out') }}</button>
            </form>
        </div>
    @else
        <x-errors />

        <div class="center-box-form">
            <h2 class="text-xl font-semibold text-center mb-10">
                {{ __('waitinglist.login-as', ['name' => $user->name]) }}
            </h2>
            <form action="{{ route('user.login') }}" method="POST">
                @csrf
                <input type="hidden" name="user_id" value="{{ $user->id }}">
                <input name="password" type="password" placeholder="password"
                    class="w-full p-2 mb-4 border bg-white border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
                <button type="submit"
                    class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600 transition">{{ __('actions.log_in') }}</button>
            </form>
        </div>

    @endauth
@endsection
