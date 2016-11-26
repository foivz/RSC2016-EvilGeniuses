<?php
session_start();

$description = $_POST['description'];
$name = $_POST['name'];
$venue = $_POST['venue'];
$email = $_POST['email'];

echo '$description';
$creator = $_SESSION['userName'];

include ("php/misc.inc");
$connection = mysql_connect($host,$user,$password) 
or die ("Cannot conect to the server");
$db = mysql_select_db($database,$connection)
or die ("No database found");
$query = "";//INSERT INTO subCategories VALUES (NULL, '$name', '$tableName', '$description', '$t', '$subject', '$picture', '$creator' )"; 
$result = mysql_query($query)
or die ("Cannot execute the query");                                                    

echo '<meta http-equiv="refresh" content="0; url="yourQuizzes.php">';   
?>