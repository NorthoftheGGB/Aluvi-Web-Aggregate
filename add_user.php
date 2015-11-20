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
$t_results = array();
$bus_results = mysqli_query($con, $q1 = "select * from bus b join zip_codes z on st_intersects(b.geo, z.geo) where zip_code = $zip");
if ($e = mysqli_error($con)) echo "<!-- $e FROM $q1 -->";
/*
while ($row = msqyli_fetch_array($bus_results, MYSQLI_ASSOC)){
	$t_results['bus']['coordinates'][] = array($row['stop_lat'], $row['stop_lng']);
}
/*
$bart_ferry_results = mysqli_query($con, $q1 = "select * from bart_ferry f join zip_codes z on st_intersects(f.geo, z.geo) where zip_code = $zip");
while ($row = msqyli_fetch_array($bart_ferry_results, MYSQLI_ASSOC)){
	$t_results['ferry']['coordinates'][] = array($row['stop_lat'], $row['stop_lng']);
}
$bus_ferry_results = mysqli_query($con, $q1 = "select * from bus_ferry f join zip_codes z on st_intersects(f.geo, z.geo) where zip_code = $zip");
while ($row = msqyli_fetch_array($bus_ferry_results, MYSQLI_ASSOC)){
	
}
*/
$transportationModes = json_encode($t_results);

