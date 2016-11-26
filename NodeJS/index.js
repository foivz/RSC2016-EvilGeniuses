var io = require('socket.io')();
console.log("Server started")

var users = [];

io.on('connection', function(client)
{ 
	client.on('disconnect', function () {
        removeUser(client);
        displayArray();
    });
    
	if(isUserRegistered(client))
	{
		console.log("Old user message " + simpleStringify(client));
	}
	else
	{
		console.log("New user " + simpleStringify(client));
		users.push(client);
		displayArray();
		client.emit('welcome');
	}

	client.on('submitanswer', function (data) {

    	console.log(data);

	});


	
});

io.listen(3000);



function isUserRegistered(client)
{
	for(var i = 0;i < users.length;i++)
	{
		if(users[i] == client)
			return true;
	}
	return false;
}

function removeUser(client)
{
	for(var i = 0;i < users.length;i++)
	{
		if(users[i] == client)
		{
			users.splice(i,1);
			break;
		}
	}
}



function displayArray() {
	for(var i = 0;i < users.length;i++)
	{
		console.log(simpleStringify(users[i]));
	}
}

function simpleStringify (object){
    var simpleObject = {};
    for (var prop in object ){
        if (!object.hasOwnProperty(prop)){
            continue;
        }
        if (typeof(object[prop]) == 'object'){
            continue;
        }
        if (typeof(object[prop]) == 'function'){
            continue;
        }
        simpleObject[prop] = object[prop];
    }
    return JSON.stringify(simpleObject); // returns cleaned up JSON
};