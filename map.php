<?php include "add_user.php" ?>
<html>
<head>
<title>Aluvi</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<link href="style.css" rel="stylesheet">
<script src='https://api.mapbox.com/mapbox.js/v2.2.3/mapbox.js'></script>
<link href='https://api.mapbox.com/mapbox.js/v2.2.3/mapbox.css' rel='stylesheet' />

</head>

<body>


<script src='https://api.mapbox.com/mapbox.js/plugins/leaflet-locatecontrol/v0.43.0/L.Control.Locate.min.js'></script>
<link href='https://api.mapbox.com/mapbox.js/plugins/leaflet-locatecontrol/v0.43.0/L.Control.Locate.mapbox.css' rel='stylesheet' />
<!--[if lt IE 9]>
<link href='https://api.mapbox.com/mapbox.js/plugins/leaflet-locatecontrol/v0.43.0/L.Control.Locate.ie.css' rel='stylesheet' />
<![endif]-->
<link href='https://api.mapbox.com/mapbox.js/plugins/leaflet-locatecontrol/v0.43.0/css/font-awesome.min.css' rel='stylesheet' />
<script src='https://api.mapbox.com/mapbox.js/plugins/leaflet-label/v0.2.1/leaflet.label.js'></script>
<link href='https://api.mapbox.com/mapbox.js/plugins/leaflet-label/v0.2.1/leaflet.label.css' rel='stylesheet' />


<div class="container2">
	
	<div class="resultsContainer">

		<div class="result">
		<h2 class="resultType">Carpool</h2>
		<p class="resultDescription"> Make extra cash doing what you already do! Pick up coworkers on your drive to work by downlading the Aluvi app for <a target="_blank" href="https://itunes.apple.com/us/app/aluvi/id914223284?mt=8">iOS</a> or <a target="_blank" href="https://play.google.com/store/apps/details?id=com.aluvi.android">Android</a></p>
		</div>


<div class="result" id="67890">
                <h2 class="resultType">Vanpool</h2>               
 <p class="resultDescription"> Meet your co-workers at one of the vanpool pickup spots. There is one near your house, get in on the planning <a target="_blank" href="#">here.</a></p>
                </div>

<div class="result" id="12345">
                <h2 class="resultType">Public Transport</h2>               
 <p class="resultDescription"> Walk or ride your bike to these bus stops: 
	<?php
		foreach ($stop_info as $stop){
			echo "<br />$stop";
		}
	?>
</p>
               </div>


<div class="result" id="123451">
                <h2 class="resultType">Ferry</h2>              
  <p class="resultDescription">Bike to the ferry! Plan the details <a target="_blank" href="http://goldengateferry.org/schedules/Sausalito.php">here.</a></p>
                </div>
	</div>


	<div class="mapContainer">
		<div id="map">
		</div>
	</div>


</div>




<script>
// TODO: add id's to trasportation options in htlm
// fake testing polygon
// show and hide id's 

// Data Structure

var zipcode =<?php echo $zip ?>;

var transportModes = <?php echo $transportationModes; ?>;



</script>




<script>
// Dummy Logic
 
var qs = (function(a) {
    if (a == "") return {};
    var b = {};
    for (var i = 0; i < a.length; ++i)
    {
        var p=a[i].split('=', 2);
        if (p.length == 1)
            b[p[0]] = "";
        else
            b[p[0]] = decodeURIComponent(p[1].replace(/\+/g, " "));
    }
    return b;
})(window.location.search.substr(1).split('&'));


</script>


<script>
// View Scrips
L.mapbox.accessToken = 'pk.eyJ1IjoiYWx1dmltYXBzIiwiYSI6ImJlYjg2M2FmNjA4OGZhYjk2ZDRhMGFiZjY1MDQ3ZGYwIn0.2bARToCtaZXue3KJm-WYPQ';
// Create a map in the div #map
var map = L.mapbox.map('map', 'aluvimaps.o4c16jlk')
    .setView([37.863, -122.375], 11);
    L.control.locate().addTo(map);


//add the custom markers to the map
var myLayer = L.mapbox.featureLayer().addTo(map);



var keys = Object.keys(transportModes);
keys.forEach(function(key){

//geojson codes and styling for each maybe a loop or not
// get element by id and set to visible

});



//myLayer.addPolygon or something
// as in, add the polygon to the map


var polygon_options = {
    color: '#7e1fda'
};


var glassdoorIcon = L.icon({
        iconUrl: "resources/glassdoor_marker.png",
        iconSize: [62, 60],
        iconAnchor: [30, 62],
        popupAnchor: [-7, -65]
});


var carpoolIcon = L.icon({
        iconUrl: "resources/carpool_marker.png",
        iconSize: [62, 60],
        iconAnchor: [30, 62],
        popupAnchor: [-7, -65],
});


var vanpoolIcon = L.icon({
        iconUrl: "resources/vanpool_marker.png",
        iconSize: [62, 60],
        iconAnchor: [30, 62],
        popupAnchor: [-7, -65],
});

var ferryIcon = L.icon({
	iconUrl: "resources/ferry_marker.png",
	iconSize: [62, 60],
	iconAnchor: [30, 62],
	popupAnchor: [-7, -65],
});

var busIcon = L.icon({
        iconUrl: "resources/bus_marker.png",
        iconSize: [62, 60],
        iconAnchor: [30, 62],
        popupAnchor: [-7, -65],
});

/*
//zip codes
var polygon = L.polygon(zipcode.coordinates, polygon_options).addTo(map);
*/

//markers
L.marker([37.880298, -122.514733] ,{icon: glassdoorIcon, title: 'glassdoor'}).addTo(map);

if (transportModes.carpool != undefined) {
        for(i = 0; i < 1; i++) {
                L.marker(transportModes.carpool.coordinates[i] ,{icon: carpoolIcon, title:'Aluvi Pickup Point'}).addTo(map);
        };
}

if (transportModes.carpool2 != undefined) {
        for(i = 0; i < 2; i++) {
                L.marker(transportModes.carpool2.coordinates[i] ,{icon: carpoolIcon, title:'Aluvi Pickup Point'}).addTo(map);
        };
}

if (transportModes.bus != undefined) {
        for(i = 0; i < 3; i++) {
                L.marker(transportModes.bus.coordinates[i] ,{icon: busIcon, title:'Bus Stop'}).addTo(map);
        };
}


if (transportModes.ferry != undefined) {
        for(i = 0; i < 2; i++) {
                L.marker(transportModes.ferry.coordinates[i] ,{icon: ferryIcon, title:'Ferry Pickup'}).addTo(map);
        };
}

if (transportModes.vanpool != undefined) {
        for(i = 0; i < 2; i++) {
                L.marker(transportModes.vanpool.coordinates[i] ,{icon: vanpoolIcon, title:'Vanpool Pickup Point'}).addTo(map);
        };
}

</script>







</body>
</html>
