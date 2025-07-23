@extends('layouts.app')

@section('content')
    @auth
        @isset($user)
            <h1 class="top-h1">{{ __('waitlist.app-title') }}</h1>

            <div class="center-box-form">
                <p class="small-paragraph">{{ __('waitlist.you-are-logged-in') }}</p>

                <form action="{{ route('user.logout') }}" method="POST" class="direction-button">
                    @csrf
                    <input type="hidden" name="nameslug" value="{{ $user->nameslug }}">
                    <button>{{ __('actions.log_out') }}</button>
                </form>
            </div>
        @endisset
        <p>Someone is logged in but no user has been passed to this page. This should not happen.</p>
    @else
        <x-errors />

        <div class="center-box-form">
            <h2 class="text-xl font-semibold text-center mb-10">
                @isset($user)
                    {{ __('waitlist.login-as', ['name' => $user->name]) }}
                @else
                    Log in
                @endisset
            </h2>
            <form action="{{ route('user.login') }}" method="POST">
                @csrf
                <input name="nameslug"
                    class="w-full p-2 mb-4 border bg-white border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400"
                    @isset($user)
                        value="{{ $user->nameslug }}"
                    @else
                        placeholder="your-name-slug"
                    @endisset>

                <input name="password" type="password" placeholder="password"
                    class="w-full p-2 mb-4 border bg-white border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400">


                <x-turnstile-with-button :button-text="__('actions.log_in')" />

            </form>
        </div>

    @endauth
@endsection
