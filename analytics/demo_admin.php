<?php
echo "<!-- $_POST[action]-->";
if ($_POST['action'] == 'add user'){
    $name = mysqli_real_escape_string($users_con, $_POST['name']);
    mysqli_query($users_con, $Q = "insert into admin (name, email) values ('$name', '$_POST[email])'");
    echo "<!--$Q-->";
}
else if ($_POST['action'] == 'add vanpool'){
    mysqli_query($users_con, "insert into vanpool_pickup (leader_name, leader_email, location_title, departs_location, arrives_work, departs_work)
                 values ($_POST[name], $_POST[email], $_POST[address], $_POST[departs_location], $_POST[arrives_work], $_POST[departs_work])");
}
$admin_results = mysqli_query($users_con, "select name, email from admin");
$vanpool_results = mysqli_query($users_con, "select leader_name, leader_email, location_title, departs_location, arrives_work, departs_work from vanpool_pickup");
?>
<form method='post' action='demo_analytics.php?view=Admin'>
<input type='hidden' name='action' value='add user' />
<h2>Admins</h2>
<table style='width:30%'>
    <tr>
        <th>Name</th>
        <th>Email</th>
    </tr>
    <?php
        while ($row = mysqli_fetch_assoc($admin_results)){
            foreach ($row as $c){
                echo "<td>$c</td>";
            }
        }
    ?>
    <tr>
        <td><input style='width:100%' type='text' placeholder='Name' name='name'/></td>
        <td><input style='width:100%' type='text' placeholder='Email' name='email'/></td>
    </tr>
</table>
<input type='submit' value='Add User' />
</form>
