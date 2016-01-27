<?php
require('vendor/autoload.php');
require('database.php');
$email = $_REQUEST['email'];
$name = ($_REQUEST['name']);
$sqlname = mysql_real_escape_string($_REQUEST['name']);
$zip = $_REQUEST['zip'];

$factory = new RandomLib\Factory;
$generator = $factory->getMediumStrengthGenerator();

$cookie_key = $generator->generateString(32, '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
$link_key = $generator->generateString(32, '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');

$results = mysqli_query($users_con, $q = "select * from demo_users where email = '$email'");

if(mysqli_num_rows($results) == 0){
	mysqli_query($users_con, $q = "insert into demo_users (name, email, zip, cookie_key, link_key) values('$sqlname', '$email', '$zip', '$cookie_key', '$link_key')");
} else {
	mysqli_query($users_con, $q = "update demo_users set name = '$name', zip = '$zip', cookie_key='$cookie_key', link_key='$link_key' where email = '$email'");
}
if ($e = mysqli_error($users_con)){
	echo "sorry, there seems to have been a problem.
	<!--$e
	$q-->";
	exit();
}

setcookie('aluvi_token', $cookie_key, time() + 30*60);
$url = "http://{$_SERVER['SERVER_NAME']}/transportation.php?token=$link_key";


// send email
$subject = 'Aluvi Transportation Options Access';
	$boom = explode(' ', $name);
	$firstname = $boom[0];
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
<p>Hi <?php echo $name;?>,
<p>Thank you for entering your information for Aluvi's transportation options.
<p>Please check your email as we have generated a customized link for you to access the site.
<p> - The Aluvi Team
<?php } ?>
</div>

</body>

</html>
