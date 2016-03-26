<?php include "options.php" ?>
<html>
<head>
<title>Aluvi</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<link href="style.css" rel="stylesheet" />
<style>
    .logo{
        width:<?php echo $logo_width ?>px;
        height:144px;
        background-image:url("<?php echo $context ?>.png");
        margin: 50px auto;
}
</style>
</head>

<body>

<div class="container">

<div class="rightBox">

<div class="logo">

</div>


<div class="description">
<p><?php echo $mainpage_blurb ?></p>
<p>(Please make sure cookies are enabled on your browser)</p>
</div>


<div class="formContainer">
<div class"form">

<form id="form" action="access.php" method="POST">

<input type="hidden" name="context" value="fico" />
<input type="text" name="name" placeholder="NAME" />
<br>
<input type="text" name="email" placeholder="ENTER YOUR WORK EMAIL" />
<br>
<input type="text" name="zip" placeholder="HOME ZIP CODE" />
<br>
<select name="office" class="bigSelect">
    <option value="">Select Office Location</option>
    <?php
    for ($x = 0; $x < count($offices); ++$x){
        $selected = ($x == 1 ? 'selected' : '' );
        echo "<option value='$offices[$x]' $selected>$offices[$x]</option>";
    }
    ?>
</select>
<br>
<br>
<a  href="javascript:document.forms[0].submit()" class="submit">Access Commuting Options</a>
</form> 

</div>
</div>
</div>



</div>


<center>
<p>Powered by Aluvi</p>
</center>
</body>
</html>
