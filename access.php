<?php
$context = $_POST['context'];
include "options.php";
require('vendor/autoload.php');
require('database.php');
$error = "";
$email = $_REQUEST['email'];
$name = ($_REQUEST['name']);
$zip = $_REQUEST['zip'];
$office = $_POST['office'];
$split_email = explode('@', $email);
if (!$name)
$error = "Please enter your name. ";
else {
	$names = explode(' ', $name);
	if (count($names) == 1){
		$error = "Please enter both first and last name. ";
	}
}
if (!($context == "demo" || $context == "verifone" || $email == "olypuppetfest@gmail.com" || $split_email[1] == $company_email || $split_email[1] == "aluviapp.com")){
	$error .= "Please enter your $nametitle_long email address. ";
}
if (!$zip){
	$error .= "Please enter your home zip code. ";
}
if (!$office)
	$error .= 'Please select your office. ';

if (!$error){
$sqlname = mysqli_real_escape_string($users_con, $_REQUEST['name']);


$factory = new RandomLib\Factory;
$generator = $factory->getMediumStrengthGenerator();

$cookie_key = $generator->generateString(32, '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
setcookie('aluvi_token', $cookie_key, time() + 30*60);

$link_key = $generator->generateString(32, '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');

$results = mysqli_query($users_con, $q = "select * from users where email = '$email'");
if ($context != 'demo'){
	$extra1 = ",office";
	$extra2 = ",'$_POST[office]'";
	$extra3= ",office='$_POST[office]'";
}
if(mysqli_num_rows($results) == 0){
	mysqli_query($users_con, $q = "insert into users (name, email, zip, cookie_key, link_key $extra1) values('$sqlname', '$email', '$zip', '$cookie_key', '$link_key' $extra2)");
} else {
	mysqli_query($users_con, $q = "update users set name = '$sqlname', zip = '$zip', cookie_key='$cookie_key', link_key='$link_key' $extra3 where email = '$email'");
}
if ($e = mysqli_error($users_con)){
	echo "sorry, there seems to have been a problem.
	<!--$e
	$q-->";
	exit();
}

/*
if ($_COOKIE['aluvi_token'] != $cookie_key){
	die ("hmmm...");
}
*/
$url = "http://{$_SERVER['SERVER_NAME']}/transportation.php?token=$link_key&context=$context";


// send email
$subject = "$nametitle's Transportation Options Access";
	$firstname = $names[0];
	$body = "Hi $firstname,
	
Follow this link to access your transportation options $url";

$mail = new PHPMailer();  // create a new object
$mail->IsSMTP(); // enable SMTP
$mail->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only
$mail->SMTPAuth = true;  // authentication enabled
$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
$mail->Host = 'smtp.gmail.com';
$mail->Port = 465; 
$mail->Username = 'support@aluviapp.com';  
$mail->Password = 'support4aluviapp';           
$mail->SetFrom($mail->Username, 'Transportation Options via Aluvi');
$mail->Subject = $subject;
$mail->Body = $body;
$mail->AddAddress($email);
if(!$mail->Send()) {
	$error = 'Mail error: '.$mail->ErrorInfo; 
} else {
	$error = '';
}
}

// serve page
?>

<html>
<head>
<title>Aluvi</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<link href="style.css" rel="stylesheet">

</head>

<body>

<div class="container">


<div class="rightBox">

<div class="logo"></div>

<div class="description">
<p><?php echo $error;
if (!$error) {
?>
<p>Hi <?php echo $name; ?>,
<p>Thank you for entering your information for <?php echo $nametitle ?>'s transportation options.
<p>Please check your email as we have generated a customized link for you to access the site.
<p> - The Aluvi Team
<?php } ?>
</div>

</body>

</html>
