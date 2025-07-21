@extends('layouts.app')

@section('content')
    <h1 class="top-h1">{{ __('waitinglist.confirm-cancel-title') }}</h1>



    <x-success />
    <x-errors />

    <div class="center-box-form">
        <p class="small-paragraph mb-4">
            {{ __('waitinglist.are-you-sure-to-cancel', ['name' => $subscription->name]) }}
        </p>
        <form action="/confirm-cancellation" method="POST">
            @csrf
            @method('DELETE')
            <input type='hidden' name="deletion_code" value="{{ $subscription->deletion_code }}">
            <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600 transition">
                {{ __('actions.confirm') }}
            </button>
        </form>

    </div>
@endsection
