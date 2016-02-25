<?php
include "database.php";
function addChart($element, $title, $data, $data_header, $type){
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
          title: '$title'
        };
        chart = new google.visualization.$type(document.getElementById('$element'));
        chart.draw(data, options);
";
}
$data1 = mysqli_fetch_assoc(mysqli_query("select sum(carpool) as Carpool, sum(vanpool) as Vanpool, sum(public_transportation) as `Public Transportation` from preferences"));
?>
<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawCharts);
      function drawCharts() {
	<?php addChart('column1', 'Globally', $data1, "['ilp', 'yilx']", 'ColumnChart') ?>
	<?php addChart('pie2', 'Totalism', array('pax' => 13, 'zim' => 25, 'yilf' => 18), "['ilp', 'yilx']", 'PieChart') ?>
        
      }
    </script>
  </head>
  <body>
    <div id="column1" style="width: 450px; height: 250px;"></div>
    <div id="pie2" style="width: 450px; height: 250px;"></div>
  </body>
</html>
   