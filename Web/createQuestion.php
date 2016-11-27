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

    <title>Create a question</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">

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
            <div class="col-lg-12">
                <h1>Question creation page</h1>
                <p class="lead"></p>
                <p>
                <p>  Type:
                <p><input type="radio" name="type" id="cQuestionType" value="0" /> Text  
                <p><input type="radio" name="type" id="cQuestionType" value="1" /> Image
                
              
            
                <p>Title of the question <p><input type='text' id="cQuestion" name='name'><p><p>
                Answer <p><input type='text' id="cAnswer" name='answer'><p>
                Point <p><input type='int' id="cPoints" name='points'><p>
                <input type='submit' value='Save' class='btn btn-success' onclick="socket.emit('addQuestion', {
		'type':document.getElementById('cQuestionType').value,
		'question':document.getElementById('cQuestion').value,
		'answer':document.getElementById('cAnswer').value,
		'points':document.getElementById('cPoints').value})">
                <a href="questions.php" class="btn btn-primary">Go back</a>
                
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
<script src="socket.js"></script>
<script>
  var socket = io.connect('http://161.53.120.82:3000');
     socket.emit('register', '56456');
   socket.on('registrationResponse', function (data) {

  });

socket.on('addQuestionResponse', function (data) {
   	console.log("Success");
   	window.location.href = "questions.php";

   		
  });



</script>

</body>

</html>
