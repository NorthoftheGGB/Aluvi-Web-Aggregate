<?php
$context = "demo";
include "database.php";
include "make_charts.php";
//geographical data
$result = mysqli_query($con, "select u.zip, c.name city_name, c.id as city_id, cn.name county_name, cn.id as county_id
		       from demo_users.users u join demo_users.preferences p on p.user_id = u.id
		       join zipcode_locations zl on zl.zip = u.zip join cities c on c.id = zl.city join counties cn on cn.id = c.county group by u.zip
		       order by cn.name, c.name, u.zip");
while ($row = mysqli_fetch_array($result)){
	$zipcodes[] = array("code" => $row['zip'], "city" => $row['city_id']);
	$cities[$row['city_id']] = array("name" => $row['city_name'], "id" => $row['city_id'], "county" => $row['county_id']);
	$counties[$row['county_id']] = array("name" => $row['county_name'], "id" => $row['county_id'] );
}

//user data
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
    <script type="text/javascript" src="jquery-1.9.1.js"></script>	
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawCharts);
      function drawCharts() {
	<?php addChart('column1', 'ColumnChart', 'Transportation Types', $data1, "legend: { position: 'none' }") ?>
	<?php addChart('pie1',  'PieChart', 'Arrival Times', $data2) ?>
	<?php addChart('pie2',  'PieChart', 'Departure Times', $data3) ?>
        
      }
      function showCities(county){
	$('.cityopt').hide();
	$('#citysel').val('');
	$('.county_'+county).show();
      }
      function showZipcodes(city){
	$('.zipopt').hide();
	$('#citysel').val('');
	$('#zipsel').val('');
	$('.city_'+city).show();
      }
    </script>
    <style>
	.chart {float:left;}
	.cityopt, .zipopt {display:none;}
    </style>
  </head>
  <body>
	<div style='margin:auto; font-size:20px; width:700px; '>
		<span style='margin-right:400px'>Total Sign Ups: <?php echo $users['number'] ?></span>
		<a href='demo_csv.php'>Download CSV</a>
	</div>
	<br/><br/><br/>
	<div style='width:1060px; margin:auto'>
	<form method = 'get' action = 'demo_charts.php'>
		<span style='width:100px;'></span>
		<select name='county' onchange='showCities(this.value)'>
			<option value='all'>All Counties</option>
			<?php foreach ($counties as $c){
				echo "<option value='$c[id]'>$c[name]</option>";
				}
			?>
		</select>
		<select name='city' id='ctysel' onchange='showZipcodes(this.value)'>
			<option>All Cities</option>
			<?php foreach ($cities as $c){
				echo "<option value='$c[id]' class='cityopt county_$c[county]'>$c[name]</option>";
				}
			?>
		</select>
		<select name='zipcode' id='zipsel' >
			<option value='all'>All Zip Codes</option>
			<?php foreach ($zipcodes as $z){
				echo "<option value='$z[id]' class='zipopt city_$z[city]'>$z[code]</option>";
				}
			?>
		</select>
		<input type='submit' value='Show' />
	</form>
	<div class="chart" id="column1" style="width: 420px; height: 250px;"></div>
	<div  class="chart" id="pie1" style="width: 320px; height: 250px;"></div>
	<div  class="chart" id="pie2" style="width: 320px; height: 250px;"></div>
	</div>
  </body>
</html>
   