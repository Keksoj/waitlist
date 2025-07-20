@extends('layouts.app')

@section('content')
@auth


@if (session('success'))
<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
    {{ session('success')}}
</div>
@endif

@if ($errors->any())
<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
    <ul class="list-dic pl-5 space-y-1">
        @foreach ($errors->all() as $error)
        <li>{{ $error}} </li>
        @endforeach
    </ul>
</div>
@endif

<div class="bg-blue-100 text-gray-800 rounded-xl shadow-md m-8 p-8 w-full max-w-sm">
    <h2 class="text-xl font-semibold text-center mb-10">Edit my password</h2>
    <form action="{{ url( '/' . $user->nameslug . '/edit-password')}}" method="POST">
        @csrf
        <input type="hidden" name="user_id" value="{{$user->id}}">
        First, type in your current password:
        <input
            name="current_password"
            type="password"
            placeholder="current password"
            class="w-full p-2 mb-8 border bg-white border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400 focus:placeholder-transparent">

        Type in your new password, and confirm it by typing it a second time:
        <input
            name="new_password"
            type="password"
            placeholder="new password"
            class="w-full p-2 mt-2 mb-1 border bg-white border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400 focus:placeholder-transparent">

        <input
            name="new_password_confirmation"
            type="password"
            placeholder="new password confirmation"
            class="w-full p-2 mb-4 border bg-white border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400 focus:placeholder-transparent">

        <button
            type="submit"
            class="w-full bg-green-500 text-white py-2 rounded hover:bg-blue-600 transition">Update</button>
    </form>
</div>


@endsection


@section('footer')

<form action="/logout" method="POST">
    @csrf
    <input type="hidden" name="nameslug" value="{{$user->nameslug}}">
    <button class="direction-button">Log out</button>
</form>

<form action="{{ url( '/' . $user->nameslug . '/admin') }}" method="GET">
    @csrf

    <button class="direction-button">Back to the admin page</button>
</form>

@else

<p>Something is wrong, you should not be able to view this page without being logged in.</p>

@endauth
@endsection