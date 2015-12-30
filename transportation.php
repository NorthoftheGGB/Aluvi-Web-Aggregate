<?php
require('vendor/autoload.php');
require('database.php');

$link_key = $_GET['token'];
$result = mysqli_query($users_con, $q = "select * from users where link_key = '$link_key'");
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
		// update the cookie and the stored key
		// this also expires the link as a side effect
		$factory = new RandomLib\Factory;
		$generator = $factory->getMediumStrengthGenerator();
		$session_key = $generator->generateString(32, '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
		mysqli_query($users_con, $q = "update users set cookie_key='$session_key' where email = '${row['email']}'");
		setcookie('aluvi_token', $session_key, time() + 30*60);
		require('transportation_preferences.php');
	}
}
