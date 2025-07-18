<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Admin</title>
</head>

<body>

    @auth
    <h1 class="top-h1">My waiting list</h1>

    <div class="my-5 max-w-3xl mx-auto space-y-6">
        @foreach($subscriptions as $subscription)
        @csrf
        <details class="border border-gray-300 bg-blue-200 m-2">
            <summary class="cursor-pointer p-2 list-none bg-blue-300">
                <div class="flex justify-between">
                    <div class="font-semibold">
                        <p>{{$subscription['name']}}</p>
                    </div>
                    <div class="">
                        <p>{{$subscription['telephone']}}</p>
                    </div>
            </summary>
            <div class="flex justify-between">
                <div class="font-light p-2">
                    <p>{{$subscription['email']}}</p>
                </div>
                <div class="p-2 font-light">
                    <p>{{$subscription->created_at->translatedFormat('j F Y')}}</p>
                </div>
            </div>
            <div class="p-2">
                <p>{{$subscription['commentary']}}</p>
            </div>

            @if (property_exists($subscriptions, 'notes' ))
            @foreach($subscriptions->notes as $note)
            <div class="">
                <p class="text-sm text-gray-700">{{ $note->content }}</p>
            </div>
            @endforeach
            @endif

            <form
                action="create-note"
                method="POST"
                class="px-4 my-10 max-w-3xl mx-auto space-y-6">
                <div class="flex">

                    <input type="hidden" name="user_id" value="{{$user->id}}">
                    <div>
                        <input
                            name="note"
                            type="text"
                            placeholder="add note…"
                            class="bg-white border p-2 border-gray-400 block py-2 w-full rounded focus:border-teal-500 placeholder-gray-400">
                    </div>
                    <div>
                        <button class="validation-button">Add</button>
                    </div>
                </div>

            </form>

            <form
                action="/subscription/{{$subscription->id}}"
                method="POST">
                @csrf
                @method('DELETE')
                <button class="cursor-pointer text-white m-2 p-2 rounded bg-red-500">Delete</button>
            </form>
        </details>
        @endforeach
    </div>



    <form
        action="{{ url( '/' . $user->nameslug . '/edit-welcome') }}"
        method="GET"
        class="m-4">
        @csrf
        <input type="hidden" name="nameslug" value="{{$user->nameslug}}">
        <button class="direction-button">Edit my welcome message</button>
    </form>

    <form
        action="{{ url( '/' . $user->nameslug . '/edit-confirmation') }}"
        method="GET"
        class="m-4">
        @csrf
        <input type="hidden" name="nameslug" value="{{$user->nameslug}}">
        <button class="direction-button">Edit my confirmation message</button>
    </form>

    <form
        action="/logout"
        method="POST"
        class="m-4">
        @csrf
        <input type="hidden" name="nameslug" value="{{$user->nameslug}}">
        <button class="direction-button">Log out</button>
    </form>

    @else

    <p>Something is wrong, you should not be able to view this page without being logged in.</p>

    @endauth

</body>

</html>