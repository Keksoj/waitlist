<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Waiting list</title>
</head>

<body class="bg-gray-100">

    <h1 class="top-h1">{{$user->name}}</h1>

    <section class="user-paragraph">
        <p>{{$user->welcoming_message}}</p>
    </section>



    <!-- TODO: check out why the POST request is sent to /{nameslug}/subscribe and not to /subscribe -->
    <form
        action="subscribe"
        method="POST"
        class="px-4 my-10 max-w-3xl mx-auto space-y-6">
        @csrf
        <input type="hidden" name="user_id" value="{{$user->id}}">

        <div class="flex space-x-4">
            <div class="w-1/2">
                <label for="name">Your full name</label>
                <input
                    name="name"
                    type="text"
                    placeholder="ex: Christian Blinker…"
                    class="input-style font-bold">
            </div>

            <div class="w-1/2">
                <label for="telephone">Your phone number</label>
                <input
                    name="telephone"
                    type="text"
                    placeholder="ex: 06 …"
                    class="input-style font-bold">
            </div>
        </div>

        <div>
            <label for="email">Your email (optional)</label>
            <input
                name="email"
                type="text"
                placeholder="email (optional)"
                class="bg-white p-2 border border-gray-400 block py-2 w-full rounded focus:border-teal-500 font-medium">
        </div>

        <div>
            <label for="commentary">Commentary (optional)</label>
            <textarea
                name="commentary"
                placeholder="what brings you here"
                class="bg-white p-2 border border-gray-400 block py-2 w-full rounded focus:border-teal-500 font-medium">
                </textarea>
        </div>
        <!-- TODO add a I am not a robot captcha-->

        <div class="px-8 py-6 flex justify-between">
            <button class="bg-green-600 max-w-3xl px-4 py-2 text-white rounded font-semibold">
                Subscribe
            </button>
        </div>
    </form>


</body>

</html>