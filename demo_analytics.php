<?php $context="demo"; ?>
<html>
	<head>
		<style>
			.tabs {margin-bottom:2em; text-align:center; width:100%}
			.tabs a {margin-right:25px;}
			table, th, td {
				 border: 1px solid black;
			}
			table {
				border-collapse:collapse;

			}
			td, th {
				padding:2px;
			}
			.col4 {
				float:left;
				width:23%;
			}
		</style>
	</head>
	<body>
		<div class='tabs'>
			<?php foreach(array("Survey", "Recommendations",  "Usage", "Users", "Sustainability", "Admin") as $tab){
				if ($tab == $_GET['view']) $selected = "class='selected'";
					else $selected = "";
				echo "<a href='demo_analytics.php?view=$tab' $selected>$tab</a>";
				}?>
		</div>
		<?php if (!$_GET['view'] || $_GET['view'] == 'Survey')  { ?>
		<iframe style="width:100%; height:400px" frameborder='0' src='analytics/demo_charts.php'></iframe>
		<iframe style="width:100%; height:450px" frameborder='0' src='analytics/demo_heatmap.php'></iframe>
		<?php } else if (in_array($_GET['view'], array('Users'))) {
			$view = strtolower($_GET['view']);
			include "database.php";
			include "analytics/demo_$view.php";
		}
		else echo "(Under Construction)"
		?>
	</body>
</html>
   