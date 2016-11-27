var io = require('socket.io')();
var mysql = require('mysql');
var connection = mysql.createConnection({
  host     : 'localhost',
  user     : 'root',
  password : 'root',
  database : 'data'
});
connection.connect();
console.log("Server started")

var users = [];

var games = [];



var newGame = {
		"id":makeid(),
		"name":"QuTest",
		"moderators":[],
		"users": [],
		"status":"setup",
		"description":"The best quiz about your fav. actor",
		"venue":"Mexicana",
		"contact":"antonio.banderas@gmail.com",
		"questions":[]
};
newGame.questions.push({"id":0,"type":0,"question":"Is nodeJS cool","answer":"true","points":5});
newGame.questions.push({"id":1,"type":1,"question":"Whats the first NodeJS letter","answer":"N","points":25});
games.push(newGame);

newGame = {
		"id":makeid(),
		"name":"Znapi Tasteri",
		"moderators":[],
		"users": [],
		"status":"setup",
		"description":"Memes will rule the world",
		"venue":"Hogwars",
		"contact":"Sneazy.banderas@gmail.com",
		"questions":[]
};
newGame.questions.push({"id":0,"type":0,"question":"Does the chichken want to cross the road?","answer":"false","points":5});
newGame.questions.push({"id":1,"type":1,"question":"Mamamia is a song made by","answer":"ABBA","points":25});
games.push(newGame);

/*
GAME:
{
	"id":"id",
	"name":"Name",
	"users": [],
	"status":"running",
	questions:[]
}

STATUS
setup
running
ended

QUESTION:
{
	"type":"",
	"question":"",
	"answer":""
	"points":""
}


USER:
{
	"client":"",
	"type":"",
	"game":""
}

ANSWER
{
	"id":"",
	"answer":"",
	"type":""
}


TYPES 
0 - True False
1 - Enter Keyword

*/

io.on('connection', function(client)
{ 
	sendGameList(client);
	client.on('disconnect', function () {
        removeUser(client);
        displayArray();
    });


	client.on('submitanswer', function (data) {
    	console.log("Got submit answer : " + data);
    	submitanswer(client, {user:client["id"],answer:data});
	});

	client.on('joinGame', function (data) {
    	console.log("Got join game : " + data);
    	joingame(client, data, false);
	});

	client.on('moderateGame', function (data) {
    	console.log("Got moderate game : " + data);
    	joingame(client, data, true);
	});

	client.on('gameList', function () {
    	console.log("Got game list request ");
    	sendGameList(client);
	});

	client.on('requestAllQuestions', function () {
    	console.log("Got game list request ");
    	var game = games[0];
    	client.emit('requestAllQuestionsResponse', game.questions);
	});

	client.on('addQuestion', function (data) {
    	console.log("Got game list request ");
    	var game = games[0];
    	game.questions.push({"id":game.questions.length,"type":data.type,"question":data.question,"answer":data.answer,"points":data.points,"time":10})
    	client.emit('addQuestionResponse');

	});

	client.on('endGame', function () {
    	console.log("Got game list request ");
    	endGame(client);
	});

	client.on('leaveGame', function () {
    	console.log("Got game list request ");
    	leaveGame(client);
	});

	client.on('startgame', function (data) {
    	console.log("Start game");
    	startgame(client);
	});

	client.on('newQuestion', function (data) {
    	console.log("New question " + data);
    	displayNewQuestion(client,data);
	});

	client.on('createGame', function (data) {
    	createGame(client,data);
	});


	client.on('register', function (data) {

		if(data == null)
		{
			client.emit('registrationResponse', {status:"No ID"});
			return;
		}
			
		if(!isUserRegistered(client))
		{
			console.log("Newuser " + simpleStringify(client));
			console.log(data)
			connection.query('SELECT points,game,moderator FROM users WHERE id='+ data, function(err, rows, fields)   
			{  
			  if (err) throw err;  
			  console.log(rows[0])
			  if(rows[0] == null)
			  {

			  		client.emit('registrationResponse', {status:"Doesnt exist"});
			  } 
			  else
			  {
			  	var dataToPush = {"id":data,"client":client,"points":rows[0].points,"answeredQuestions":[]}
			  	var mod = false;

			  	if(rows[0].moderator == 1)
			  		mod = true;


			  	users.push(dataToPush);
			  	client.emit('registrationResponse', {status:"Success"});
					sendGameList(client);
			  	if(rows[0].game != null)
			  		addUserToGame(rows[0].game,getUser(client),mod);
			  		
					
			  }
			}); 			
		} 	
		else
		{
			client.emit('registrationResponse', {status:"Already exists"});
		}
	});
	
});

