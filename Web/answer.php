<!DOCTYPE html>
<html lang="en">

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
     <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet"/>

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
      <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>

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
                 <p><div style="height: 350px; background-color:#FFC300; border-radius: 4px; margin:auto;">
                        <div class="progress">
                          <div class="progress-bar progress-bar-success" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
                            <span class="sr-only"></span>
                          </div>
                        </div>
                        <script>
                          var i = 100;
                          
                          
                          var counterBack = setInterval(function(){
                            i--;
                            if (i > 0){
                              document.getElementById("timeUp").style.visibility = "hidden";
                              $('.progress-bar').css('width', i+'%');
                            } else {
                              clearInterval(counterBack);
                              document.getElementById("content").style.visibility = "hidden";
                              document.getElementById("timeUp").style.visibility = "visible";
                            }
                            
                          }, 1000);
                        </script>
                      <div id="content">
                        <h1>What is your name?</h1>
                        <p>Text question for <b>5</b> points
                      <form action="server.cgi" method="post" enctype="multipart/form-data">
                        <input type="file" name="image" accept="image/*" capture>
                        <input type="submit" value="Upload">
                      </form>  
                      <div class="form-group">
                        <p><input id="answer" type="text" name="answer" placeholder="Enter your answer" class="form-control" style="margin:auto; width:40%">
                        <p><input id="answerID" type="text" name="answerID" placeholder="Enter answer id" class="form-control" style="margin:auto; width:40%">
                        <p><button type="button" onclick="socket.emit('submitanswer', {'id':document.getElementById('answerID').value,'type':0,'answer':document.getElementById('answer').value})" class="btn btn-info" style="border-radius: 4px; width: 40%;">Submit Answer</button>
                      </div>
                      </div>
                      <div id="timeUp" style="visibility:hidden">
                        <h1>Time's Up!</h1>
                      <div>  
                 </div>   
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
      
    
    socket.on('submitanswerResponse', function (data) {
       	console.log(data);   
      });
    </script>

</body>

</html>
