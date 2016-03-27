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
<div class="result">
<p class="resultDescription">
Thank you for providing your commute preferences. WeÕll be forming new transportation modes and potential incentives in the near future. Once we have, you will be notified.
</p>
</div>
<!--
<div class="result">
	                <h2 class="resultType">Glassdoor's Location!</h2>              

<br/>
-->
</div>
	</div>

	<div class="mapContainer">
		<div id="map">
		</div>
	</div>


</div>




<script>
// Data Structure

var zipcode =<?php echo $zip ?>;


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



var polygon_options = {
    color: '#7e1fda'
};


var ficoIcon = L.icon({
        iconUrl: "resources/work_marker.png",
        iconSize: [62, 60],
        iconAnchor: [30, 62],
        popupAnchor: [-7, -65],
	title: "Glassdoor",
	description: "You know it well."


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


//popups

var glassdoorPopup = "Glassdoor<br/>100 Shoreline Hwy, Mill Valley, CA 94941";
var glassdoorOptions =
{
	'maxWidth': '600',
	'border-radius':'5px',
} 

var carpoolPopup = "Carpool Pickup Point<br/><br/>Amanda Green<br/>amanda.green@glassdoor.com<br/>Driver and River<br/><br/>Jason Adams<br/>jason.adams@glassdoor.com<br/>Driver and Rider<br/><br/>Ryan Russel<br/>ryan.russel@glassdoor.com<br/>Rider";
var carpoolOptions =
{
        'maxWidth': '600',
        'border-radius':'5px',
} 

var vanpoolPopup = "Vanpool Pickup Point<br/><br/>Vanpool Leader:<br/>Karen Tripp<br/>karen.tripp@glassdoor.com<br/><br/>To Glassdoor<br/>Pickup Time: 7:45am<br/>Arrival Time: 8:45am<br/><br/>Back Home<br/>Pickup Time: 4:45pm<br/>Arrival Time: 5:45pm<br/><br/><a href=\"#\">View Glassdoor's Vanpooling Rules</a>";
var vanpoolOptions =
{
        'maxWidth': '600',
        'border-radius':'5px',
} 
var ferryPopup = "Ferry<br/>";
var ferryOptions =
{
        'maxWidth': '600',
        'border-radius':'5px',
} 
var publicTransitPopup = "PublicTransit<br/>This is your closest Golden Gate Transit Stop<br/><br/>Check Golden Gate Transit's information <a href=\"http://www.goldengatetransit.org/\" target=\"_blank\" >Here</a>";
var publicTransitOptions =
{
        'maxWidth': '600',
        'border-radius':'5px',
} 



var customPopup = "Glassdoor<br/><img src='http://joshuafrazier.info/images/maptime.gif' alt='maptime logo gif' width='350px'/>";
var customOptions =
{
	'maxWidth': '600',
	'border-radius':'5px',
} 


//zip codes

if (zipcode.coordinates != undefined && zipcode.coordinates != null) {
var polygon = L.polygon(zipcode.coordinates, polygon_options).addTo(map);

zipCodeCentroid = polygon.getBounds().getCenter();
zipCodeCentroid = [zipCodeCentroid.lat, zipCodeCentroid.lng];

}


//markers
/*
if (transportModes.carpool != undefined) {

	L.marker(zipCodeCentroid, {icon: carpoolIcon , title:'Carpooling via Aluvi'}).addTo(map);

        for(i = 0; i < 1; i++) {
             //   L.marker(transportModes.carpool.coordinates[i] ,{icon: carpoolIcon, title:'Aluvi Pickup Point'}).bindPopup(carpoolPopup,carpoolOptions).addTo(map);
        };
}

if (transportModes.carpool2 != undefined) {
        for(i = 0; i < 2; i++) {
     //           L.marker(transportModes.carpool2.coordinates[i] ,{icon: carpoolIcon, title:'Aluvi Pickup Point'}).bindPopup(carpoolPopup,carpoolOptions).addTo(map);
        };
}

if (transportModes.bus != undefined) {
        for(i = 0; i < transportModes.bus.coordinates.length; i++) {
                L.marker(transportModes.bus.coordinates[i] ,{icon: busIcon, title:'Bus Stop'}).addTo(map);
        };
}


if (transportModes.ferry != undefined) {
        for(i = 0; i < transportModes.ferry.coordinates.length; i++) {
                L.marker(transportModes.ferry.coordinates[i] ,{icon: ferryIcon, title:'Ferry Pickup'}).addTo(map);
        };
}

if (transportModes.vanpool != undefined) {
        for(i = 0; i < transportModes.vanpool.coordinates.length ; i++) {
                L.marker(transportModes.vanpool.coordinates[i] ,{icon: vanpoolIcon, title:'Vanpool Pickup Point'}).addTo(map);
        };
}
*/

L.marker([<?php echo $office_coordinates ?>] ,{icon: ficoIcon, title: '', description:''}).addTo(map);

</script>







</body>
</html>
