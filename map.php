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
		
		<p class="resultDescription">
		Thank you for providing your commute preferences. We'll be forming new transportation modes and potential incentives in the near future. Once these have been developed and implemented, we will notify you via email.
		</p>
		</div>


</div>
	</div>

	<div class="mapContainer">
		<div id="map">
		</div>
	</div>






<script>
// Data Structure

var zipcode =<?php echo $zip ?>;
var officeIcon = L.icon({
        iconUrl: "resources/work_marker.png",
        iconSize: [62, 60],
        iconAnchor: [30, 62],
        popupAnchor: [-7, -65],
	title: "Glassdoor",
	description: "You know it well."


});
var polygon_options = {
    color: '#7e1fda'
};

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
    .setView([<?php echo $office_coordinates ?>], 11);
    L.control.locate().addTo(map);


//add the custom markers to the map
var myLayer = L.mapbox.featureLayer().addTo(map);





//zip codes

if (zipcode.coordinates != undefined && zipcode.coordinates != null) {
var polygon = L.polygon(zipcode.coordinates, polygon_options).addTo(map);

zipCodeCentroid = polygon.getBounds().getCenter();
zipCodeCentroid = [zipCodeCentroid.lat, zipCodeCentroid.lng];

}




L.marker([<?php echo $office_coordinates ?>] ,{icon: officeIcon, title: '', description:''}).addTo(map);

</script>







</body>
</html>