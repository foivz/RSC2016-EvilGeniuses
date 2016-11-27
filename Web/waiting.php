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

    <title>Answer</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
    body {
        padding-top: auto;
        background-color:black;
        /* Required padding for .navbar-fixed-top. Remove if using .navbar-static-top. Change if height of navigation changes. */
    }
    </style>
     <link href="css/bootstrap.min.css" rel="stylesheet">

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
      <!--<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>-->

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        
    <![endif]-->

</head>

<body>


    <!-- Page Content -->
    <div class="container">

        <div class="row" style="margin:auto">
            <div class="col-lg-8 text-center" style="margin:auto; float:none;">
                 <p><div style="height: 350px; background-color:#009a9a; border-radius: 4px; margin:auto;">
                      <h1 id="bigtext" style="padding-top:20px;">Waiting for the quiz to start</h1>     

                        <div id="dataTable" class="table-responsive">          
                  <table  class="table">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Question</th>
                        <th>Actions</th>
                        <th>Answer</th>
                      </tr>
                    </thead>
                    <tbody id="questions">
                     
                    </tbody>
                  </table>
                  </div>


                    <a type="button" class="btn btn-danger" onclick="socket.emit('leaveGame')" href="joinQuizzes.php">Leave Game</a>   
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
    /*
      var div = document.getElementById("questions");
    var data = {};
    data.id = "a";
    data.question = 'asfafg';




        var id = "<td>"+data.id+"</td>"
      var question = "<td>"+data.question+"</td>"
      var buttons = "<td><button  type=\"button\" id=\"joinbutton\" onclick=\"socket.emit('submitanswer',{'id':'"+data.id+"','answer':'document.getElementById('input"+data.id+"').value''})\" class=\"btn btn-warning\">JOIN</button></td>"
      var input = "<td><input id=\"input"+data.id+"\" type=\"text\" name=\"answer\"></td>"
      var html = "<tr>"+id+question+buttons+input+"</tr>"
      div.innerHTML = div.innerHTML + html;
*/
       var socket = io.connect('http://161.53.120.82:3000');
      
        socket.emit('register', '2');
        socket.on('submitanswerResponse', function (data) {
       	console.log(data);   
      });

socket.on('leaveGameResponse', function () {
        window.location.href = "joinQuizzes.php";
      });

socket.on('gameResult', function (data) {
   var myNode = document.getElementById("bigtext");
    myNode.innerHTML = data;
  });

socket.on('startGameResponse', function(){
    var myNode = document.getElementById("bigtext");
    myNode.innerHTML = "Started";
    
});

socket.on('newQuestion', function (data) {
    console.log(data);
    var div = document.getElementById("questions");
    while (div.firstChild) {
        div.removeChild(div.firstChild);
    }

    var id = "<td>"+data.id+"</td>"
      var question = "<td>"+data.question+"</td>"
      var buttons = "<td><button  type=\"button\" id=\"joinbutton\" onclick=\"socket.emit('submitanswer',{'id':'"+data.id+"','answer':document.getElementById('input"+data.id+"').value})\" class=\"btn btn-success\">Answer</button></td>"
      var input = "<input id=\"input"+data.id+"\" type=\"text\" name=\"answer\">"
      var html = "<tr>"+id+question+buttons+input+"</tr>"
      div.innerHTML = div.innerHTML + html;
  });

    </script>

</body>

</html>
