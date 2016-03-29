<?php
include "auth.php";
include "../options.php";
$office = $_GET['office'];
include "../database.php";
include "make_charts.php";
//geographical data
$result = mysqli_query($con, "select u.zip, c.name city_name, c.id as city_id, cn.name county_name, cn.id as county_id
		       from demo_users.users u join demo_users.preferences p on p.user_id = u.id
		       join zipcode_locations zl on zl.zip = u.zip join cities c on c.id = zl.city join counties cn on cn.id = c.county
		       where u.office = $office group by u.zip
		       order by cn.name, c.name, u.zip");
while ($row = mysqli_fetch_array($result)){
	$zipcodes[] = array("code" => $row['zip'], "city" => $row['city_id']);
	$cities[$row['city_id']] = array("name" => $row['city_name'], "id" => $row['city_id'], "county" => $row['county_id']);
	$counties[$row['county_id']] = array("name" => $row['county_name'], "id" => $row['county_id'] );
}

//user data
if ($_GET['county'] && $_GET['county'] != 'all'){
	$fwhere = "where c.county=$_GET[county]";
	if ($_GET['city'] != 'all')
		$fwhere.= " and c.id = $_GET[city]";
	if ($_GET['zipcode'] != 'all')
		$fwhere .= " and u.zip = $_GET[zipcode]";
	$filter = "join (select u.id as id from users u join glassdoor.zipcode_locations z on z.zip = u.zip join glassdoor.cities c on c.id = z.city $fwhere)
	x on x.id = user_id";
}

$q1 = "select sum(carpool) as Carpool, sum(vanpool) as Vanpool, sum(public_transportation) as `Public Transportation` from preferences $filter
join users u on u.id=user_id where office=$office";
$tq1 = "select distinct(carpool_times_morning) as time from preferences $filter join users u on u.id=user_id where office=$office order by time";
$tq2 = "select distinct(carpool_times_evening) as time from preferences $filter join users u on u.id=user_id where office=$office order by time";
$uq = "select count(*) as number from preferences $filter join users u on u.id=user_id where office=$office ";
echo "<!--
$q1
-->";
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
      function showCities(county, init){
	$('.cityopt').hide();
	if (!init)
		$('#citysel').val('all');
	$('.county_'+county).show();
      }
      function showZipcodes(city, init){
	$('.zipopt').hide();
	if (!init){
		$('#citysel').val('all');
		$('#zipsel').val('all');
	}
	$('.city_'+city).show();
      }
    </script>        
    <style>
	.chart {float:left;}
	.cityopt, .zipopt {display:none;}
	@font-face {
	font-family: "Bryant";
	src: url(../resources/Bryant-Regular.ttf);
	}
	
	@font-face {
		font-family: "Bryant";
	src: url(../resources/Bryant-Medium.ttf);
	     font-weight:bold;
	}
	
	
	body{
	font-family:"Bryant", sans-serif;
	}
    </style>
  </head>
  <body onload="showCities($('#cntysel').val(), true); showZipcodes($('#citysel').val(), true);">
	
	<br/>
	<div style='width:1060px; margin:auto'>
	<form method = 'get' action = 'demo_charts.php'>
		<input type='hidden' name='office' value='<?php echo $office ?>' />
		<div style='margin-left:70px;'>
		<select name='county' id='cntysel' onchange='showCities(this.value, false)'>
			<option value='all'>All Counties</option>
			<?php foreach ($counties as $c){
				$selected = $c['id'] == $_GET['county'] ? 'selected' : '';
				echo "<option value='$c[id]' $selected>$c[name]</option>";
				}
			?>
		</select>
		<select name='city' id='ctysel' onchange='showZipcodes(this.value, false)'>
			<option value='all'>All Cities</option>
			<?php foreach ($cities as $c){
				$selected = $c['id'] == $_GET['city'] ? 'selected' : '';
				echo "<option value='$c[id]' $selected class='cityopt county_$c[county]'>$c[name]</option>";
				}
			?>
		</select>
		<select name='zipcode' id='zipsel' >
			<option value='all'>All Zip Codes</option>
			<?php foreach ($zipcodes as $z){
				$selected = $z['code'] == $_GET['zipcode'] ? 'selected' : '';
				echo "<option value='$z[code]' $selected class='zipopt city_$z[city]'>$z[code]</option>";
				}
			?>
		</select>
		<input type='submit' value='Show' />
		&nbsp;&nbsp&nbsp;
		<b style='margin-left:400px'><u>Total Sign Ups: <?php echo $users['number'] ?></u></b>
		</div>
	</form>
	<div class="chart" id="column1" style="width: 420px; height: 250px;"></div>
	<div  class="chart" id="pie1" style="width: 320px; height: 250px;"></div>
	<div  class="chart" id="pie2" style="width: 320px; height: 250px;"></div>
	</div>
  </body>
</html>
   