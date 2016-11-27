<!DOCTYPE html>
<html lang="en">
<?php
 session_start();
?>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Host a quiz</title>

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
                <a class="navbar-brand" href="#">Quisar</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="yourQuizzes.php">Your Quizzes</a>
                    </li>
                    <li>
                        <a href="joinQuizzes.php">Participate</a>
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
                <div class="container">
                  <h2>Your quizzes</h2> 
                  <a class="btn btn-primary btn-xl" href="createQuiz.php" >Create new quiz</a>
                  <p></p>            
                  <table class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Venue</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody id="games">
                      <tr>
                        <td>Quiz 1</td>
                        <td>A quiz about quizzes</td>
                        <td>Baker st. 55, London</td>
                        <td>john@example.com</td>
                        <td><a href="questions.php?name=Quiz1" type="button" onclick="socket.emit('startgame')" class="btn btn-warning">START</a> <a href="questions.php?name=Quiz1" class="btn btn-info">QUESTIONS</a></td>
                      </tr>
                    </tbody>
                  </table>
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
   socket.on('registrationResponse', function (data) {
         console.log("connected");
  });
    socket.on('startGameResponse', function (data){
        console.log("game started");
        window.location.href = "moderatorPage.php";
    });

   	socket.on('gameListResponse', function(data){

   	var div = document.getElementById('games');
  while (div.firstChild) {
      div.removeChild(div.firstChild);
  }
   	for(var i = 0; i < data.length; i++)
   	{
   		var game = data[i];
   		 console.log(game);

      var id = "<td>"+game.id+"</td>"
      var name = "<td>"+game.name+"</td>"
      var descr ="<td>"+game.description+"</td>"
      var venue = "<td>"+game.venue+"</td>"
      var contact = "<td>"+game.contact+"</td>"
      var status = "<td>"+game.status+"</td>"
      var button = "<td><button  type=\"button\" id=\"joinbutton\" onclick=\"socket.emit('startgame')\" class=\"btn btn-success\">Start Quiz</button> "
      var butt = "<button type=\"button\" class=\"btn btn-info\" onclick=\"socket.emit('moderateGame','"+game.id+"')\">Moderate game</button> "
      var butty = "<a href=\"questions.php\" type=\"button\" class=\"btn btn-warning\" >Questions</a></td>";
      
      var html = "<tr>"+id+name+descr+venue+contact+status+button+butt+butty+"</tr>"

   		div.innerHTML = div.innerHTML + html;
   	}
   });



</script>

</body>

</html>
