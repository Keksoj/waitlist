<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Subscription successful</title>
</head>

<body>
    <h1>Your subscription is a success!</h1>


    <p>{{$confirmation_message}}<p>

    @csrf
    
    <p>Your name: {{$subscription->name}}</p>
    <p>Your phone number: {{$subscription->telephone}}</p>

    @if ($subscription->email !== null)
    <p>Your email: {{$subscription->email}}</p>
    @endif

    @if ($subscription->commentary !== null)
    <p>Your commentary: {{$subscription->commentary}}</p>
    @endif
    



</body>

</html>