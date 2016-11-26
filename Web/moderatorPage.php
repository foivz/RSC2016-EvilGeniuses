<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Moderator page</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
    body {
        padding-top: 70px;
        /* Required padding for .navbar-fixed-top. Remove if using .navbar-static-top. Change if height of navigation changes. */
    }
    </style>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Start Bootstrap</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="#">About</a>
                    </li>
                    <li>
                        <a href="#">Services</a>
                    </li>
                    <li>
                        <a href="#">Contact</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container">

        <div class="row">
            <div class="col-lg-12 text-center">
                <h1>This is a moderator's page</h1>
                <p class="lead">You are moderating Quiz 1</p>
                <button type="button" class="btn btn-danger" onclick="socket.emit('endGame')">End Game</button>
                <button type="button" class="btn btn-success" onclick="socket.emit('newQuestion', {'questionId':document.getElementById('questionId').value})">Display New Questions</button>
	              <input id="questionId" type="text" name="questionId" placeholder="Enter your questionId">
                        <h4>Timer  </h4>
                        <p><div class="progress" style="margin:auto;float:none; width:40%;">
                          <div class="progress-bar progress-bar-success " role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
                            <span class="sr-only"></span>
                          </div>
                        </div>
                        <script>
                          var i = 100;
                          
                          
                          var counterBack = setInterval(function(){
                            i--;
                            if (i > 0){
                              
                              $('.progress-bar').css('width', i+'%');
                            } else {
                              clearInterval(counterBack);
                             
                            }
                            
                          }, 1000);
                        </script>
                       <br> <a type="button" class="btn btn-warning" onclick="">End Time Earlier</a> 
                    
                 </div>
                 </div> 
            </div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->

    <!-- jQuery Version 1.11.1 -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <script src="socket.js"></script>
<script>
  var socket = io.connect('http://161.53.120.82:3000');

   socket.on('registrationResponse', function (data) {
    alert("Registration " + data["status"]);

  });

   socket.on('joinGameResponse', function (data) {
    alert("Join game " + data["status"]);

  });


socket.on('newQuestion', function (data) {
   	console.log(data);
   	var myNode = document.getElementById("questions");
	while (myNode.firstChild) {
	    myNode.removeChild(myNode.firstChild);
	}
    console.log("User " + data["user"] + " submitted answer " + data["answer"]);

   		var node = document.createElement("LI");
   		var textnode = document.createTextNode("ID:" + data["id"] + ",TYPE: " + data["type"]  + "   QUESTION:" + data["question"] + "   ANSWER:" + data["answer"]);
   		node.appendChild(textnode);
    	document.getElementById("questions").appendChild(node);
  });


socket.on('submitanswerResponse', function (data) {
   	console.log(data);
  });

   socket.on('moderatorOnSumbit', function (data) {
   	console.log(data);
    console.log("User " + data["user"] + " submitted answer " + data["answer"]);

  });

socket.on('removeQuestion', function (data) {
   	console.log("Should remove");
  });

   socket.on('moderatorOnSumbit', function (data) {
   	console.log(data);
    console.log("User " + data["user"] + " submitted answer " + data["answer"]);

  });

   socket.on('pointsUpdate', function (data) {
   	console.log("Now i have " + data);
  });

   socket.on('gameResult', function (data) {
   	console.log("Game result " + data);
  });

   	socket.on('gameListResponse', function(data){
   	console.log(data.length);
   	var myNode = document.getElementById("games");
	while (myNode.firstChild) {
	    myNode.removeChild(myNode.firstChild);
	}
   	for(var i = 0; i < data.length; i++)
   	{
   		var game = data[i];
   		 console.log(game);
   		var node = document.createElement("LI");
   		var textnode = document.createTextNode("ID:" + game["id"]  + "   " + game["status"]);
   		node.appendChild(textnode);
    	document.getElementById("games").appendChild(node);
   	}
   });



</script>

</body>

</html>
