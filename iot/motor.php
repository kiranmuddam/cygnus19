<?php
session_start();
include 'connect.php';
if (!isset($_SESSION['iot_user'])) {
    header('Location:index.php');
}
$session = $_SESSION['iot_user'];
?>
<?php

if ((isset($_GET['mot_con'])) && (isset($_GET['value']))) {
    $mot = mysqli_real_escape_string($con, $_GET['mot_con']);
    $value = mysqli_real_escape_string($con, $_GET['value']);
    $r = mysqli_query($con, "SELECT * FROM crops where username='$session'");
    $rr = mysqli_fetch_array($r, MYSQLI_BOTH);
    $c = mysqli_num_rows($r);
    if ($c > 0) {
        $tt = mysqli_query($con, "UPDATE crops set status='$value' where id='$mot'");
        if ($tt == true) {
            $yy = mysqli_query($con, "SELECT * FROM crops where id='$mot'");
            $r = mysqli_fetch_array($yy, MYSQLI_BOTH);
            if ($value == '1') {
                $stat = 'On';
            } else {
                $stat = 'Off';
            }
            $crop = $r['crop'];
            echo "<script>alert('You just changed the " . $r['crop'] . " Crop status to " . $stat . "');window.location='home.php'</script>";
        } else {
            echo "<script>alert('Some Error');window.location='home.php'</script>";
        }
    } else {
        echo "<script>alert('No Crops Exists');window.location='home.php'</script>";
    }
} else {
    echo "<script>alert('Not a valid request');window.location='home.php'</script>";
}
?>

