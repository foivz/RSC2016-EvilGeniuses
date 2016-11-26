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

    <title>Questions</title>

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
           
                
               <h2>Questions</h2>
               <p><a href="#" class="btn btn-primary">Create new question</a> <a href="yourQuizzes.php" class="btn btn-success">Back to quiz list</a> 
                <div class="panel-group" id="accordion">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                            </span><b>Question 1:</b> When was the first quiz created?</a>
                        </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <table class="table">
                                <tr>
                                    <td>
                                        <b>Type:</b> Text
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <b>Answer:</b> 1965 December 8th 
                                    </td>
                                </tr>
                              
                                <tr>
                                    <td>
                                        <b>Points:</b> 2 
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <a href="#" class="btn btn-success">Edit</a> <a href="#" class="btn btn-danger">Delete</a> 
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
                            </span><b>Question 2:</b> Whats is this?</a>
                        </h4>
                    </div>
                    <div id="collapse2" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <table class="table">
                                <tr>
                                    <td>
                                        <b>Type:</b> Image
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <img src="https://745515a37222097b0902-74ef300a2b2b2d9e236c9459912aaf20.ssl.cf2.rackcdn.com/6b730d0ec04d03e62ee09c44b72d94d9.jpeg">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <b>Answer:</b> Telegraph 
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <b>Points:</b> 2 
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <a href="#" class="btn btn-success">Edit</a> <a href="#" class="btn btn-danger">Delete</a> 
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
                            </span><b>Question 3:</b> Which L. v. Beethoven symphony this is?</a>
                        </h4>
                    </div>
                    <div id="collapse3" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <table class="table">
                                <tr>
                                    <td>
                                        <b>Type:</b> Audio
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td>
                                      <audio controls>
                                        <source src="https://archive.org/download/beethovenbeethoven_s9thclip/BeethovensSymphonyNo.9Scherzo.ogg" type="audio/ogg">
                                        
                                      Your browser does not support the audio element.
                                      </audio> 
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <b>Answer :</b> 9 
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <b>Points:</b> 5 
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <a href="#" class="btn btn-success">Edit</a> <a href="#" class="btn btn-danger">Delete</a> 
                                    </td>
                                </tr>
                            </table>
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

</body>

</html>