io.listen(3000);

function leaveGame(client)
{
	var user = getUser(client);
	if(user == null || user["game"] == null )
		return;

	var game = getGame(user["game"]);

	for(var i = 0; i < game.users.length; i++)
	{
		if(game.users[i].client == client)
		{
			game.users.splice(i,1);
			break;
		}
	}

	user.game = null;
	connection.query('UPDATE users SET game ="" WHERE id='+ user.id +'', function(err, rows, fields)   {client.emit('leaveGameResponse');});

	

}

function createGame(client,data)
{
	var user = getUser(client);
	if(user == null || user["game"] != null )
		return;

	var game = getGameViaName(data.name);
	if(game != null)
	{
		console.log("Game already exists")
		return;
	}




	var newGame = {
		"id":makeid(),
		"name":data.name,
		"moderators":[],
		"users": [],
		"status":"setup",
		"description":data.description,
		"venue":data.venue,
		"contact":data.contact
	};

	client.emit('createGameResponse');
	user.game = newGame.id;
	newGame.moderators.push(user);
	games.push(newGame);
		connection.query('UPDATE users SET game ="'+ newGame.id +'",moderator="1" WHERE id='+ user.id +'', function(err, rows, fields)   {});
	for(var i = 0; i < users.length; i++)
		{
			sendGameList(users[i]["client"]);
		}
}

function makeid()
{
    var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

    for( var i=0; i < 5; i++ )
        text += possible.charAt(Math.floor(Math.random() * possible.length));

    return text;
}

function endGame(client)
{
	var user = getUser(client);
	if(user == null || user["game"] == null || user["game"].length == 0)
		return;
	console.log('user good')
	var game = getGame(user["game"]);
	if(game == null || game["status"] != "running")
		return;
	console.log('game good')
	if(isModerator(user,game))
	{
		console.log('moderator good')
		game.status = "ended";
		var Winner = AnalizeWinner(game);
		if(Winner == null)
			sendMessageToAllGame(game, "gameResult", "There is no winner");
		else
			sendMessageToAllGame(game, "gameResult", "Winner is " + Winner.id);
		for(var i = 0; i < game.users.length; i++) 
		{
			game.users.game = null;
			game.users.answeredQuestions = [];
		}

		for(var i = 0; i < game.moderators.length; i++)
		{
			game.moderators.game = null;
			game.users.answeredQuestions = [];
		}

		for(var i = 0; i < users.length; i++)
		{
			sendGameList(users[i]["client"]);
		}
		user.game = null;
		connection.query('UPDATE users SET game ="",moderator="0" WHERE id='+ user.id +'', function(err, rows, fields)   {});
	}

}

function sendMessageToAllGame(game, type, message)
{

	for(var i = 0; i < game.users.length; i++)
	{
		game.users[i].client.emit(type,message);
	}
	for(var i = 0; i < game.moderators.length; i++)
	{
		game.moderators[i].client.emit(type,message);
	}

}

function AnalizeWinner(game)
{
	var bestUser = game.users[0];
	console.log(bestUser)
	for(var i = 0; i < game.users.length; i++)
	{
		var User = game.users[i];
		console.log(User.answeredQuestions.length + "  -  " + bestUser.answeredQuestions.length)
		if(User.answeredQuestions.length > bestUser.answeredQuestions.length)
			bestUser = User;
	}
	return bestUser;
}

function displayNewQuestion(client, data)
{
	var user = getUser(client);
	if(user == null || user["game"] == null || user["game"].length == 0)
		return;
	console.log("User correct")
	var game = getGame(user["game"]);

	if(game == null || game["status"] != "running")
		return;
	console.log("Game correct")
	if(isModerator(user,game))
	{
		console.log("User is  mod")
		for(var i = 0; i < game["users"].length; i++)
		{
			console.log("Sending question " + game["questions"][data.questionId])
			game["users"][i]["client"].emit('newQuestion', game["questions"][data.questionId]);
		}
	}

}


function isModerator(user, game)
{
	for(var i = 0; i < game["moderators"].length; i++)
	{
		console.log(user.id +  "   " + game["moderators"][i].id);
		if(user.id == game["moderators"][i].id)
			return true;
	}
	return false;
}

function startgame(client)
{
	var user = getUser(client);
	if(user == null || user["game"] == null)
		return;

	var game = getGame(user["game"]);
	if(game == null)
		return;


	var userFound = false;
	for(var i = 0; i < game["moderators"].length; i++)
	{
		var thisuser = game["moderators"][i];
		if(thisuser["client"] == client)
		{
			userFound = true;
			break;
		}
	}

	if(userFound)
	{
		client.emit('startGameResponse');
		game.status = "running";
		for(var i = 0; i < users.length; i++)
		{
			users[i]["client"].emit('startGameResponse');
			sendGameList(users[i]["client"]);
		}
	}

}

