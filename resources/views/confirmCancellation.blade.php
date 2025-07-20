@extends('layouts.app')

@section('content')
    <h1 class="top-h1">Confirm Cancellation</h1>


    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="list-dic pl-5 space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

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
