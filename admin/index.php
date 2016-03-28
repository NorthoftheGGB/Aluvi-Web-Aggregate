<?php
$context="demo";
$office = $_GET['office'];
if (!$office)
	$office = 1;
$main_url = "index.php?office=$office";
include "../database.php";
$office_results = mysqli_query($users_con, "select * from offices");
foreach ($office_results as $r){
	$url = "index.php?office=$r[id]";
	$selected = $office == $r['id'] ? 'selected' : '';
	if ($_GET['view'])
		$url .= '&view='.$_GET['view'];
	$office_options .= "<option value='$url' $selected>$r[name]</option>";
}
?>
<html>
	<head>
		<link href="admin.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="jquery-1.9.1.js"></script>	

	</head>
	<body>
		<center id="logo">
			<br/><img src='AluviGradient.png' /><br/><br/>
			
		</center>
		<div style="margin:10px">
			<center>
				<select onchange='window.location = $(this).val()'>
					<?php echo $office_options ?>
				</select>
			</center>
			<br />
			<div class='tabs'>
				
				<?php foreach(array("Survey", "Recommendations",  "Usage", "Users", "Sustainability", "Options", "Admin") as $tab){
					if ($tab == $_GET['view']) $selected = "class='selected'";
						else $selected = "";
					echo "<a href='$main_url&view=$tab' $selected>$tab</a>";
					}?>
			</div>
			<?php if (!$_GET['view'] || $_GET['view'] == 'Survey')  { ?>
			<iframe style="width:100%; height:340px" frameborder='0' src='charts.php?office=<?php echo $office ?>'></iframe>
			<iframe style="width:100%; height:450px" frameborder='0' src='heatmap.php?office=<?php echo $office ?>'></iframe>
			<?php } else if (in_array($_GET['view'], array('Users', "Recommendations", "Admin", "Options"))) {
				$view = strtolower($_GET['view']);
				include "$view.php";
			}
			else echo "<center><b>Coming Soon</b></center>";
			?>
		</div>
	</body>
</html>
   