<?php
session_start();
if (!isset($_SESSION['iot_user'])) {
    header('Location:index.php');
}
$session = $_SESSION['iot_user'];
include 'connect.php';
?>
<html>

<head>
    <title>Smart Agriculture</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

</head>
<?php

if (isset($_POST['register'])) {
    $dop = mysqli_real_escape_string($con, $_POST['dop']);
    $aop = mysqli_real_escape_string($con, $_POST['aop']);
    $crop = mysqli_real_escape_string($con, $_POST['crop']);
    $r = mysqli_query($con, "SELECT * FROM users where username='$username'");
    $rr = mysqli_fetch_array($r, MYSQLI_BOTH);
    $c = mysqli_num_rows($r);
    if ($c <= 0) {
        $t = mysqli_query($con, "INSERT INTO crops (username,crop,dop,aop) values ('$session','$crop','$dop','$aop') ");
        if ($t == true) {
            echo "<script>alert('Succesfully added')</script>";
        } else {
            echo "<script>alert('Some Error')</script>";
        }
    } else {
        echo "<script>alert('Already Exists Exists')</script>";
    }
}
?>

<body>
    <div class="container mt-2 flux">
        <div class="field">
            <div class="top-view">
                <center>
                    <h3>Statistics of your crops</h3>

                    <a href="logout.php" class="btn btn-outline-warning">Logout</a>
                    <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#myModal">Add Another Crop +</button>
                </center>
            </div>
            <br>
            <?php
            include 'connect.php';
            $yy = mysqli_query($con, "SELECT * FROM crops where username='$session'");
            $t = mysqli_num_rows($yy);
            if ($t == 0) { ?>
                <div class="alert alert-danger text-center">
                    <h5>You didn't add any fileds to your device <?php echo $session ?></h5>
                </div>
            <?php } else { ?>

                <?php
                while ($r = mysqli_fetch_array($yy, MYSQLI_BOTH)) {
                ?>
                    <div class="field-child">
                        <h3><?php echo $r['crop'] . '(' . $r['aop'] . ')'; ?></h3>
                        <i>Water level reached as per requirement:</i>
                        <div class="progress every">

                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" style="width:<?php echo $averages[$p] . '%'; ?>"><?php echo $averages[$p] . '%'; ?></div>
                        </div>

                        <div class="mt-3">
                            <?php
                            if ($r['status'] == 1) {
                                echo '<h5>Motor Status: <a href="motor.php?mot_con=' . $r['id'] . '&value=0" class="btn btn-outline-success">ON</a></h5>';
                            } else {
                                echo '<h5>Motor Status: <a href="motor.php?mot_con=' . $r['id'] . '&value=1" class="btn btn-outline-danger">OFF</a></h5>';
                            }
                            ?>


                        </div>
                    </div>
                    <br>
            <?php
                }
            }
            ?>
        </div>
        <div class="modal fade" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Add fields</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <form method="post" action="?">
                            <div class="">
                                <div class="form-group">
                                    <select name="crop" class="custom-select" required="">
                                        <option value="">Select type of crop</option>
                                        <option value="paddy">Paddy</option>
                                        <option value="wheat">Wheat</option>
                                        <option value="tomato">Tomato</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="number" class="form-control" placeholder="Enter Area(* in hectares)" name="aop" required="">
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Date of Plantation</span>
                                    </div>
                                    <input type="date" class="form-control" name="dop" required="">
                                </div>

                            </div>

                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <center><button type="submit" class="btn btn-danger" name="register" value="submit">Submit</button></center>
                    </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

</body>

</html>