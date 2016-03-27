<?php
require('vendor/autoload.php');
$context = $_GET['context'];
require('database.php');
include "options.php";
$link_key = $_GET['token'];
$result = mysqli_query($users_con, $q = "select * from users where link_key = '$link_key'");
if(mysqli_num_rows($result) == 0){
	require('invalid_link.php');
	exit;
} else {
	$cookie_key = $_COOKIE['aluvi_token'];
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
// took out the cookie check
	//if(strcmp($cookie_key, $row['cookie_key']) != 0){
//		require('expired_link.php');
//		exit;
//	} else {
		$user = $row;	
		// update the cookie and the stored key
		// this also expires the link as a side effect
		$factory = new RandomLib\Factory;
		$generator = $factory->getMediumStrengthGenerator();
		$session_key = $generator->generateString(32, '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
		mysqli_query($users_con, $q = "update users set cookie_key='$session_key' where email = '${row['email']}'");
		setcookie('aluvi_token', $session_key, time() + 30*60);

		header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
		header("Pragma: no-cache"); // HTTP 1.0.
		header("Expires: 0"); // Proxies.
		$options = mysqli_fetch_array(mysqli_query($users_con, "select * from transit_options"));
		$margin = 1200;
		for ($i = 0; $i < count($transit_options); ++$i){
			if ($options[$i])
				$margin -= 100;
		}
		require('transportation_preferences.php');
//	}
}
