<?php
$con = mysqli_connect("aluvi1.cr8zsnsf7jfy.us-west-2.rds.amazonaws.com", "master", "^cy*(b%ji%i", "aluvidb", 3306);
if (!$con) {
	echo "Could not establish connection to database";
	exit;
}
mysqli_select_db($con, "glassdoor");
