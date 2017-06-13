var request = require('request');
var io = require('socket.io')(6001, {
    origins: [
        'painchat-api.loc:*',
        'localhost:*'
    ]
});
var Redis = require('ioredis');
var redis = new Redis();
//
// io.use(function (socket, next) {
//     request.get({
//         url: 'http://painchat-api.loc/ws/check-auth',
//         headers: {cookie: socket.request.headers.cookie},
//         json: true
//     }, function (error, respose, json) {
//         console.log(json);
//     })
// });

io.on('connection', function (socket) {
    console.log('a user connected');

    socket.on('add_message', function (message) {
        console.log(message);
        request.post({
            url: 'http://painchat-api.loc/api/messages',
            json: message,
        }, function (error, response, json) {
            console.log(json);
        })
    });

    socket.on('disconnect', function () {
        console.log('user disconnected');
    });
});

redis.psubscribe('*', function (error, count) {

});

redis.on('pmessage', function (pattern, channel, message) {
    var message = JSON.parse(message);
    console.log(channel + ':' + message.event);
    io.emit(channel + ':' + message.event, message.data.message);
});
