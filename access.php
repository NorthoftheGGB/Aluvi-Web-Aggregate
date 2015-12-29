<?php
require('vendor/autoload.php');
require('database.php');
$email = $_REQUEST['email'];
$name = $_REQUEST['name'];
$zip = $_REQUEST['zip'];

$factory = new RandomLib\Factory;
$generator = $factory->getMediumStrengthGenerator();

$cookie_key = $generator->generateString(32, '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
$link_key = $generator->generateString(32, '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');

$results = mysqli_query($users_con, $q = "select * from users where email = '$email'");

if(mysqli_num_rows($results) == 0){
	mysqli_query($users_con, $q = "insert into users (name, email, zip, cookie_key, link_key) values('$name', '$email', '$zip', '$cookie_key', '$link_key')");
} else {
	mysqli_query($users_con, $q = "update users set name = '$name', zip = '$zip', cookie_key='$cookie_key', link_key='$link_key' where email = '$email'");
}


setcookie('aluvi_token', $cookie_key, time() + 30*60);
$url = "http://52.88.178.30/gis_dev/transportation.php?token=$link_key";
echo $url;


// send email
require_once 'vendor/swiftmailer/swiftmailer/lib/swift_required.php';
$transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 587, 'tls')
  ->setUsername('support@aluviapp.com"')
 ->setPassword('support4aluviapp');

$mailer = Swift_Mailer::newInstance($transport);

$message = Swift_Message::newInstance('Glassdoor Transportation Options Access')
	->setTo(array($email))
	->setFrom('support@aluviapp.com')
	->setBody("Followthis link to access your transportation options $url");

//$result = $mailer->send($message);



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

<div class="description">
<p>Hi <?php echo $name;?>,
<p>Thank you for entering your information for Glassdoor's transportation options.
<p>Please check your email as we have generated a customized link for you to access the site.
<p> - The Aluvi Team
</div>

</body>

</html>
