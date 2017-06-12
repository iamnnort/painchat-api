<html>
<head>
    <title>PainChat</title>
</head>
<body>
<form action="/chat/message" method="post">
    {{ csrf_field() }}
    <textarea name="content" style="width: 100%; height: 200px;" id="content"></textarea>
    <input type="text" name="author" id="author">
    <input type="submit">
</form>
<ul>
    @foreach($messages as $message)
        <li>
            <b>{{$message->author}}:</b>
            <span>{{$message->content}}</span>
        </li>
    @endforeach
</ul>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.3/socket.io.js"></script>
<script>
    var socket = io(':6001');

//    $('form').on('submit', function (event) {
//        var content = $('#content').val();
//        var author = $('#author').val();
//
//        var msg = {content, author};
//
//        socket.send(msg);
//
//        return false;
//    });

    socket.on('chat:chat_message_added', function (data) {
        console.log(data);

//        $('ul').append(
//            $('<li>').append(
//                $('<b>').text(data.author + ': '),
//                $('<span>').text(data.content)
//            )
//        );

    });

</script>
</body>
</html>