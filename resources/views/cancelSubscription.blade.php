@extends('layouts.app')

@section('content')
    <h1 class="top-h1">{{ __('waitlist.cancel-title') }}</h1>

    <div class="small-paragraph">
        <p>{{ __('waitlist.cancel-your-subscription') }}</p>
    </div>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded my-4">
            {{ session('success') }}
        </div>
    @endif

    <x-errors />

    <div class="center-box-form">
        <h2 class="text-xl font-semibold text-center mb-10">{{ __('waitlist.your-cancellation-code') }}</h2>
        <form action="{{ route('guest.request-cancellation') }}" method="POST">
            @csrf
            <input name="cancellation_code" placeholder="ex: GABXDPEU"
                class="w-full p-2 mb-10 border bg-white border-gray-300 rounded focus:placeholder-transparent focus:outline-none focus:ring-2 focus:ring-blue-400">


            <x-turnstile-with-button :button-text="__('actions.send')" />

        </form>

    </div>
@endsection
