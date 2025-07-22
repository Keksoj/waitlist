@extends('layouts.app')

@section('content')
    @auth
        <h1 class="top-h1">{{ __('waitlist.my-confirmation') }}</h1>

        <section class="user-paragraph">
            <p>“{{ $user->confirmation_message }}”</p>
        </section>

        <div class="small-paragraph">
            <p>{{ __('waitlist.edit-your-confirmation-message') }}:</p>
        </div>

        <form action="{{ route('user.update-confirmation') }}" method="POST" class="px-4 my-10 max-w-3xl mx-auto space-y-6">

            @csrf

            <textarea name="confirmation_message" rows="9" class="input-style">
                {{ $user->confirmation_message }}
            </textarea>

            <button class="validation-button">{{ __('actions.update') }}</button>
        </form>
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
