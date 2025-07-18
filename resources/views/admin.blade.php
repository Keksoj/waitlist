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
        <details class="border border-gray-300 m-2">
            <summary class="cursor-pointer p-2 list-none bg-amber-200">
                <div class="flex justify-between">
                    <div class="bg-gray-300 font-semibold">
                        <p>{{$subscription['name']}}</p>
                    </div>
                    <div class="bg-gray-400">
                        <p>{{$subscription['telephone']}}</p>
                    </div>
            </summary>
            <p>{{$subscription['email']}}&emsp;{{$subscription['commentary']}}</p>
            <p>Subscribed on the {{$subscription['created_at']}}</p>
            <form action="/subscription/{{$subscription->id}}" method="POST">
                @csrf
                @method('DELETE')
                <button style="background-color: red;">Delete</button>
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