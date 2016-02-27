<?php
$context = "demo";
include "database.php";
include "make_charts.php";
$q1 = "select sum(carpool) as Carpool, sum(vanpool) as Vanpool, sum(public_transportation) as `Public Transportation` from preferences";
$tq1 = "select distinct(carpool_times_morning) as time from preferences order by time";
$tq2 = "select distinct(carpool_times_evening) as time from preferences order by time";
$uq = "select count(*) as number from preferences";

$tr1 = mysqli_query($users_con, $tq1);
while ($row = mysqli_fetch_assoc($tr1)) {
	$times1[] = " sum(carpool_times_morning = '$row[time]') as `$row[time]`";
}
$times1 = implode(',', $times1);
$q2 = "select $times1 from preferences";
echo "<!--$q2-->";
$tr2 = mysqli_query($users_con, $tq2);
while ($row = mysqli_fetch_assoc($tr2)) {
	$times2[] = " sum(carpool_times_evening = '$row[time]') as `$row[time]`";
}
$times2 = implode(',', $times2);
$q3 = "select $times2 from preferences";
echo "<!--$q3-->";

$data1 = mysqli_fetch_assoc(mysqli_query($users_con, $q1));
$data2 = mysqli_fetch_assoc(mysqli_query($users_con, $q2));
$data3 = mysqli_fetch_assoc(mysqli_query($users_con, $q3));
$users = mysqli_fetch_assoc(mysqli_query($users_con, $uq));

?>
<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawCharts);
      function drawCharts() {
	<?php addChart('column1', 'ColumnChart', 'Transportation Types', $data1, "legend: { position: 'none' }") ?>
	<?php addChart('pie1',  'PieChart', 'Arrival Times', $data2) ?>
	<?php addChart('pie2',  'PieChart', 'Departure Times', $data3) ?>
        
      }
    </script>
    <style>
	.chart {float:left;}
    </style>
  </head>
  <body>
	<div style='margin:auto; font-size:20px; width:700px; '>
		<span style='margin-right:400px'>Total Sign Ups: <?php echo $users['number'] ?></span>
		<a href='demo_csv.php'>Download CSV</a>
	</div>
	<br/><br/><br/>
	<div style='width:1060px; margin:auto'>
	<div class="chart" id="column1" style="width: 420px; height: 250px;"></div>
	<div  class="chart" id="pie1" style="width: 320px; height: 250px;"></div>
	<div  class="chart" id="pie2" style="width: 320px; height: 250px;"></div>
	</div>
  </body>
</html>
   