<?php
if ($_POST['new_password']){
    $name = mysqli_real_escape_string($users_con, $_POST['name']);
    $salt = substr(hash('sha512',uniqid(rand(), true).microtime()), 0, 15);
    $password = hash('sha512', $salt.$_POST['new_password']);
    mysqli_query($users_con, $Q = "insert into admin.users (name, password, salt, context) values ('$name', '$password', '$salt', '$context')");
}

$admin_results = mysqli_query($users_con, "select name from admin.users where context = '$context'");
?>
<form method='post' action='<?php echo $main_url?>&view=Admin'>
<input type='hidden' name='action' value='add user' />
<h2>Admins</h2>
<table style='width:30%'>
    <tr>
        <th>Username</th>
        <th>Password</th>
    </tr>
    <?php
        while ($row = mysqli_fetch_assoc($admin_results)){
        echo "<tr>";       
        echo "<td>$row[name]</td>";
        echo "<td>*******</td>";
        echo "</tr>";
        }
    ?>
    <tr class='input'>
        <td><input style='width:100%' type='text' placeholder='Username' name='name'/></td>
        <td><input style='width:100%' type='password' placeholder='Password' name='new_password'/></td>
        
    </tr>
</table>
<br/>
<input type='submit' value='Add User' />
</form>

