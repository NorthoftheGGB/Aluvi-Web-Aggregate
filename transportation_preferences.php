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
//-->
</script>

</head>

<body>

<div class="container">


<div class="rightBox">

<div class="description">

<form action="update_preferences.php" method="POST">

<div class="option">
<p>Carpool
<p>
<select name="carpool_options">
	<option value="rider">Rider</option>
	<option value="driver">Driver</option>
	<option value="both">Both</option>
</select>
<p>
	<div id="transportation_type_carpool" class="transportation_type" onclick="toggle_visibility('transportation_type_carpool');" style="display: block;">
	Carpool Not Selected
	</div>
	<div id="transportation_type_carpool_selected" class="transportation_type" onclick="toggle_visibility('transportation_type_carpool');" style="display: none;"> 
	Carpool Selected
	</div>
	<input type="hidden" id="transportation_type_carpool_input" name="transportation_type_carpool" value="selected" disabled="true"/>
</div>


<div class="option">
<p>Vanpool
<p>
<select name="vanpool_options">
	<option value="rider">Rider</option>
	<option value="driver">Driver</option>
	<option value="both">Both</option>
</select>
<p>
	<div id="transportation_type_vanpool" class="transportation_type" onclick="toggle_visibility('transportation_type_vanpool');" style="display: block;">
	Vanpool Not Selected
	</div>
	<div id="transportation_type_vanpool_selected" class="transportation_type" onclick="toggle_visibility('transportation_type_vanpool');" style="display: none;"> 
	Vanpool Selected
	</div>
	<input type="hidden" id="transportation_type_vanpool_input" name="transportation_type_vanpool" value="selected" disabled="true"/>
</div>





<div class="option">
<p>Bicycle
<p>
	<div id="transportation_type_bicycle" class="transportation_type" onclick="toggle_visibility('transportation_type_bicycle');" style="display: block;">
	Bicycle Not Selected
	</div>
	<div id="transportation_type_bicycle_selected" class="transportation_type" onclick="toggle_visibility('transportation_type_bicycle');" style="display: none;"> 
	Bicycle Selected
	</div>
	<input type="hidden" id="transportation_type_bicycle_input" name="transportation_type_bicycle" value="selected" disabled="true"/>
</div>



<div class="option">
<p>Public Transportation
<p>
	<div id="transportation_type_public_transportation" class="transportation_type" onclick="toggle_visibility('transportation_type_public_transportation');" style="display: block;">
	Public Transportation Not Selected
	</div>
	<div id="transportation_type_public_transportation_selected" class="transportation_type" onclick="toggle_visibility('transportation_type_public_transportation');" style="display: none;"> 
	Public Transportation Selected
	</div>
	<input type="hidden" id="transportation_type_public_transportation_input" name="transportation_type_public_transportation" value="selected" disabled="true"/>
</div>





<div class="option">
<p>Commuter Bus
<p>
	<div id="transportation_type_commuter_bus" class="transportation_type" onclick="toggle_visibility('transportation_type_commuter_bus');" style="display: block;">
	Commuter Bus Not Selected
	</div>
	<div id="transportation_type_commuter_bus_selected" class="transportation_type" onclick="toggle_visibility('transportation_type_commuter_bus');" style="display: none;"> 
	Commuter Bus Selected
	</div>
	<input type="hidden" id="transportation_type_commuter_bus_input" name="transportation_type_commuter_bus" value="selected" disabled="true"/>
</div>


<input type="submit" value="Next"/>

</form>

</div>

</body>

</html>
