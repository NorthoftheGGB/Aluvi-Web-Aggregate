<?php
include "auth.php";
include "../options.php";
$office = $_GET['office'];
include "../database.php";
if ($_GET['type']){
	$where = "and $_GET[type]";
}
//heatmap
$result = mysqli_query($users_con, "select lat, lng from glassdoor.zipcode_locations z join users u on u.zip = z.zip
					  join preferences p on u.id = p.user_id $where where office = $office");
while ($row = mysqli_fetch_assoc($result)) {
	$heatmap_data[] = "new google.maps.LatLng($row[lat], $row[lng])";
}
$heatmap_data = implode(",", $heatmap_data);
?>
<html>
  <head>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=visualization"></script>
    <script>
var map, pointarray, heatmap;
 
var data = [
  <?php echo $heatmap_data ?>
];
 
 
function initialize() {
  // the map's options
  var mapOptions = {
    zoom: 8,
    center: new google.maps.LatLng(37.794546, -122.433523)  };
 
  // the map and where to place it
  map = new google.maps.Map(document.getElementById('heatmap'), mapOptions);
 
  var pointArray = new google.maps.MVCArray(data);
 
  // what data for the heatmap and how to display it
  heatmap = new google.maps.visualization.HeatmapLayer({
    data: pointArray,
    radius: 50
  });
 
  // placing the heatmap on the map
  heatmap.setMap(map);
}
 
// as soon as the document is ready the map is initialized
google.maps.event.addDomListener(window, 'load', initialize);
 
    </script>
  </head>
  <body>
	<div style='width:800px; margin:auto;'>
		<form method='get' action='demo_heatmap.php'>
			<input type='hidden' name='office' value='<?php echo $office ?>' />
			<select name='type'>
				<option value=''>All Transportation Types</option>
				<option value='carpool' <?php if($_GET['type'] == 'carpool') echo 'selected' ?>>Carpool</option>
				<option value='vanpool' <?php if($_GET['type'] == 'vanpool') echo 'selected' ?>>Vanpool</option>
				<option value='public_transportation' <?php if($_GET['type'] == 'public_transportation') echo 'selected' ?>>Public Transportation</option>
			</select>
			<input type='submit' value='Show' />
		</form>
	</div>
	<center>
		<div style = "width:800px; height:400px;" id="heatmap"></div>
	</center>
  </body>
</html>
   