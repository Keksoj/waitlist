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
    <h1>My waiting list</h1>


    @foreach($subscriptions as $subscription)
    @csrf
    <details style="border: 3px solid black; margin: 10px; padding-left: 1em; background-color:rgb(247, 208, 185);">
        <summary>
            {{$subscription['name']}}&emsp;{{$subscription['telephone']}}
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