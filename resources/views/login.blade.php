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






    <form action="/logout" method="POST">
        @csrf
        <input type="hidden" name="nameslug" value="{{$user->nameslug}}">
        <button>Log out</button>
    </form>
    @else

    <div>
        <h2>Log in as {{$user->name}}</h2>
        <form action="/login" method="POST">
            @csrf
            <input type="hidden" name="user_id" value="{{$user->id}}">
            <input name="password" type="password" placeholder="password">
            <button>Login</button>
        </form>
    </div>

    @endauth





</body>

</html>