<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 min-h-screen items-center justify-center">

    <h1 class="top-h1">Cancel subscription</h1>

    <div class="small-paragraph">
        <p>Cancel your subscription by providing the deletion code that was given to you when you first subscribed.</p>
    </div>

    @if (session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded my-4">
        {{ session('success')}}
    </div>
    @endif

    @if ($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded my-4">
        <ul class="list-dic pl-5 space-y-1">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="bg-blue-100 text-gray-800 rounded-xl shadow-md m-8 p-8 w-full max-w-sm">
        <h2 class="text-xl font-semibold text-center mb-10">Your deletion code</h2>
        <form action="/deletion-code" method="POST">
            @csrf
            <input
                name="deletion_code"
                placeholder="ex: GABXDPE…"
                class="w-full p-2 mb-4 border bg-white border-gray-300 rounded focus:placeholder-transparent focus:outline-none focus:ring-2 focus:ring-blue-400">
            <button
                type="submit"
                class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600 transition">
                send
            </button>
        </form>

    </div>

</body>

</html>