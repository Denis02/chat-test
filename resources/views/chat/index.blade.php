<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <title>Chat-test</title>
</head>
<body>

<ul class="chat">
    @foreach($messages as $message)
        <li>
            <b>{{$message->author}}</b>
            <p>{{$message->content}}</p>
        </li>
    @endforeach
</ul>

<hr>

<form method="post">
    <input type="text" name="author">
    <br>
    <br>
    {{csrf_field()}}
    <textarea style="width: 100%; height: 50px" name="content"></textarea>
    <input type="submit" value="Отправить">
</form>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.3/socket.io.js"></script>

<script>

    var socket = io(':6001');

    function appandMessage(data) {
        $('.chat').append(
            $('<li/>').append(
                $('<b/>').text(data.author),
                $('<p/>').text(data.content)
            )
        );
    }


//    $('form').on('submit', function () {
//        var text = $('textarea').val(),
//            msg = {message : text};
//
//        socket.send(msg);
//        appandMessage(msg);
//
//        $('textarea').val('');
//
//        return false;
//    });

    socket.on('chat:message', function (data) {
        console.log(data);
        appandMessage(data);
    })

</script>

</body>
</html>
