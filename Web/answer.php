<!DOCTYPE html>
<head>
<link href="css/bootstrap.css" rel="stylesheet"">
  <title>Make Quizes Great Again!</title>
  
      <link rel="stylesheet" href="css/style.css">
<script>
    window.addEventListener("load", function() {
      var camera = document.getElementById("camera");
      var play = document.getElementById("play");
      var pause = document.getElementById("pause");
      var stop = document.getElementById("stop");
      var constraints = {audio:true, video:true};

      function success(stream) {
        camera.src = stream;
        camera.play();
        disableButtons(true, false, false);
      }

      function failure(error) {
        alert(JSON.stringify(error));
      }

      function disableButtons(disPlay, disPause, disStop) {
        play.disabled = disPlay;
        pause.disabled = disPause;
        stop.disabled = disStop;
      }

      disableButtons(true, true, true);

      if (navigator.getUserMedia)
        navigator.getUserMedia(constraints, success, failure);
      else
        alert("Your browser does not support getUserMedia()");

      play.addEventListener("click", function() {
        disableButtons(true, false, false);
        camera.play();
      }, false);

      pause.addEventListener("click", function() {
        disableButtons(false, true, false);
        camera.pause();
      }, false);

      stop.addEventListener("click", function() {
        disableButtons(true, true, true);
        camera.pause();
        camera.src = "";
      }, false);
    }, false);
  </script>

<style>
#container {
margin: 0px auto;
width: 500px;
height: 375px;
border: 10px #333 solid;
}
#videoElement {
width: 500px;
height: 375px;
background-color: #666;
}
</style>
</head>
<body>
<div class="wrapper">
<button class="btn" onclick="show();">Record!</button>


<div id="record" style="display:none; text-align:center;">
<div id="container">
<video autoplay="false" id="videoElement">
</video>
</div>
<button id="play">Play</button>
  <button id="pause">Pause</button>
  <button id="stop">Stop</button>
  <br />
  <video id="camera"></video>
<source src="love.mp3" type="audio/mpeg">
Your browser does not support the audio element.
</audio>
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


<script src="http://code.jquery.com/jquery.js"></script>
<script src="js/bootstrap.js"></script>
<script>

var video = document.querySelector("#videoElement");

navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia ||    navigator.mozGetUserMedia || navigator.msGetUserMedia || navigator.oGetUserMedia;

if (navigator.getUserMedia) {       
navigator.getUserMedia({video: true, audio: true}, handleVideo, videoError);
}

function handleVideo(stream) {
video.src = window.URL.createObjectURL(stream);
document.getElementById("videoElement").pause();
}

function videoError(e) {
alert("There was an error with the video stream.\nCheck that your webcam is connected.");
}

function play()
{
var video = document.getElementById("videoElement");
var music = document.getElementById("song");
   var button = document.getElementById("play");
   if (video.paused) {
      video.play();
      music.play();
      button.textContent = "Stop Recording";
   } else {
      video.pause();
      music.pause();
      button.textContent = "Continue Recording";
   }
}

function show()
{
document.getElementById("record").style.display="block";
}
</script>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    <script src="js/index.js"></script>
</body>

</html>