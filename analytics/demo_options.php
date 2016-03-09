<?php
if ($_POST['action'] == 'update options'){
    $carpool = 0 + $_POST['carpool'];
    $vanpool = 0 + $_POST['vanpool'];
    $bicycle = 0 + $_POST['bicycle'];
    $public_transportation = 0 + $_POST['public_transportation'];
    $commuter_shuttle = 0 + $_POST['commuter_shuttle'];
    $times = 0 + $_POST['times'];
    $driver = 0 + $_POST['driver'];
    mysqli_query($users_con, $q = "update transit_options set carpool = $carpool, vanpool = $vanpool,
                 bicycle = $bicycle, public_transportation = $public_transportation, commuter_shuttle = $commuter_shuttle, times = $times, driver=$driver
                 where office = $office");
    echo "<!--$q-->";
}
if ($_POST['action'] == 'add vanpool'){
    $json = json_decode(file_get_contents($url = "https://maps.googleapis.com/maps/api/geocode/json?address=".str_replace(' ', '+', $_POST['address'])), true);
    if (count($json['results']) == 1){
        $res = $json['results'][0];
        foreach ($res['address_components'] as $x){
            if ($x['types'][0] == 'postal_code'){
                $zip = $x['short_name'];
                break;
            }
        }
        if ($zip) {
            $lat = $res['geometry']['location']['lat'];
            $lng = $res['geometry']['location']['lng'];
            if ($_POST['edit_id']){
                mysqli_query($users_con, "delete from vanpool_pickup where id = $_POST[edit_id]");
                $extra1 = ', id';
                $extra2 = ', '.$_POST['edit_id'];
            }
            mysqli_query($users_con, $q = "insert into vanpool_pickup (office, leader_name, leader_email, location_title, departs_location, arrives_work, departs_work, lat, lng, zip$extra1)
                 values ($office, '$_POST[name]', '$_POST[email]', '$_POST[address]', '$_POST[departs_location]', '$_POST[arrives_work]', '$_POST[departs_work]', $lat, $lng, '$zip'$extra2 )");
            
        }
        else $error = 'Location Not Found';
    }
    else $error = 'Location Not Found';
}
$vanpool_results = mysqli_query($users_con, "select leader_name, leader_email, location_title, departs_location, arrives_work, departs_work, id from vanpool_pickup where office = $office");
$transit_options = mysqli_fetch_array(mysqli_query($users_con, "select * from transit_options where office = $office"), MYSQLI_NUM);
$ti = 0;
?>
<form method='post' action='<?php echo $main_url?>&view=Options'>
<input type='hidden' name='action' value='update options' />
<h2>Transportation Options</h2>
<label>
<input type='checkbox' name='carpool' value='1' <?php echo $transit_options[$ti++] ? "checked" : "" ?>/>
Carpool
</label>
&nbsp;&nbsp;
<label>
<input type='checkbox' name='vanpool' value='1' <?php echo $transit_options[$ti++] ? "checked" : "" ?>/>
Vanpool
</label>
&nbsp;&nbsp;
<label>
<input type='checkbox' name='public_transportation' value='1' <?php echo $transit_options[$ti++] ? "checked" : "" ?>/>
Public Transportation
</label>
&nbsp;&nbsp;
<label>
<input type='checkbox' name='bicycle' value='1' <?php echo $transit_options[$ti++] ? "checked" : "" ?>/>
Bicycle
</label>
&nbsp;&nbsp;
<label>
<input type='checkbox' name='commuter_shuttle' value='1' <?php echo $transit_options[$ti++] ? "checked" : "" ?>/>
Commuter Shuttle
</label>
<br />
<label>
<input type='checkbox' name='times' value='1' <?php echo $transit_options[$ti++] ? "checked" : "" ?>/>
Commute Times
</label>
<label>
<input type='checkbox' name='driver' value='1' <?php echo $transit_options[$ti++] ? "checked" : "" ?>/>
Driver/Rider
</label>
<br /><br />
<input type='submit' value='Update' />
</form>
<form method='post' action='<?php echo $main_url?>&view=Options'>
<input type='hidden' name='action' value='add vanpool' />
<?php if ($id = $_GET['edit']) echo "<input type='hidden' name='edit_id' value='$id' />" ?>
<h2>Vanpools</h2>
<table style='width:100%'>
    <tr>
        <th>Leader Name</th>
        <th>Email</th>
        <th>Pickup Location</th>
        <th>Departs Location</th>
        <th>Arrives Work</th>
        <th>Departs Work</th>
        <th>&nbsp;</th>
    </tr>
    <?php
        while ($row = mysqli_fetch_assoc($vanpool_results)){
            if ($row['id'] == $id) {
                $val = array();
                foreach ($row as $v){
                    $val[] = "value = '$v'";
                }
                $x = 0;
            }
            else {
            echo "<tr>";
                foreach ($row as $c => $v){
                    if ($c != "id")
                        echo "<td>$v</td>";
                    else echo "<td><a href='demo_analytics.php?view=Options&edit=$v'>Edit</td>";
                }
            }
        }
        echo "</tr>";
    ?>
    <tr class='input'>
        <td><input style='width:100%' type='text' placeholder='Leader Name' name='name' <?php echo $val[$x++] ?>/></td>
        <td><input style='width:100%' type='text' placeholder='Leader Email' name='email' <?php echo $val[$x++] ?>/></td>
        <td><input style='width:100%' type='text' placeholder='Pickup Location' name='address' <?php echo $val[$x++] ?>/></td>
        <td><input style='width:100%' type='text' placeholder='Departs Location' name='departs_location' <?php echo $val[$x++] ?>/></td>
        <td><input style='width:100%' type='text' placeholder='Arrives Work' name='arrives_work' <?php echo $val[$x++] ?>/></td>
        <td><input style='width:100%' type='text' placeholder='Departs Work' name='departs_work' <?php echo $val[$x++] ?>/></td>
        <td>&nbsp;</td>
    </tr>
</table>
<br/>
<?php if ($id) { ?>
<input type='submit' value='Update' />
<a href='<?php echo $main_url?>&view=Options'><input type='button' value='Cancel' /></a>
<?php } else { ?>
<input type='submit' value='Add Vanpool To Map' /> &nbsp;&nbsp; <span style='color:red'><?php echo $error ?> </span>
<?php } ?>
</form>