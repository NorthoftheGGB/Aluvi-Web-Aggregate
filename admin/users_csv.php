<?php
$office = $_GET['office'];
include "auth.php";
if ($context == 'saas')
	$context = 'demo';
include "../database.php";
$query = "select date_format(added, '%m/%d/%Y')as added, name, email, carpool_times_morning, carpool_times_evening, case when carpool then 'yes' else 'no' end, case when vanpool then 'yes' else 'no' end, case when public_transportation then 'yes' else 'no' end
from users u join preferences p on u.id = user_id where office = $office order by added";
$csv = "Date Added,Name,Email,Arrives,Departs,Carpool,Vanpool,Public Transportation\n";
$result = mysqli_query($users_con, $query);
while ($row = mysqli_fetch_assoc($result)){
    $csv .= implode(",", $row)."\n";
}
header("Content-Disposition: attachment; filename='users.csv'"); 
header("Content-Type: application/csv");
echo $csv;
exit;