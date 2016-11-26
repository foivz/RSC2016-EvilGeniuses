var io = require('socket.io')();
io.on('connection', function(client)
{ 
	console.log("Message received from " + client);

	socket.on('submitanswer', function (from, msg)
	{
		console.log('Submit Answer')

	})





});
io.listen(3000);

