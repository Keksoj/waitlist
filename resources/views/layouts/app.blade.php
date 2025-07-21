<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.css'])
    <title>@yield('title', 'Waiting list')</title>
</head>

<body class="min-h-screen bg-gray-50 flex flex-col items-center px-4">

    <main class="w-full max-w-3xl flex-grow">
        @yield('content')
    </main>

    <footer class="w-full max-w-3xl mt-6 text-center px-4 pb-4">
        <div class="flex justify-between w-full gap-4">
            @yield('footer')
        </div>
    </footer>
</body>
