<?php
include "database.php";
function addChart($element, $type, $title, $data, $data_header = "['','']"){
foreach ($data as $k => $v){
	$data_fmt[] = "['$k', $v]";
}
$data_fmt = implode(",", $data_fmt);
echo
"
        data = google.visualization.arrayToDataTable([
          $data_header,
	  $data_fmt
        ]);
        options = {
          title: '$title',
	  legend: { position: 'none' }
        };
        chart = new google.visualization.$type(document.getElementById('$element'));
        chart.draw(data, options);
";
}
$data1 = mysqli_fetch_assoc(mysqli_query($users_con, "select sum(carpool) as Carpool, sum(vanpool) as Vanpool, sum(public_transportation) as `Public Transportation` from preferences"));
?>
<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawCharts);
      function drawCharts() {
	<?php addChart('column1', 'ColumnChart', 'Globally', $data1, "['Users', '']") ?>
	<?php addChart('pie2',  'PieChart', 'Totalism', array('pax' => 13, 'zim' => 25, 'yilf' => 18)) ?>
        
      }
    </script>
  </head>
  <body>
    <div id="column1" style="width: 450px; height: 250px;"></div>
    <div id="pie2" style="width: 450px; height: 250px;"></div>
  </body>
</html>
   