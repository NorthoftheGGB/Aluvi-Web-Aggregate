<html>
	<head>
		<link href="admin.css" rel="stylesheet" type="text/css" />
	</head>
	<body>
		<center id="logo">
			<br/><img src='../AluviGradient.png' /><br/><br/>	
		</center>
                <div style='width:2000px; margin:auto;'>
                <form method='post' action='index.php'>
                    <p style='color:red'><?php echo $error ?>&nbsp;</p>
                    <input type='hidden' name='office' value='<?php echo $_GET["office"] ?>' />
                    <input type='hidden' name='view' value='<?php echo $_GET["view"] ?>' />
                    <input type='text' name='username' placeholder='Username' /><br/>
                    <input type='password' name='password' placeholder='password' /><br/>
                    <input type='submit' value='Log in' />
                </form>
                </div>
        </body>
</html>