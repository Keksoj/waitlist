@extends('layouts.app')

@section('content')
    @auth
        <h1 class="top-h1">My welcome message</h1>

        <section class="user-paragraph">
            <p>“{{ $user->welcoming_message }}”</p>
        </section>

        <div class="small-paragraph">
            <p>Edit your confirmation message below:</p>
        </div>

        <form action="{{ url('/' . $user->nameslug . '/edit-welcome') }}" method="POST"
            class="px-4 my-10 max-w-3xl mx-auto space-y-6">
            @csrf

            <textarea name="welcoming_message" rows="9" class="input-style">{{ $user->welcoming_message }}
    </textarea>

            <button class="validation-button">update</button>
        </form>
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
