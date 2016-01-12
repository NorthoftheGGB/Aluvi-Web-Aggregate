<?php
require('vendor/autoload.php');
require('database.php');
$email = $_REQUEST['email'];
$name = $_REQUEST['name'];
$zip = $_REQUEST['zip'];
$split_email = explode('@', $email);
if ($split_email[1] == 'glassdoor.com' ||  $split_email[1] == 'aluviapp.com' || $email == 'mattfrykman@yahoo.com' || $email == 'chains@spaz.org' ){
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
	$url = "http://{$_SERVER['SERVER_NAME']}/transportation.php?token=$link_key";
	
	
	// send email
	$subject = 'Glassdoor Transportation Options Access';
	$body = "Hi $name,
	
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
	$mail->SetFrom($mail->Username, 'Glassdoor Transportation Options via Aluvi');
	$mail->Subject = $subject;
	$mail->Body = $body;
	$mail->AddAddress($email);
	if(!$mail->Send()) {
		echo "<!-1-->";
		$error = 'Mail error: '.$mail->ErrorInfo; 
	}
	else {
		$error = "";
	}
}
else {
	$error = 'Please enter your Glassdoor email address.';

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
<p>Thank you for entering your information for Glassdoor's transportation options.
<p>Please check your email as we have generated a customized link for you to access the site.
<p> - The Aluvi Team
<?php } ?>
</div>

</body>

</html>
