<?php
$con = mysqli_connect("aluvi1.cr8zsnsf7jfy.us-west-2.rds.amazonaws.com", "master", "^cy*(b%ji%i", "aluvidb", 3306);
if (!$con) {
	echo "Could not establish connection to database";
	exit;
}
$email = $_REQUEST['email'];
$name = $_REQUEST['name'];
$zip = $_REQUEST['zip'];
if ($_REQUEST['driver'])
    $driver = 1;
else
    $driver = 0;
mysqli_query($con, $q = "insert into users values('$name', '$email', '$zip', $driver)");
mysqli_select_db($con, "glassdoor");
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