function sendGameList(client)
{
	var dataToSend = [];

	for(var i = 0; i < games.length; i++)
	{
		var thisgame = games[i];
		dataToSend.push({'id':thisgame['id'],'name':thisgame['name'],'status':thisgame['status'],'contact':thisgame.contact,'description':thisgame.description,'venue':thisgame.venue})
	}
	console.log(dataToSend)
	client.emit('gameListResponse', dataToSend);
	console.log("send")
}

function submitanswer(client, data) {

	var user = getUser(client);
	if(user == null) return;

	var game = getGame(user["game"]);
	if(game != null && game["status"] == "running")
console.log(data)
		console.log(data["answer"]["id"])
	console.log(game["questions"]);

	var question = game["questions"][data["answer"]["id"]];
	
	if(question == null)
	{
		console.log("Questio does not exist")
		return;
	}

	console.log(question);

	if(user.answeredQuestions.indexOf(question) > -1)
		return;

	if(question.type == 0 || question.type == 1 )
	{
		console.log("Tipas yra 0")

		if(data.answer.answer == question.answer)
		{
			user.points += question.points;
			user.client.emit('pointsUpdate',user.points);
			user.client.emit('submitanswerResponse', 'Correct answer')
			user.answeredQuestions.push(question);
			connection.query('UPDATE users SET points = "'+user.points + '" WHERE id='+ user.id +'', function(err, rows, fields)   {});
 


		}
		else
		{
			user.client.emit('submitanswerResponse', 'Wrong answer')
		}
	}



	sendMessageToModerators(game["id"], data);
}



function joingame(client, data, moderate)
{
	var user = getUser(client);
	if(user == null)
	{
		client.emit('joinGameResponse',{status:"You are not registered"})
		return;
	}

	if(user["game"] != null && user["game"].length > 0)
	{
		client.emit('joinGameResponse',{status:"You are already in game"})
		return;
	}

	console.log("da " + data)
	var game = getGame(data);

	if(game == null)
	{
		client.emit('joinGameResponse',{status:"Game does not exist"})
		return;
	}

	if(game["status"] == "running" || game["status"] == "ended")
	{
		client.emit('joinGameResponse',{status:"Wrong game status : " + game["status"]})
		return;
	}
	console.log(moderate + " 2")
	addUserToGame(data, user, moderate);
}

function sendMessageToModerators(gameId, data) {
	console.log("Going to send to all moderators")
	var Game = getGame(gameId);
	if(Game == null) return;
	console.log("Game found. Searching for mods")
	for(var i in Game["moderators"])
	{
			
		var user = Game["moderators"][i];
		console.log(user)


			console.log("Found moderator, sending . " + user["client"]["id"]);
			//io.clients[user["client"]["id"]].emit('moderatorOnSumbit',{data: data})
			if (io.sockets.connected[user["client"]["id"]]) {

				console.log(data);
    			io.sockets.connected[user["client"]["id"]].emit('moderatorOnSumbit',data)
			}
			console.log("Sent");
		
	}

}


function getGameViaName(name)
{

	for(var i = 0; i < games.length; i++)
	{
		var Game = games[i];
		if(Game["name"] == name)
		{
			return Game;
		}

	}
	return null;
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

function addUserToGame(id, user, moderate)
{
		
		console.log(moderate)
		var Game = getGame(id);
		if(Game == null)
			return;

		
		if(moderate == false)
		{
			var query = 'UPDATE users SET game="'+ id + '",moderator="0" WHERE id='+ user.id +'';
			console.log(query)
			connection.query(query, function(err, rows, fields)   {});
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
				console.log("Normal User registered to game " + id);
				user["client"].emit('joinGameResponse',{status:"Success"})
			}
		}
		else
		{
			var query = 'UPDATE users SET game="'+ id + '",moderator="1" WHERE id='+ user.id +'';
			console.log(query)
			connection.query(query, function(err, rows, fields)   {});
			var userAlreadyExists = false;
			for(var j = 0; j < Game["moderators"].length;j++)
			{
				var GameUser = Game["moderators"][j];
				if(GameUser["client"] == user["client"])
				{
					userAlreadyExists = true;
					break;
				}
			}

			if(!userAlreadyExists)
			{
				user["game"] = id;
				Game.moderators.push(user);
				console.log("Mod  User registered to game " + id);
				user["client"].emit('joinGameResponse',{status:"Success"})
			}

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