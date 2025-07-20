@extends('layouts.app')

@section('content')
    <h1 class="top-h1">Confirm Cancellation</h1>



    <x-success />
    <x-errors />

    <div class="center-box-form">
        <h2 class="text-xl font-semibold text-center mb-10">Confirm</h2>
        <p class="small-paragraph mb-4">
            Are you sure to cancel the subscription made by <b>{{ $subscription->name }}</b>?
        </p>
        <form action="/confirm-cancellation" method="POST">
            @csrf
            @method('DELETE')
            <input type='hidden' name="deletion_code" value="{{ $subscription->deletion_code }}">
            <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600 transition">
                confirm
            </button>
        </form>

    </div>
@endsection
