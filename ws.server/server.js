var request = require('request');
var io = require('socket.io')(6001, {
    origins: 'painchat-api.loc:*'
});
var Redis = require('ioredis');
var redis = new Redis();

io.use(function (socket, next) {
    request.get({
        url: 'http://painchat-api.loc/ws/check-auth',
        headers: {cookie: socket.request.headers.cookie},
        json: true
    }, function (error, respose, json) {
        console.log(json);
    })
});

redis.psubscribe('*', function (error, count) {

});

redis.on('pmessage', function (pattern, channel, message) {
    var message = JSON.parse(message);
    io.emit(channel + ':' + message.event, message.data.message);
});