<?php
$context="demo";
$office = $_GET['office'];
if (!$office)
	$office = 1;
$main_url = "demo_analytics.php?office=$office";
include "database.php";
$office_results = mysqli_query($users_con, "select * from offices");
foreach ($office_results as $r){
	$url = "demo_analytics.php?office=$r[id]";
	$selected = $office == $r['id'] ? 'selected' : '';
	if ($_GET['view'])
		$url .= '&view='.$_GET['view'];
	$office_options .= "<option value='$url' $selected>$r[name]</option>";
}
?>
<html>
	<head>
		<style>
			.tabs {margin-bottom:2em; text-align:center; width:100%}
			.tabs a, .tabs select {margin-right:25px;}
			table, th, td {
				 border: 1px solid black;
			}
			table {
				border-collapse:collapse;

			}
			td, th {
				padding:2px;
			}
			.col5 {
				float:left;
				width:19%;
			}
			.col5 h2 {
				font-size:20px;
			}
			.zipItem{
				font-weight:bold;
			}
			.nameItem{
				margin-left:1em;	
			}
			.input td{
				padding:0;
			}
		</style>
		<script type="text/javascript" src="analytics/jquery-1.9.1.js"></script>	

	</head>
	<body>
		<div class='tabs'>
			<select onchange='window.location = $(this).val()'>
				<?php echo $office_options ?>
			</select>
			<?php foreach(array("Survey", "Recommendations",  "Usage", "Users", "Sustainability", "Options", "Admin") as $tab){
				if ($tab == $_GET['view']) $selected = "class='selected'";
					else $selected = "";
				echo "<a href='$main_url&view=$tab' $selected>$tab</a>";
				}?>
		</div>
		<?php if (!$_GET['view'] || $_GET['view'] == 'Survey')  { ?>
		<iframe style="width:100%; height:400px" frameborder='0' src='analytics/demo_charts.php?office=<?php echo $office ?>'></iframe>
		<iframe style="width:100%; height:450px" frameborder='0' src='analytics/demo_heatmap.php?office=<?php echo $office ?>'></iframe>
		<?php } else if (in_array($_GET['view'], array('Users', "Recommendations", "Admin", "Options"))) {
			$view = strtolower($_GET['view']);
			include "analytics/demo_$view.php";
		}
		else echo "(Under Construction)"
		?>
	</body>
</html>
   