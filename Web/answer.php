<!DOCTYPE html>
<head>
<link href="css/bootstrap.css" rel="stylesheet"">
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

<button class="btn" onclick="show();">Record!</button>


<div id="record" style="display:none; text-align:center;">
<div id="container">
<video autoplay="false" id="videoElement">
</video>
</div>
<button id="play" class="btn" onclick="play()">Start Recording!</button>
<audio id="song" style="hidden">
<source src="love.mp3" type="audio/mpeg">
Your browser does not support the audio element.
</audio>
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
</body>