<?php
$errmsg = "Please select at least one transportation option";
$conditions = array();
$types_conditions = array();
if ($options['carpool']) $types_conditions[] = "form.elements['transportation_type_carpool'].disabled";
if ($options['vanpool']) $types_conditions[] = "form.elements['transportation_type_vanpool'].disabled";
if ($options['bicycle']) $types_conditions[] = "form.elements['transportation_type_bicycle'].disabled";
if ($options['commuter_shuttle']) $types_conditions[] = "form.elements['transportation_type_commuter_bus'].disabled";
if ($options['public_transportation']) $types_conditions[] = "form.elements['transportation_type_public_transportation'].disabled";
$conditions[] = "(".implode(' && ', $types_conditions). ")";
if ($options['times']){
	$conditions[] = "(form.elements['carpool_times_morning'].value == '' || form.elements['carpool_times_evening'].value == '')";
	$errmsg .= ($options['driver'] ? ',' : ' and') . " your commute times";
}
if ($options['driver']){
	$conditions[] = "(!form.elements['transportation_type_carpool'].disabled && form.elements['carpool_options'].value == '') || (!form.elements['transportation_type_vanpool'].disabled && form.elements['vanpool_options'].value == '')";
	$errmsg .= ", and driving preferences";
}
$conditions = implode(' || ', $conditions);
?>
<html>
<head>
<title>Aluvi</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="style.css" rel="stylesheet">
<link href="<?php echo $context ?>.css" rel="stylesheet">
<script type="text/javascript">
<!--
function toggle_visibility(id) {
	var e = document.getElementById(id);
	var e_selected = document.getElementById(id+'_selected');	
	var e_input = document.getElementById(id+'_input');	
	if(e.style.display == 'block') {
		e.style.display = 'none';
		e_selected.style.display = 'block'
		e_input.disabled = false;
	} else {
		e.style.display = 'block';
		e_selected.style.display = 'none'
		e_input.disabled = true;
	}
}

function validate_form(){
	var form = document.forms[0];
	if (<?php echo $conditions?>){
	document.getElementById('error').innerHTML = '<br/><br/><?php echo $errmsg?>.';
	return false;
	}
return true;
}

//-->
</script>

</head>

<body>

<div class="container">


<div class="rightBox">

<div class="logo"></div>

<div class="description">
<p id="tagline"> Let's complete the final steps.<br>
Please select the transportation options you are interested in: <br></p>
</div>

<div class="description" id="choices">

