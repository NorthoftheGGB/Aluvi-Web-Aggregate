<?php

require('vendor/autoload.php');
require('database.php');

$cookie_key = $_COOKIE['aluvi_token'];
$result = mysqli_query($users_con, $q = "select * from demo_users where cookie_key = '$cookie_key'");
if(mysqli_num_rows($result) == 0){
	require 'expired_link.php';
	exit;
}

$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

$stmt = mysqli_prepare($users_con, 'insert into demo_preferences (user_id, carpool, vanpool, bicycle, public_transportation, commuter_bus, carpool_option, vanpool_option, carpooling_times_morning, carpooling_times_evening) values ( ?, ?, ?, ?,   ?, ?, ? , ?, ?, ?)');
$carpool = isset($_POST['transportation_type_carpool']) ? 1 : 0;
$vanpool = isset($_POST['transportation_type_vanpool']) ? 1 : 0; 
$bicycle = isset($_POST['transportation_type_bicycle']) ? 1 : 0; 
$public_transportation = isset($_POST['transportation_type_public_transportation']) ? 1 : 0;
$commuter_bus =  isset($_POST['transportation_type_commuter_bus']) ? 1 : 0;
mysqli_stmt_bind_param($stmt, 'iiiiiissss', $row['id'],  $carpool, $vanpool, $bicycle, $public_transportation, $commuter_bus, $_POST['carpool_options'], $_POST['vanpool_options']);
mysqli_stmt_execute($stmt);

// and get the map data ready


header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
header("Pragma: no-cache"); // HTTP 1.0.
header("Expires: 0"); // Proxies.
require('map.php');
