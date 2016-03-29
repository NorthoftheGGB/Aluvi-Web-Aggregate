<?php
$carpool_results = mysqli_query($users_con, "select name, zip from users u join preferences on u.id = user_id where office = $office and carpool and zip in (select zip from users u join preferences on u.id = user_id where carpool group by zip having count(*) > 1) order by zip");
$vanpool_results = mysqli_query($users_con, "select name, zip from users u join preferences on u.id = user_id where office = $office and vanpool and zip in (select zip from users u join preferences on u.id = user_id where vanpool group by zip having count(*) > 5) order by zip");
$shuttle_results = mysqli_query($users_con, "select name, zip from users u join preferences on u.id = user_id where office = $office and commuter_bus and zip in (select zip from users u join preferences on u.id = user_id where commuter_bus group by zip having count(*) > 11) order by zip");
$public_results = mysqli_query($users_con, "select name, zip from users u join preferences on u.id = user_id where office = $office and public_transportation order by zip");
$bike_results = mysqli_query($users_con, "select name, zip from users u join preferences on u.id = user_id where office = $office and bicycle order by zip");
$walking_results = mysqli_query($users_con, "select name, zip from users u join preferences on u.id = user_id where office = $office and walking order by zip");

?>
<div style="width:1060px; margin:auto">
<div class='col5'>
    <h2>Walking</h2>
<?php
  $zip = 0;
  $results = false;
  while ($row=mysqli_fetch_array($walking_results)){
    $results = true;
    if ($row['zip'] != $zip ){
        echo "<div class='zipItem'>$row[zip]</div>";
        $zip = $row['zip'];
    }
    echo "<div class='nameItem'>$row[name]</div>";
  }
  if (!$results) echo "<i>No Results</i>";
?>   
</div>
<div class='col5'>
    <h2>Bicycle</h2>
<?php
  $zip = 0;
  $results = false;
  while ($row=mysqli_fetch_array($bike_results)){
    $results = true;
    if ($row['zip'] != $zip ){
        echo "<div class='zipItem'>$row[zip]</div>";
        $zip = $row['zip'];
    }
    echo "<div class='nameItem'>$row[name]</div>";
  }
  if (!$results) echo "<i>No Results</i>";
?>   
</div>
<div class='col5'>
    <h2>Public Transit</h2>
<?php
  $zip = 0;
  $results = false;
  while ($row=mysqli_fetch_array($public_results)){
    $results = true;
    if ($row['zip'] != $zip ){
        echo "<div class='zipItem'>$row[zip]</div>";
        $zip = $row['zip'];
    }
    echo "<div class='nameItem'>$row[name]</div>";
  }
  if (!$results) echo "<i>No Results</i>";
?>  
</div>
<div class='col5'>
    <h2>Carpool</h2>
<?php
  $zip = 0;
  $results = false;
  while ($row=mysqli_fetch_array($carpool_results)){
    $results = true;
    if ($row['zip'] != $zip ){
        echo "<div class='zipItem'>$row[zip]</div>";
        $zip = $row['zip'];
    }
    echo "<div class='nameItem'>$row[name]</div>";
  }
  if (!$results) echo "<i>No Results</i>";
?>    
</div>
<div class='col5'>
    <h2>Vanpool</h2>
<?php
  $zip = 0;
  $results = false;
  while ($row=mysqli_fetch_array($vanpool_results)){
    $results = true;
    if ($row['zip'] != $zip ){
        echo "<div class='zipItem'>$row[zip]</div>";
        $zip = $row['zip'];
    }
    echo "<div class='nameItem'>$row[name]</div>";
  }
  if (!$results) echo "<i>No Results</i>";
?>   
</div>

<div class='col5'>
    <h2>Commuter Shuttle</h2>
<?php
  $zip = 0;
  $results = false;
  while ($row=mysqli_fetch_array($shuttle_results)){
    $results = true;
    if ($row['zip'] != $zip ){
        echo "<div class='zipItem'>$row[zip]</div>";
        $zip = $row['zip'];
    }
    echo "<div class='nameItem'>$row[name]</div>";
  }
  if (!$results) echo "<i>No Results</i>";
?>    
</div>

</div>