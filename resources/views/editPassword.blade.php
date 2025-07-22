@extends('layouts.app')

@section('content')
    @auth
        <x-errors />
        <x-success />

        <div class="center-box-form">
            <h2 class="text-xl font-semibold text-center mb-10">
                {{ __('waitlist.my-password') }}
            </h2>
            <form action="{{ route('user.update-password') }}" method="POST">
                @csrf
                <input type="hidden" name="user_id" value="{{ $user->id }}">

                {{ __('waitlist.type-current-password') }}
                <input name="current_password" type="password" placeholder="{{ __('waitlist.current-password') }}"
                    class="w-full p-2 mb-8 border bg-white border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400 focus:placeholder-transparent">

                {{ __('waitlist.type-new-password') }}
                <input name="new_password" type="password" placeholder="{{ __('waitlist.new-password') }}"
                    class="w-full p-2 mt-2 mb-1 border bg-white border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400 focus:placeholder-transparent">

                <input name="new_password_confirmation" type="password"
                    placeholder="{{ __('waitlist.new-password-confirmation') }}"
                    class="w-full p-2 mb-4 border bg-white border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400 focus:placeholder-transparent">

                <button type="submit"
                    class="w-full bg-green-500 text-white py-2 rounded hover:bg-blue-600 transition">{{ __('actions.update') }}</button>
            </form>
        </div>
    @endsection


@section('footer')
    <form action="{{ route('user.logout') }}" method="POST">
        @csrf
        <input type="hidden" name="nameslug" value="{{ $user->nameslug }}">
        <button class="direction-button">
            {{ __('actions.log_out') }}
        </button>
    </form>

    <a href="{{ route('user.admin') }}" class="direction-button">
        {{ __('waitlist.back-to-admin') }}
    </a>
@endsection
@else
<p>{{ __('waitlist.you-should-not-see-this') }}</p>

@endauth
