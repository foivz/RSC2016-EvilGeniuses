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
    <link rel="stylesheet" href="css/style1.css">

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
                <a class="navbar-brand" href="#">Quisar</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="wrapper">
    <div class="container">

        <div class="row">
            <div class="col-lg-8 text-center">
                <h1>This is a moderator's page</h1>
                <p class="lead">You are moderating Quiz 1</p>
                <table  class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Question</th>
                        <th>Answer</th>
                        <th>Points</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody id="games">
                      
                    </tbody>
                  </table>
                <button type="button" class="btn btn-danger" onclick="socket.emit('endGame')">End Game</button>
                <button type="button" class="btn btn-success" onclick="socket.emit('newQuestion', {'questionId':document.getElementById('questionId').value})">Display New Question</button>
	              <input id="questionId" type="text" name="questionId" placeholder="Enter your questionId">
                        <h4>Timer  </h4>
                        <p><div class="progress" style="margin:auto;float:none; width:40%;">
                          <div class="progress-bar progress-bar-success " role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
                            <span class="sr-only"></span>
                          </div>
                        </div>
                <h1 id="bigtext" style="padding-top:20px;"></h1>
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
   socket.emit('register', '2');
   
   socket.emit('requestAllQuestions');
  
  socket.on('requestAllQuestionsResponse', function(data) {
          console.log(data);
          var div = document.getElementById('games');
  while (div.firstChild) {
      div.removeChild(div.firstChild);
  }
   	for(var i = 0; i < data.length; i++)
   	{
   		var game = data[i];
   		 console.log(game);

      var id = "<td>"+game.id+"</td>"
      var name = "<td>"+game.question+"</td>"
      var answer ="<td>"+game.answer+"</td>"
      var points = "<td>"+game.points+"</td>"
      var buttons = "<td><button  type=\"button\" id=\"joinbutton\"  class=\"btn btn-danger\">Delete</button></td>"
      var html = "<tr>"+id+name+answer+points+buttons+"</tr>"




   		div.innerHTML = div.innerHTML + html;
    	//document.getElementById("games").appendChild(node);
   	}
  });  
   socket.on('registrationResponse', function (data) {

  });
  
  socket.on('gameResult', function (data) {
   var myNode = document.getElementById("bigtext");
    myNode.innerHTML = data;
  });


socket.on('submitanswerResponse', function (data) {
   	console.log(data);
  });

   socket.on('moderatorOnSumbit', function (data) {
   	console.log(data);
    console.log("User " + data["user"] + " submitted answer " + data["answer"]);

  });



</script>

<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    <script src="js/index.js"></script>
</body>

</html>
