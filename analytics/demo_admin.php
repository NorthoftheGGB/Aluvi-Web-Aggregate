<?php
if ($_POST['action'] == 'add user'){
    $name = mysqli_real_escape_string($users_con, $_POST['name']);
    mysqli_query($users_con, $Q = "insert into admin (name, email) values ('$name', '$_POST[email]')");
}
else if ($_POST['action'] == 'add vanpool'){
    $json = json_decode(file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?address=".str_replace(' ', '+', $_POST['address'])), true);
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
            mysqli_query($users_con, $q = "insert into vanpool_pickup (leader_name, leader_email, location_title, departs_location, arrives_work, departs_work, lat, lng, zip)
                 values ($_POST[name], $_POST[email], $_POST[address], $_POST[departs_location], $_POST[arrives_work], $_POST[departs_work], $lat, $lng, $zip )");
        }
        else $error = 'Location Not Found';
    }
    else $error = 'Location Not Found';
}
$admin_results = mysqli_query($users_con, "select name, email from admin");
$vanpool_results = mysqli_query($users_con, "select leader_name, leader_email, location_title, departs_location, arrives_work, departs_work from vanpool_pickup");
?>
<form method='post' action='demo_analytics.php?view=Admin'>
<input type='hidden' name='action' value='add user' />
<h2>Admins</h2>
<table style='width:30%'>
    <tr>
        <th>Name</th>
        <th>Email</th>
    </tr>
    <?php
        while ($row = mysqli_fetch_assoc($admin_results)){
        echo "<tr>";
            foreach ($row as $c){
                echo "<td>$c</td>";
            }
        }
        echo "</tr>";
    ?>
    <tr class='input'>
        <td><input style='width:100%' type='text' placeholder='Name' name='name'/></td>
        <td><input style='width:100%' type='text' placeholder='Email' name='email'/></td>
    </tr>
</table>
<br/>
<input type='submit' value='Add User' />
</form>
<form method='post' action='demo_analytics.php?view=Admin'>
<input type='hidden' name='action' value='add vanpool' />
<h2>Vanpools</h2>
<table style='width:100%'>
    <tr>
        <th>Leader Name</th>
        <th>Email</th>
        <th>Pickup Location</th>
        <th>Departs Location</th>
        <th>Arrives Work</th>
        <th>Departs Work</th>
    </tr>
    <?php
        while ($row = mysqli_fetch_assoc($vanpool_results)){
        echo "<tr>";
            foreach ($row as $c){
                echo "<td>$c</td>";
            }
        }
        echo "</tr>";
    ?>
    <tr class='input'>
        <td><input style='width:100%' type='text' placeholder='Leader Name' name='name'/></td>
        <td><input style='width:100%' type='text' placeholder='Leader Email' name='email'/></td>
        <td><input style='width:100%' type='text' placeholder='Pickup Location' name='address'/></td>
        <td><input style='width:100%' type='text' placeholder='Departs Location' name='departs_location'/></td>
        <td><input style='width:100%' type='text' placeholder='Arrives Work' name='address'/></td>
        <td><input style='width:100%' type='text' placeholder='Departs Work' name='address'/></td>
    </tr>
</table>
<br/>
<input type='submit' value='Add Vanpool To Map' /> &nbsp;&nbsp; <span style='color:red'><?php echo $error ?> </span>
</form>
