@extends('layouts.app')

@section('content')
    @auth
        <h1 class="top-h1">{{ __('waitinglist.my-waiting-list') }}</h1>

        <div class="my-8">
            @foreach ($subscriptions as $subscription)
                @csrf
                <details class="border border-gray-300 bg-blue-200 my-2">
                    <summary class="cursor-pointer p-2 list-none bg-blue-300">
                        <div class="flex justify-between">
                            <div class="font-semibold">
                                <p>{{ $subscription['name'] }}</p>
                            </div>
                            <div class="">
                                <p>{{ $subscription['telephone'] }}</p>
                            </div>
                    </summary>

                    <div class="flex justify-between">
                        <div class="p-2 font-light">
                            <p>{{ $subscription->created_at->translatedFormat('j F Y') }}</p>
                        </div>
                        <div class="font-light p-2">
                            <p>{{ $subscription['email'] }}</p>
                        </div>
                    </div>
                    <div class="p-2">
                        <p>{{ $subscription['commentary'] }}</p>
                    </div>

                    @foreach ($subscription->notes as $note)
                        <div class="flex pl-2">
                            <p class="text-sm pr-2 text-gray-500">{{ $note->created_at->translatedFormat('j F') }}</p>
                            <p class="text-sm text-gray-700">{{ $note->content }}</p>
                        </div>
                    @endforeach

                    <form action="create-note" method="POST" class="flex items-stretch px-2 my-4 max-w-3xl mx-auto">

                        @csrf

                        <input type="hidden" name="subscription_id" value="{{ $subscription->id }}">

                        <input name="content" type="text" placeholder="{{ __('waitinglist.add-note') }}"
                            class="bg-white border text-sm p-2 border-gray-400 rounded-l focus:outline-none focus:ring-0 focus:border-gray-800 focus:placeholder-transparent placeholder-gray-400">

                        <button type="submit" class="bg-gray-400 px-4 text-white rounded-r cursor-pointer text-sm">
                            +
                        </button>

                    </form>

                    <form action="/subscription/{{ $subscription->id }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="cursor-pointer text-white m-2 p-2 rounded bg-red-500">
                            {{ __('actions.delete') }}
                        </button>
                    </form>
                </details>
            @endforeach
        </div>



        <a href="{{ route('user.edit-welcome') }}" class="direction-button m-4">
            {{ __('waitinglist.edit-my-welcome') }}
        </a>

        <a href="{{ route('user.edit-confirmation') }}" class="direction-button m-4">
            {{ __('waitinglist.edit-my-confirmation') }}
        </a>

        <a href="{{ route('user.edit-password') }}" class="direction-button m-4">
            {{ __('waitinglist.edit-my-password') }}
        </a>
    @endsection

@section('footer')
    <form action="/logout" method="POST" class="m-4">
        @csrf
        <input type="hidden" name="nameslug" value="{{ $user->nameslug }}">
        <button class="direction-button">{{ __('actions.log_out') }}</button>
    </form>
@endsection
@else
<p>{{ __('waitinglist.you-should-not-see-this') }}</p>

@endauth
