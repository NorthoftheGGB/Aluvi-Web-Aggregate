<?php
function addChart($element, $title, $data, $data_header, $type){
foreach ($data as $d){
	$data_fmt[] = "['$d[0]', $d[1]]";
}
$data_fmt = implode(",", $data_fmt);
echo
"
        data = google.visualization.arrayToDataTable([
          $data_header
          $data_fmt
        ]);
        options = {
          title: '$title'
        };
        chart = new google.visualization.$type(document.getElementById('$element'));
        chart.draw(data, options);
";
}
?>
<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
	<?php addChart('pie1', 'Mentalism', array(array('pox', 23),array('lim', 50),array('arum', 17)), "['ilp', 'yilx']", 'PieChart') ?>
	<?php addChart('pie2', 'Totalism', array(array('pax', 13),array('lim', 30),array('arum', 27)), "['ilp', 'yilx']", 'PieChart') ?>
        
      }
    </script>
  </head>
  <body>
    <div id="pie1" style="width: 450px; height: 250px;"></div>
    <div id="pie2" style="width: 450px; height: 250px;"></div>
  </body>
</html>
   