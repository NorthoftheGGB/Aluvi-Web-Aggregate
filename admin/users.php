<?php
if ($public_options)
		$public_yes = "public_option";
else
		$public_yes = "'yes'";
if ($comments_box){
		$comments1 = ",comments";
		$comments2 = "<th>Comments</th>";
}
$query = "select date_format(added, '%m/%d/%Y')as added, name, email, carpool_times_morning, carpool_times_evening, case when walking then 'yes' else 'no' end, case when bicycle then 'yes' else 'no' end, case when public_transportation then $public_yes else 'no' end, case when carpool then carpool_option else 'no' end, case when vanpool then vanpool_option else 'no' end, case when commuter_bus then 'yes' else 'no' end $comments1 from users u join preferences p on u.id = user_id where office = $office order by added";
$result = mysqli_query($users_con, $query);
$uq = "select count(*) as number from preferences join users u on u.id = user_id where office = $office";
$users = mysqli_fetch_assoc(mysqli_query($users_con, $uq));

?>
<div style='margin:auto; font-size:20px; width:700px; '>
		<span style='margin-right:400px'><u>Total Sign Ups: <?php echo $users['number'] ?></u></span>
		<a href='users_csv.php?office=<?php echo $office ?>'>Download CSV</a>
</div>
<br/><br/>
<table style='width:100%'>
    <tr>
    <th>Added</th>
    <th>Name</th>
    <th>Email</th>
    <th>Arrives</th>
    <th>Departs</th>
    <th>Walking</th>
    <th>Bicycle</th>
    <th>Public Transportation</th>
    <th>Carpool</th>
    <th>Vanpool</th>
    <th>Commuter Shuttle</th>
    <?php echo $comments2 ?>
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