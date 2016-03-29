<?php
if (!$_SESSION)
    session_start();
if ($_POST['username']) {
    $admin_con = mysqli_connect("aluvi1.cr8zsnsf7jfy.us-west-2.rds.amazonaws.com", "master", "^cy*(b%ji%i", "aluvidb", 3306);
    if (!$admin_con) {
	echo "Could not establish connection to database";
	exit;
    }
    mysqli_select_db($admin_con, "admin");
    $result = mysqli_query($admin_con, "select * from users where name='$_POST[username]'");
    while ($row = mysqli_fetch_assoc($result)){
        $password = hash('sha512', $row['salt'].$_POST['password']);
        echo $row['salt']."<br/>";
        echo $row['password'];
        if ($password == $row['password']){
            $_SESSION['context'] = $row['context'];
            break;
        }
        $error = "Name and/or password incorrect.";
    }
    mysqli_close($admin_con);
}
if ($_SESSION['context']){
    if ($_SESSION['context'] == 'super'){
        $super = true;
        $domsplat = explode('.', $_SERVER['HTTP_HOST']);
        $context = $domsplat[0];
    }
    else
        $context = $_SESSION['context'];
}
if (!$context){
    include "login.php";
    exit;
}