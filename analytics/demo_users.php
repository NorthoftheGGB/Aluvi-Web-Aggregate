<?php

$query = "select date_format(added, '%m/%d/%Y')as added, name, email, carpool_times_morning, carpool_times_evening, case when carpool then 'yes' else 'no' end, case when vanpool then 'yes' else 'no' end, case when public_transportation then 'yes' else 'no' end
from users u join preferences p on u.id = user_id where office = $office order by added";
$result = mysqli_query($users_con, $query);
$uq = "select count(*) as number from preferences join users u on u.id = userid where office = $office";
$users = mysqli_fetch_assoc(mysqli_query($users_con, $uq));

?>
<div style='margin:auto; font-size:20px; width:700px; '>
		<span style='margin-right:400px'>Total Sign Ups: <?php echo $users['number'] ?></span>
		<a href='demo_csv.php?office=<?php echo $office ?>'>Download CSV</a>
</div>
<br/><br/>
<table style='width:100%'>
    <tr>
    <th>Added</th>
    <th>Name</th>
    <th>Email</th>
    <th>Arrives</th>
    <th>Departs</th>
    <th>Carpool</th>
    <th>Vanpool</th>
    <th>Public Transportation</th>
    </tr>
    <?php
    while ($row = mysqli_fetch_assoc($result)){
    echo "<tr>";
    foreach ($row as $c){
        echo "<td>$c</td>";
        }
    }
    echo "</tr>";
    ?>
</table>