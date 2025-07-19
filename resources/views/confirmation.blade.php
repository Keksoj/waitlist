<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Subscription successful</title>
</head>

<body>
    <h1 class="top-h1">Your subscription is a success!</h1>

    <section class="user-paragraph">
        <p>{{$confirmation_message}}
        <p>
    </section>

    @csrf

    <div class="flex space-x-4">
        <div class="w-1/2 text-right">
            <p>Your name:</p>
        </div>
        <div class="w-1/2 text-left font-semibold">
            <p>{{$subscription->name}}</p>
        </div>
    </div>

    <div class="flex space-x-4">
        <div class="w-1/2 text-right">
            <p>Your phone number:</p>
        </div>
        <div class="w-1/2 text-left font-semibold">
            <p>{{$subscription->telephone}}</p>
        </div>
    </div>

    @if ($subscription->email !== null)
    <div class="flex space-x-4">
        <div class="w-1/2 text-right">
            <p>Your email:</p>
        </div>
        <div class="w-1/2 text-left font-semibold">
            <p>{{$subscription->email}}</p>
        </div>
    </div>
    @endif

    @if ($subscription->commentary !== null)
    <div class="flex space-x-4">
        <div class="w-1/2 text-right">
            <p>Your commentary:</p>
        </div>
        <div class="w-1/2 text-left font-semibold">
            <p>{{$subscription->commentary}}</p>
        </div>
    </div>
    @endif


    <div class="small-paragraph mt-3 text-center">
        <p>Please note the deletion code that will allow you to cancel your subscription if you wish:</p>
    </div>

    <div class="font-mono text-xl text-center">{{$subscription->deletion_code}}</div>



</body>

</html>