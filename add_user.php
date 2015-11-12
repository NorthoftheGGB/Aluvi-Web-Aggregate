<?php
$conn = mysql_connect("aluvi1.cr8zsnsf7jfy.us-west-2.rds.amazonaws.com", "master", "^cy*(b%ji%i", "aluvidb", 3306);
if (!$conn) {
	echo "Could not establish connection to database";
	exit;
} 
$email = $_POST['email'];
$name = $_POST['name'];
$zip = $_POST['zip'];
$driver = 0 + $_POST['driver'];
mysql_query("insert into users values('$name', '$email', '$zip', $driver");
if ($e = mysql_error()){
    echo "<!--$e--><h1></h1>";
}
else include "map.html";