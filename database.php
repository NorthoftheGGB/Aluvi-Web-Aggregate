<?php
$con = mysqli_connect("aluvi1.cr8zsnsf7jfy.us-west-2.rds.amazonaws.com", "master", "^cy*(b%ji%i", "aluvidb", 3306);
if (!$con) {
	echo "Could not establish connection to database";
	exit;
}
mysqli_select_db($con, "glassdoor");

$users_con = mysqli_connect("aluvi1.cr8zsnsf7jfy.us-west-2.rds.amazonaws.com", "master", "^cy*(b%ji%i", "aluvidb", 3306);
if (!$con) {
	echo "Could not establish connection to database";
	exit;
}
mysqli_select_db($users_con, $context."_users");
if ($result = mysqli_query($users_con, "SELECT DATABASE()")) {
    $row = mysqli_fetch_row($result);
    printf("<!--Default database is %s.\n-->", $row[0]);
    mysqli_free_result($result);
}
