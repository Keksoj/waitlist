@extends('layouts.app')

@section('content')
    <h1 class="top-h1">{{ __('waitinglist.cancel-title') }}</h1>

    <div class="small-paragraph">
        <p>{{ __('waitinglist.cancel-your-subscription') }}</p>
    </div>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded my-4">
            {{ session('success') }}
        </div>
    @endif

    <x-errors />

    <div class="center-box-form">
        <h2 class="text-xl font-semibold text-center mb-10">{{ __('waitinglist.your-deletion-code') }}</h2>
        <form action="{{ route('guest.request-cancellation') }}" method="POST">
            @csrf
            <input name="deletion_code" placeholder="ex: GABXDPEU"
                class="w-full p-2 mb-4 border bg-white border-gray-300 rounded focus:placeholder-transparent focus:outline-none focus:ring-2 focus:ring-blue-400">
            <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600 transition">
                send
            </button>
        </form>

    </div>
@endsection
