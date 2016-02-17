<?php
$context = $_POST['context'];
require('vendor/autoload.php');
require('database.php');
//??
/*
$cookie_key = $_COOKIE['aluvi_token'];
$result = mysqli_query($users_con, $q = "select * from users where cookie_key = '$cookie_key'");
if(mysqli_num_rows($result) == 0){
	echo "<!-$q-->";
	require 'expired_link.php';
	exit;
}
*/
$result = mysqli_query($users_con, $q = "select * from users where id = $_POST[userid]");
if(mysqli_num_rows($result) == 0){
	echo "<!-$q-->";
	require 'expired_link.php';
	exit;
}

if ($result['office'] == 'San Rafael')
	$transitlink = "http://www.goldengatetransit.org/";
else
	$transitlink = "http://www.vta.org/";
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$userzip = $row['zip'];
$userid = $row['id'];
mysqli_query($users_con, 'delete from preferences where user_id='.$row['id']);
$stmt = mysqli_prepare($users_con, 'insert into preferences (user_id, carpool, vanpool, bicycle, public_transportation, commuter_bus, carpool_option, vanpool_option, carpool_times_morning, carpool_times_evening) values ( ?, ?, ?, ?,   ?, ?, ? , ?, ?, ?)');
$carpool = isset($_POST['transportation_type_carpool']) ? 1 : 0;
$vanpool = isset($_POST['transportation_type_vanpool']) ? 1 : 0; 
$bicycle = isset($_POST['transportation_type_bicycle']) ? 1 : 0; 
$public_transportation = isset($_POST['transportation_type_public_transportation']) ? 1 : 0;
$commuter_bus =  isset($_POST['transportation_type_commuter_bus']) ? 1 : 0;
mysqli_stmt_bind_param($stmt, 'iiiiiissss', $row['id'],  $carpool, $vanpool, $bicycle, $public_transportation, $commuter_bus, $_POST['carpool_options'], $_POST['vanpool_options'], $t1 = $_POST['carpool_times_morning'], $t2 = $_POST['carpool_times_evening']);
mysqli_stmt_execute($stmt);

if ($context )
// and get the map data ready
if ($carpool){
	$carpool_matches = array();
	$n_results = 0;
	$car_results = mysqli_query($users_con, $q = "select name, email, carpool_times_morning as t1, carpool_times_evening as t2, carpool_option
				    from preferences join users u on user_id = u.id where u.zip = $userzip and u.id <> $userid and carpool
				    order by abs(time_to_sec(t1) - time_to_sec('$t1')) + abs(time_to_sec(t2) - time_to_sec('$t2')) limit 3");
	//echo "<!--$q-->";
	while ($row = mysqli_fetch_array($car_results, MYSQLI_ASSOC)){
		
			$carpool_matches[] = "<tr><td>$row[name]</td><td>$row[email]</td><td>$row[carpool_option]</td><td>$row[t1]am</td><td>$row[t2]pm</td></tr>";
	}
}

$zip_results = mysqli_query($con, $qx = "select st_astext(geo) as geotext from zip_codes where zip_code = $zip");
while ($row = mysqli_fetch_array($zip_results, MYSQLI_ASSOC)){
	$raw_coordinates = str_replace('MULTIPOLYGON', '', str_replace('(', '', str_replace(')', '', $row['geotext'])));
	$zip_points = array();
	foreach(explode(",", $raw_coordinates) as $point){
		$sphinx = explode(' ', $point);
		$zip_points[] = array($sphinx[1], $sphinx[0]);
	}
}
$zip = str_replace('"', '', json_encode(array("coordinates" => $zip_points)));
if ($e = mysqli_error($con)) echo "<!-- $e FROM $qx -->";

header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
header("Pragma: no-cache"); // HTTP 1.0.
header("Expires: 0"); // Proxies.
require('map.php');
