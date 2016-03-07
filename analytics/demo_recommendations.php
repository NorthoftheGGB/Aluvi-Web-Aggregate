<?php
$carpool_results = mysqli_query($users_con, "select name, zip from users where zip in (select zip from users u join preferences on u.id = user_id where carpool group by zip having count(*) > 1) order by zip");
$vanpool_results = mysqli_query($users_con, "select name, zip from users where zip in (select zip from users u join preferences on u.id = user_id where vanpool group by zip having count(*) > 5) order by zip");
$shuttle_results = mysqli_query($users_con, "select name, zip from users where zip in (select zip from users u join preferences on u.id = user_id where commuter_bus group by zip having count(*) > 11) order by zip");
$public_results = mysqli_query($users_con, "select name, zip from users u join preferences on u.id = user_id where public_transportation order by zip");
?>
<div class='col4'>
    <h2>Public Transportation</h2>
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
<div class='col4'>
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
<div class='col4'>
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
<div class='col4'>
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