<?php
require('database.php');

$link_key = $_GET['token'];
$result = mysqli_query($users_con, $q = "select * from users where link_key = '$link_key'");
echo $q;
if(mysqli_num_rows($result) == 0){
	require('invalid_link.php');
	exit;
} else {
	$cookie_key = $_COOKIE['aluvi_token'];
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	if(strcmp($cookie_key, $row['cookie_key']) != 0){
		require('expired_link.php');
		exit;
	} else {
		$user = $row;	
		require('transportation_preferences.php');
	}
}
