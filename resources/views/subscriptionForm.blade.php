@extends('layouts.app')

@section('content')
    <a href="{{ url('/' . $user->nameslug . '/login') }}"
        class = "w-full px-4 pt-4 flex justify-end text-gray-500 hover:text-gray-700">

        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20" stroke-width="1.5" stroke="currentColor"
            class="size-5">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
        </svg>
    </a>

    <h1 class="top-h1">{{ $user->name }}</h1>

    <section class="user-paragraph">
        <p>{{ $user->welcoming_message }}</p>
    </section>

    <x-errors />


    <form action="{{ route('guest.subscribe', ['nameslug' => $user->nameslug]) }}" method="POST"
        class="px-4 my-10 max-w-3xl mx-auto space-y-6">
        @csrf
        <input type="hidden" name="user_id" value="{{ $user->id }}">

        <div class="flex space-x-4">
            <div class="w-1/2">
                <label for="name">{{ __('waitlist.your-full-name') }}</label>
                <input name="name" type="text" placeholder="ex: Christian Blinker…" class="input-style font-bold">
            </div>

            <div class="w-1/2">
                <label for="telephone">{{ __('waitlist.your-phone-number') }}</label>
                <input name="telephone" type="text" placeholder="ex: 06 …" class="input-style font-bold">
            </div>
        </div>

        <div>
            <label for="email">{{ __('waitlist.your-email') }}</label>
            <input name="email" type="text" placeholder="email (optional)"
                class="bg-white p-2 border border-gray-400 block py-2 w-full rounded focus:border-teal-500 font-medium">
        </div>

        <div>
            <label for="commentary">{{ __('waitlist.commentary') }}</label>
            <textarea name="commentary"
                class="bg-white p-2 border border-gray-400 block py-2 w-full rounded focus:border-teal-500 font-medium"></textarea>
        </div>

        <p>{{ __('waitlist.validate-human') }}</p>
        <x-turnstile-with-button :button-text="__('waitlist.subscribe')" />
    </form>
@endsection

@section('footer')
    <a href="{{ route('guest.cancel-subscription') }}"
        class="inline-block bg-purple-500 text-white font-semibold
        py-2 px-4 rounded hover:bg-blue-600 transition">
        {{ __('waitlist.click-here-to-cancel') }}
    </a>
@endsection
