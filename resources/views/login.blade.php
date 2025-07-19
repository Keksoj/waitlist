<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    @auth
    <h1>My waiting list</h1>

    <p>You shouldn't be able to see this page though.</p>

    <form action="/logout" method="POST">
        @csrf
        <input type="hidden" name="nameslug" value="{{$user->nameslug}}">
        <button>Log out</button>
    </form>

    @else


    @if ($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        <ul class="list-dic pl-5 space-y-1">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif


    <div class="bg-blue-100 text-gray-800 rounded-xl shadow-md m-8 p-8 w-full max-w-sm">
        <h2 class="text-xl font-semibold text-center mb-10">Log in as {{$user->name}}</h2>
        <form action="/login" method="POST">
            @csrf
            <input type="hidden" name="user_id" value="{{$user->id}}">
            <input
                name="password"
                type="password"
                placeholder="password"
                class="w-full p-2 mb-4 border bg-white border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
            <button
                type="submit"
                class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600 transition">Login</button>
        </form>
    </div>

    @endauth





</body>

</html>