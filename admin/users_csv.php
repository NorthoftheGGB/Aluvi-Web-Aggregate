<?php
$office = $_GET['office'];
include "auth.php";
include "../options.php";
include "../database.php";
if ($public_options)
		$public_yes = "public_option";
else
		$public_yes = "'yes'";
if ($comments_box){
    $comments = ",Comments";
}
$query = "select date_format(added, '%m/%d/%Y')as added, name, email, carpool_times_morning, carpool_times_evening, case when walking then 'yes' else 'no' end, case when bicycle then 'yes' else 'no' end, case when public_transportation then $public_yes else 'no' end, case when carpool then carpool_option else 'no' end, case when vanpool then vanpool_option else 'no' end, case when commuter_bus then 'yes' else 'no' end $comments from users u join preferences p on u.id = user_id where office = $office order by added";
$csv = "Date Added,Name,Email,Arrives,Departs,Walking,Bicycle,Public Transportation,Carpool,Vanpool,Commuter Shuttle$comments\n";
$result = mysqli_query($users_con, $query);
while ($row = mysqli_fetch_assoc($result)){
    $csv .= implode(",", $row)."\n";
}
header("Content-Disposition: attachment; filename='users.csv'"); 
header("Content-Type: application/csv");
echo $csv;
exit;