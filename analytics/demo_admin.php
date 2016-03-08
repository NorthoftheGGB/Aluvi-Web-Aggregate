<?php
if ($_POST['action']){
    $name = mysqli_real_escape_string($users_con, $_POST['name']);
    mysqli_query($users_con, $Q = "insert into admin (name, email) values ('$name', '$_POST[email]')");
}

$admin_results = mysqli_query($users_con, "select name, email from admin");
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
        echo "<tr>";
            foreach ($row as $c){
                echo "<td>$c</td>";
            }
        }
        echo "</tr>";
    ?>
    <tr class='input'>
        <td><input style='width:100%' type='text' placeholder='Name' name='name'/></td>
        <td><input style='width:100%' type='text' placeholder='Email' name='email'/></td>
    </tr>
</table>
<br/>
<input type='submit' value='Add User' />
</form>

