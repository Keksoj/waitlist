<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Waiting list</title>
</head>

<body>
    <h1>{{$user->name}}</h1>

    <p>{{$user->welcoming_message}}</p>

{{$user->id}}
    <div>
        <form action="subscribe" method="POST">
            @csrf
            <input type="hidden" name="user_id" value="{{$user->id}}">
            <input name="name" type="text" placeholder="name">
            <br>
            <input name="telephone" type="text" placeholder="phone number">
            <br>
            <input name="email" type="text" placeholder="email (optional)">
            <br>
            <textarea name="commentary" placeholder="commentary (optional)"></textarea>
            <br>
            <button>Subscribe</button>
        </form>
    </div>

</body>

</html>