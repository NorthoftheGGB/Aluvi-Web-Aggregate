<?php
if ($_POST['action'] == 'add vanpool'){
    $json = json_decode(file_get_contents($url = "https://maps.googleapis.com/maps/api/geocode/json?address=".str_replace(' ', '+', $_POST['address'])), true);
    echo "<!--
    $url
    ";
    
    var_dump($json);
    echo "-->";
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
            mysqli_query($users_con, $q = "insert into vanpool_pickup (leader_name, leader_email, location_title, departs_location, arrives_work, departs_work, lat, lng, zip$extra1)
                 values ('$_POST[name]', '$_POST[email]', '$_POST[address]', '$_POST[departs_location]', '$_POST[arrives_work]', '$_POST[departs_work]', $lat, $lng, '$zip'$extra2 )");
            
        }
        else $error = 'Location Not Found';
    }
    else $error = 'Location Not Found';
}
$vanpool_results = mysqli_query($users_con, "select leader_name, leader_email, location_title, departs_location, arrives_work, departs_work, id from vanpool_pickup");
?>
<form method='post' action='demo_analytics.php?view=Options'>
<input type='hidden' name='action' value='update options' />
<h2>Transportation Options</h2>
<input type='checkbox' name='Carpool' value='Carpool'/>

</form>
<form method='post' action='demo_analytics.php?view=Options'>
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
<a href='demo_analytics.php?view=Options'><input type='button' value='Cancel' /></a>
<?php } else { ?>
<input type='submit' value='Add Vanpool To Map' /> &nbsp;&nbsp; <span style='color:red'><?php echo $error ?> </span>
<?php } ?>
</form>