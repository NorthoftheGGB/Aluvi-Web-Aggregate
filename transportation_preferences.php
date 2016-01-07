<html>
<head>
<title>Aluvi</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<link href="style.css" rel="stylesheet">
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
	return false;
}
//-->
</script>

</head>

<body>

<div class="container">


<div class="rightBox">

<div class="logo"></div>

<div class="description">
<p> Let's complete the final steps.<br>
Please select the transportation options you are interested in: <br></p>
</div>

<div class="description" id="choices">

<form action="update_preferences.php" method="POST">

<div class="option">
<!--<p>Carpool-->
<p>
<select name="carpool_options">
	<option value="">--Select Option--</option>
	<option value="rider">Rider</option>
	<option value="driver">Driver</option>
	<option value="both">Both</option>
</select>
<p>
	<div id="transportation_type_carpool" class="transportation_type" onclick="toggle_visibility('transportation_type_carpool');" style="display: block;">
	Carpool<!--not selected-->
	</div>
	<div id="transportation_type_carpool_selected" class="transportation_type" onclick="toggle_visibility('transportation_type_carpool');" style="display: none;"> 
	Carpool
	</div>
	<input type="hidden" id="transportation_type_carpool_input" name="transportation_type_carpool" value="selected" disabled="true"/>
<p>
When you leave for work (AM):<br>
<select name="carpool_times_morning">
	<option value="">--Select Time--</option>
	<option value="4:00">4:00</option>
	<option value="4:30">4:30</option>
	<option value="5:00">4:00</option>
	<option value="5:30">4:30</option>
	<option value="6:00">4:00</option>
	<option value="6:30">4:30</option>
	<option value="7:00">4:00</option>
	<option value="7:30">4:30</option>
	<option value="8:00">4:00</option>
	<option value="8:30">4:30</option>
	<option value="9:00">4:00</option>
	<option value="9:30">4:30</option>
	<option value="10:00">4:00</option>
</select>
<p>
When you leave to head home (PM):<br>
<select name="carpool_times_evening">
	<option value="">--Select Time--</option>
	<option value="4:00">4:00</option>
	<option value="4:30">4:30</option>
	<option value="5:00">4:00</option>
	<option value="5:30">4:30</option>
	<option value="6:00">4:00</option>
	<option value="6:30">4:30</option>
	<option value="7:00">4:00</option>
	<option value="7:30">4:30</option>
	<option value="8:00">4:00</option>
	<option value="8:30">4:30</option>
	<option value="9:00">4:00</option>
	<option value="9:30">4:30</option>
	<option value="10:00">4:00</option>
</select>

</div>



<div class="option">
<!--<p>Vanpool-->
<p>
<select name="vanpool_options">
	<option value="">--Select Option--</option>
	<option value="rider">Rider</option>
	<option value="driver">Driver</option>
	<option value="both">Both</option>
</select>
<p>
	<div id="transportation_type_vanpool" class="transportation_type" onclick="toggle_visibility('transportation_type_vanpool');" style="display: block;">
	Vanpool<!--not selected-->
	</div>
	<div id="transportation_type_vanpool_selected" class="transportation_type" onclick="toggle_visibility('transportation_type_vanpool');" style="display: none;"> 
	Vanpool
	</div>
	<input type="hidden" id="transportation_type_vanpool_input" name="transportation_type_vanpool" value="selected" disabled="true"/>
</div>





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



<div class="option">
<!--<p>Public Transportation-->
<p>
	<div id="transportation_type_public_transportation" class="transportation_type" onclick="toggle_visibility('transportation_type_public_transportation');" style="display: block;">
	Public Transportation<!--not selected-->
	</div>
	<div id="transportation_type_public_transportation_selected" class="transportation_type" onclick="toggle_visibility('transportation_type_public_transportation');" style="display: none;"> 
	Public Transportation
	</div>
	<input type="hidden" id="transportation_type_public_transportation_input" name="transportation_type_public_transportation" value="selected" disabled="true"/>
</div>





<div class="option">
<!--<p>Commuter Bus-->
<p>
	<div id="transportation_type_commuter_bus" class="transportation_type" onclick="toggle_visibility('transportation_type_commuter_bus');" style="display: block;">
	Commuter Bus<!--not selected-->
	</div>
	<div id="transportation_type_commuter_bus_selected" class="transportation_type" onclick="toggle_visibility('transportation_type_commuter_bus');" style="display: none;"> 
	Commuter Bus
	</div>
	<input type="hidden" id="transportation_type_commuter_bus_input" name="transportation_type_commuter_bus" value="selected" disabled="true"/>
</div>


<input type="submit" value="Next" class="submit" onClick="validate_form();"/>

</form>

</div>

<p>Powered by Aluvi</p>

</body>

</html>
