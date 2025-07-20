@extends('layouts.app')

@section('content')
    @auth
        <x-errors />
        <x-success />

        <div class="center-box-form">
            <h2 class="text-xl font-semibold text-center mb-10">Edit my password</h2>
            <form action="{{ url('/' . $user->nameslug . '/edit-password') }}" method="POST">
                @csrf
                <input type="hidden" name="user_id" value="{{ $user->id }}">
                First, type in your current password:
                <input name="current_password" type="password" placeholder="current password"
                    class="w-full p-2 mb-8 border bg-white border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400 focus:placeholder-transparent">

                Type in your new password, and confirm it by typing it a second time:
                <input name="new_password" type="password" placeholder="new password"
                    class="w-full p-2 mt-2 mb-1 border bg-white border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400 focus:placeholder-transparent">

                <input name="new_password_confirmation" type="password" placeholder="new password confirmation"
                    class="w-full p-2 mb-4 border bg-white border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400 focus:placeholder-transparent">

                <button type="submit"
                    class="w-full bg-green-500 text-white py-2 rounded hover:bg-blue-600 transition">Update</button>
            </form>
        </div>
    @endsection


@section('footer')
    <form action="/logout" method="POST">
        @csrf
        <input type="hidden" name="nameslug" value="{{ $user->nameslug }}">
        <button class="direction-button">Log out</button>
    </form>

    <form action="{{ url('/' . $user->nameslug . '/admin') }}" method="GET">
        @csrf

        <button class="direction-button">Back to the admin page</button>
    </form>
@else
    <p>Something is wrong, you should not be able to view this page without being logged in.</p>

@endauth
@endsection
