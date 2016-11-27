<!DOCTYPE html>
<html lang="en">

<head>
  <title>Make Quizes Great Again!</title>
  
      <link rel="stylesheet" href="css/style.css">

</head>

<body style="background-color:#61E9B1;">

<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '999832093495523',
      xfbml      : true,
      version    : 'v2.8'
    });
  };
                         (function(d, s, id){
                             var js, fjs = d.getElementsByTagName(s)[0];
                             if (d.getElementById(id)) {return;}
                             js = d.createElement(s); js.id = id;
                             js.src = "//connect.facebook.net/en_US/sdk.js";
                             fjs.parentNode.insertBefore(js, fjs);
                         }(document, 'script', 'facebook-jssdk'));
                     </script>
                     <div class="fb-login-button" data-max-rows="1" data-size="large" data-show-faces="false" data-auto-logout-link="false"></div>               
  <div class="wrapper">
	<div class="container1">
		<h1>Welcome</h1>
		
		<form class="form">
			<input type="text" placeholder="Username">
			<input type="password" placeholder="Password">
			<button type="submit" id="login-button" onclick="window.location.href='http://161.53.120.82/joinQuizzes.php'">Login</button>

<div
  class="fb-like"
  data-share="true"
  data-width="450"
  data-show-faces="true">
</div>

			<!--button onclick="window.location.href='http://161.53.120.82/joinQuizzes.php'" type="submit" id="login-button">Login</button-->
		</form>
	</div>
	
	<ul class="bg-bubbles">
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
	</ul>
</div>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    <script src="js/index.js"></script>
</body>

</html>
