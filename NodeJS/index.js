var io = require('socket.io')();
console.log("Server started")

var users = [];

var games = [];


games.push({
	"id":"jlHSgasgn",
	"name":"TestGame",
	"users": [],
	"status":"running"
})

/*
GAME:
{
	"id":"id",
	"name":"Name",
	"users": [],
	"status":"running"
}

USER:

{
	"client":"",
	"type":"",
	"game":""
}




*/

io.on('connection', function(client)
{ 
	client.on('disconnect', function () {
        removeUser(client);
        displayArray();
    });


	client.on('submitanswer', function (data) {
    	console.log("Got submit answer : " + data);
    	submitanswer(client, {user:client["id"],answer:data});
	});

	client.on('register', function (data) {
		if(!isUserRegistered(client))
		{
			console.log("New user " + simpleStringify(client));
			users.push({"client":client,"type":data["type"]});
			addUserToGame("jlHSgasgn", getUser(client));
			displayArray();
			client.emit('registrationResponse', {status:"Success"});
		} 	
		else
		{
			client.emit('registrationResponse', {status:"Already exists"});
		}
	});
	
});

io.listen(3000);


function submitanswer(client, data) {
	var user = getUser(client);
	if(user == null) return;

	var game = getGame(user["game"]);
	if(game != null && game["status"] == "running")

	sendMessageToModerators(game, data);
}

function sendMessageToModerators(gameId, data) {
	console.log("Going to send to all moderators")
	var Game = getGame(gameId);
	if(Game == null) return;
	console.log("Game found. Searching for mods")


	for(var i in Game["users"])
	{
			
		var user = Game["users"][i];
		if(user["type"] == "moderator")
		{
			console.log("Found moderator, sending . " + user["client"]["id"]);
			//io.clients[user["client"]["id"]].emit('moderatorOnSumbit',{data: data})
			if (io.sockets.connected[user["client"]["id"]]) {

				console.log(data);
    			io.sockets.connected[user["client"]["id"]].emit('moderatorOnSumbit',data)
			}
			console.log("Sent");
		}
	}

}

function getGame(id)
{

	for(var i = 0; i < games.length; i++)
	{
		var Game = games[i];
		if(Game["id"] == id)
		{
			return Game;
		}

	}
	return null;
}

function addUserToGame(id, user)
{

		var Game = getGame(id);

			var userAlreadyExists = false;
			for(var j = 0; j < Game["users"].length;j++)
			{
				var GameUser = Game["users"][j];
				if(GameUser["client"] == user["client"])
				{
					userAlreadyExists = true;
					break;
				}
			}

			if(!userAlreadyExists)
			{
				user["game"] = id;
				Game["users"].push(user);
				console.log("User registered to game " + id);
			}	
}



function isUserRegistered(client)
{
	for(var i = 0;i < users.length;i++)
	{
		if(users[i]["client"] == client)
			return true;
	}
	return false;
}

function removeUser(client)
{
	for(var i = 0;i < users.length;i++)
	{
		if(users[i]["client"] == client)
		{
			users.splice(i,1);
			break;
		}
	}
}

function getUser(client)
{
	for(var i = 0;i < users.length;i++)
	{
		if(users[i]["client"] == client)
		{
			return users[i];
		}
	}
	return null;
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