<form action="update_preferences.php" method="POST">
<?php if ($margin) echo "<div class='option' style='width:${margin}px'>&nbsp;</div>";
echo "<input type='hidden' name='context' value='$context'>
<input type='hidden' name='userid' value='$user[id]' />";
for ($i = 0; $i < count($transit_options); ++ $i) {
if ($transit_options[$i] == 'carpool' && $options['carpool']) {
?>

<div class="option">
<!--<p>Carpool-->
<p>
<?php
if ($options['driver'])  { ?>
<select name="carpool_options">
	<option value="">--Select Option--</option>
	<option value="both">Drive and Ride</option>
	<option value="rider">Ride Only</option>
</select>
<?php } else echo "<div style='height:17px'>&nbsp;</div>" ?>

</p>
<p>
	<div id="transportation_type_carpool" class="transportation_type" onclick="toggle_visibility('transportation_type_carpool');" style="display: block;">
	Carpool<!--not selected-->
	</div>
	<div id="transportation_type_carpool_selected" class="transportation_type" onclick="toggle_visibility('transportation_type_carpool');" style="display: none;"> 
	Carpool
	</div>
	<input type="hidden" id="transportation_type_carpool_input" name="transportation_type_carpool" value="selected" disabled="true"/>
</p>

</div>

<?php } if ($transit_options[$i] ==  'vanpool' && $options['vanpool']) { ?>

<div class="option">
<!--<p>Vanpool-->
<p>
<?php if ($options['driver'])  { ?>
<select name="vanpool_options">
	<option value="">--Select Option--</option>
	<option value="both">Drive and Ride</option>
	<option value="rider">Ride Only</option>
</select>
<?php } else echo "<div style='height:17px'>&nbsp;</div>" ?>
</p>
<p>
	<div id="transportation_type_vanpool" class="transportation_type" onclick="toggle_visibility('transportation_type_vanpool');" style="display: block;">
	Vanpool<!--not selected-->
	</div>
	<div id="transportation_type_vanpool_selected" class="transportation_type" onclick="toggle_visibility('transportation_type_vanpool');" style="display: none;"> 
	Vanpool
	</div>
	<input type="hidden" id="transportation_type_vanpool_input" name="transportation_type_vanpool" value="selected" disabled="true"/>
</p>
</div>



<?php  } if ($transit_options[$i] == 'bicycle' && $options['bicycle']) { ?>

<div class="option">
<!--<p>Bicycle-->
<p>
	<div id="transportation_type_bicycle" class="transportation_type" onclick="toggle_visibility('transportation_type_bicycle');" style="display: block;">
	Bicycle<!--not selected-->
	</div>
	<div id="transportation_type_bicycle_selected" class="transportation_type" onclick="toggle_visibility('transportation_type_bicycle');" style="display: none;"> 
	Bicycle
	</div>
	<input type="hidden" id="transportation_type_bicycle_input" name="transportation_type_bicycle" value="selected" disabled="true"/>
</div>

<?php } if ($transit_options[$i] == 'walking' && $options['walking']) { ?>

<div class="option">
<!--<p>Bicycle-->
<p>
	<div id="transportation_type_bicycle" class="transportation_type" onclick="toggle_visibility('transportation_type_bicycle');" style="display: block;">
	Bicycle<!--not selected-->
	</div>
	<div id="transportation_type_bicycle_selected" class="transportation_type" onclick="toggle_visibility('transportation_type_bicycle');" style="display: none;"> 
	Bicycle
	</div>
	<input type="hidden" id="transportation_type_bicycle_input" name="transportation_type_bicycle" value="selected" disabled="true"/>
</div>

<?php } if ($transit_options[$i] == 'public_transportation' && $options['public_transportation']) { ?>

<div class="option" id="publicTransitBox">
<!--<p>Public Transportation-->
<p>
	<div id="transportation_type_public_transportation" class="transportation_type" onclick="toggle_visibility('transportation_type_public_transportation');" style="display: block;">
	Public Transportation<!--not selected-->
	</div>
	<div id="transportation_type_public_transportation_selected" class="transportation_type" onclick="toggle_visibility('transportation_type_public_transportation');" style="display: none;"> 
	Public Transportation
	</div>
	<input type="hidden" id="transportation_type_public_transportation_input" name="transportation_type_public_transportation" value="selected" disabled="true"/>
</p>
</div>



<?php } if ($transit_options[$i] == 'commuter_shuttle' && $options['commuter_shuttle']) { ?>

<div class="option" id="shuttleBox">
<!--<p>Commuter Bus-->
<p>
	<div id="transportation_type_commuter_bus" class="transportation_type" onclick="toggle_visibility('transportation_type_commuter_bus');" style="display: block;">
	Commuter Shuttle<!--not selected-->
	</div>
	<div id="transportation_type_commuter_bus_selected" class="transportation_type" onclick="toggle_visibility('transportation_type_commuter_bus');" style="display: none;"> 
	Commuter Shuttle
	</div>
	<input type="hidden" id="transportation_type_commuter_bus_input" name="transportation_type_commuter_bus" value="selected" disabled="true"/>
</p>
</div>

<?php }
}
if ($margin) echo "<div class='option' style='width:${margin}px'>&nbsp;</div>" ?>
<center style='width:1000px; margin-bottom:50px' class="times_select">
<div style='width:800px'>
<?php if ($options['times']) { ?>
<p style='float:left; margin-left:130px; margin-right:10px;'>
When I'd like to arrive at work (AM):&nbsp;&nbsp;<br>
<select name="carpool_times_morning">
	<option value="">--Select Time--</option>
	<option value="5:30">5:30</option>
	<option value="6:00">6:00</option>
	<option value="6:30">6:30</option>
	<option value="7:00">7:00</option>
	<option value="7:30">7:30</option>
	<option value="8:00">8:00</option>
	<option value="8:30">8:30</option>
	<option value="9:00">9:00</option>
	<option value="9:30">9:30</option>
	<option value="10:00">10:00</option>
</select>
</p>
<p style='float:left'>
When I usually head home (PM):<br>
<select name="carpool_times_evening">
	<option value="">--Select Time--</option>
	<option value="2:00">2:00</option>
	<option value="2:30">2:30</option>
	<option value="3:00">3:00</option>
	<option value="3:30">3:30</option>
	<option value="4:00">4:00</option>
	<option value="4:30">4:30</option>
	<option value="5:00">5:00</option>
	<option value="5:30">5:30</option>
	<option value="6:00">6:00</option>
	<option value="6:30">6:30</option>
	<option value="7:00">7:00</option>
	<option value="7:30">7:30</option>
	<option value="8:00">8:00</option>
</select>
</p>
<?php } ?>
</div>
<div id='error' style='clear:both; width:500px; text-align:left; height:2em;'></div>
</center>
<input type="submit" value="Next" class="submit" onClick="return validate_form();"/>

</form>

</div>

<p>Powered by Aluvi</p>

</body>

</html>
