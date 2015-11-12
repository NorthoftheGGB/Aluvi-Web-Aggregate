<?php
$con = mysqli_connect("aluvi1.cr8zsnsf7jfy.us-west-2.rds.amazonaws.com", "master", "^cy*(b%ji%i", "aluvidb", 3306);
if (!$con) {
	echo "Could not establish connection to database";
	exit;
}
$email = $_POST['email'];
$name = $_POST['name'];
$zip = $_POST['zip'];
$driver = $_POST['driver'];
mysqli_query($con, $q = "insert into users values('$name', '$email', '$zip', $driver)");
if ($e = mysqli_error($con)){
    echo "<!--$e:
    $q-->
    <h1>Sorry!</h1>";
}
else include "map.html";