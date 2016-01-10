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
	var form = document.forms[0];
	if ((form.elements['transportation_type_carpool'].disabled && form.elements['transportation_type_vanpool'].disabled && form.elements['transportation_type_bicycle'].disabled
	     && form.elements['transportation_type_commuter_bus'].disabled && form.elements['transportation_type_public_transportation'].disabled) ||
	    form.elements['carpool_times_morning'].value == '' || form.elements['carpool_times_evening'].value == '' ||
	    (!form.elements['transportation_type_carpool'].disabled && form.elements['carpool_options'].value == '') ||
	    (!form.elements['transportation_type_vanpool'].disabled && form.elements['vanpool_options'].value == '') ){
	document.getElementById('error').innerHTML = '<br/><br/>Please select at least one transportation option, your commute times, and driving preferences.';
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
<center style='width:1000px; position:absolute;'>
<div style='width:700px'>
<p style='float:left; margin-left:40px; margin-right:10px;'>
When you'd like to arrive at work (AM):&nbsp;&nbsp;<br>
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
When you'd like to leave to head home (PM):<br>
<select name="carpool_times_evening">
	<option value="">--Select Time--</option>
	<option value="4:00">2:00</option>
	<option value="4:30">2:30</option>
	<option value="5:00">3:00</option>
	<option value="5:30">3:30</option>
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
</div>
<div id='error' style='clear:both; width:500px; text-align:left;'></div>
</center>
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
</p>
</div>





<div class="option">
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


<input type="submit" value="Next" class="submit" onClick="return validate_form();"/>

</form>

</div>

<p>Powered by Aluvi</p>

</body>

</html>