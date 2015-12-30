<?php
require('vendor/autoload.php');
require('database.php');

$cookie_key = $_COOKIE['aluvi_token'];
$result = mysqli_query($users_con, $q = "select * from users where cookie_key = '$cookie_key'");
if(mysqli_num_rows($result) == 0){
	echo '401';
	exit;
}

$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

$stmt = mysqli_prepare($users_con, 'insert into preferences (user_id, carpool, vanpool, bicycle, public_transportation, commuter_bus, carpool_option, vanpool_option) values ( ?, ?, ?, ?,   ?, ?, ? , ?)');
$carpool = isset($_POST['transportation_type_carpool']) ? 1 : 0;
$vanpool = isset($_POST['transportation_type_vanpool']) ? 1 : 0; 
$bicycle = isset($_POST['transportation_type_bicycle']) ? 1 : 0; 
$public_transportation = isset($_POST['transportation_type_public_transportation']) ? 1 : 0;
$commuter_bus =  isset($_POST['transportation_type_commuter_bus']) ? 1 : 0;
mysqli_stmt_bind_param($stmt, 'iiiiiiss', $row['id'],  $carpool, $vanpool, $bicycle, $public_transportation, $commuter_bus, $_POST['carpool_options'], $_POST['vanpool_options']);
mysqli_stmt_execute($stmt);

// and get the map data ready
$zip = $row['zip'];
$t_results = array('bus' => array('coordinates' => array()));
$bus_results = mysqli_query($con, $q1 = "select * from bus_routes b join zip_codes z on st_intersects(b.SHAPE, z.geo) where zip_code = $zip");
if ($e = mysqli_error($con)) echo "<!-- $e FROM $q1 -->";

$routes = array();
while ($row = mysqli_fetch_array($bus_results, MYSQLI_ASSOC)){
	$routes[] = $row['route'];
	$stop_info[] = "<a href='#'>${row['route']}</a>";
}

foreach($routes as $route) {
	$bus_results = mysqli_query($con, $q1 = "select * from bus b join zip_codes z on st_intersects(b.geo, z.geo) where zip_code = $zip");
	while ($row = mysqli_fetch_array($bus_results, MYSQLI_ASSOC)){
		$t_results['bus']['coordinates'][] = array($row['stop_lat'],$row['stop_lon']); //array($row['stop_lat'], $row['stop_lon']);
	}
}

$bart_ferry_results = mysqli_query($con, $q1 = "select * from bart_ferry f join zip_codes z on st_intersects(f.geo, z.geo) where zip_code = $zip");
if ($row = mysqli_fetch_array($bart_ferry_results, MYSQLI_ASSOC)){
	$t_results['ferry']['coordinates'][] = array(37.795748, -122.393326);
	$t_results['ferry']['coordinates'][] = array(37.856561, -122.478122); 
	$ferry_results = true;
}

$bike_ferry_results = mysqli_query($con, $q1 = "select * from bike_ferry f join zip_codes z on st_intersects(f.geo, z.geo) where zip_code = $zip");
if ($row = mysqli_fetch_array($bike_ferry_results, MYSQLI_ASSOC)){
	$t_results['ferry']['coordinates'][] = array(37.795748, -122.393326);
	$t_results['ferry']['coordinates'][] = array(37.856561, -122.478122); 
	$ferry_results = true;
}

$transportationModes = json_encode($t_results);
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

require('map.php');
