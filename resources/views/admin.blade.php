<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>
</head>

<body>

    @auth
    <h1>My waiting list</h1>


    @foreach($subscriptions as $subscription)
    @csrf
    <a href="/subscription/{{$subscription->id}}">
        <div style="border: 3px solid black; margin: 10px; padding-left: 3em; background-color:rgb(247, 208, 185);">
            <p>{{$subscription['name']}}&emsp;{{$subscription['telephone']}}
        </div>
    </a>
    @endforeach




    <form action="/logout" method="POST">
        @csrf
        <input type="hidden" name="nameslug" value="{{$user->nameslug}}">
        <button>Log out</button>
    </form>

    @else

    <p>Something is wrong, you should not be able to view this page without being logged in.</p>

    @endauth

</body>

</html>