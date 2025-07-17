<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>
</head>

<body>

    @auth
    <h1>My welcome message</h1>

    Here is your welcome message:

    <p><i>{{$user->welcoming_message}}<i></p>

    <p>Edit it here:</p>

    <form action="{{ url( '/' . $user->nameslug . '/edit-welcome') }}" method="POST">
        @csrf

        <textarea name="welcoming_message" rows="8" cols="60">{{$user->welcoming_message}}</textarea>
        <br>
        <button>update<button>
    </form>

    <br>

    <form action="{{ url( '/' . $user->nameslug . '/admin') }}" method="GET">
        @csrf

        <button>Back to the admin page</button>
    </form>
    <br>

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