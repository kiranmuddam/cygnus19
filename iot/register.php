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
    <style type="text/css">
        body {
            background-image: url("images/bg5.jpg");
            background-size: 100% 100%;
            background-repeat: none;
        }
    </style>
</head>
<?php
session_start();
include 'connect.php';
if (isset($_POST['register'])) {
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $dop = mysqli_real_escape_string($con, $_POST['dop']);
    $aop = mysqli_real_escape_string($con, $_POST['aop']);
    $crop = mysqli_real_escape_string($con, $_POST['crop']);

    $r = mysqli_query($con, "SELECT * FROM users where username='$username'");
    $rr = mysqli_fetch_array($r, MYSQLI_BOTH);
    $c = mysqli_num_rows($r);
    if ($c <= 0) {
        $t = mysqli_query($con, "INSERT INTO crops (username,crop,dop,aop) values ('$username','$crop','$dop','$aop') ");
        if ($t == true) {
            mysqli_query($con, "INSERT INTO users (username,password) values ('$username','$password') ");
            header('Location:index.php');
        } else {
            echo "<script>alert('Some Error')</script>";
        }
    } else {
        echo "<script>alert('Already Exists Exists')</script>";
    }
}
?>

<body>
    <div class="container main">
        <div class="card">
            <div class="card-head">
                <center>
                    <h3>Smart Agriculture</h3>
                </center>
            </div>
            <div class="card-body bg-light">
                <form action="?" method="post">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-bandcamp" aria-hidden="true"></i></span>
                        </div>
                        <input type="text" class="form-control" placeholder="Device ID" name="username" required="">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-eye-slash" aria-hidden="true"></i></span>
                        </div>
                        <select class="form-control" required name="crop">
                            <option value="">Select type of crop</option>
                            <option value="paddy">Paddy</option>
                            <option value="wheat">Wheat</option>
                            <option value="tomato">Tomato</option>
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-bandcamp" aria-hidden="true"></i></span>
                        </div>
                        <input type="date" class="form-control" placeholder="Date Of Plantation" name="dop" required="">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-bandcamp" aria-hidden="true"></i></span>
                        </div>
                        <input type="number" class="form-control" placeholder="Area of Plantation (Hectares)" name="aop" required="">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-eye-slash" aria-hidden="true"></i></span>
                        </div>
                        <input type="password" class="form-control" placeholder="Password" name="password" required="">
                    </div>

                    <div>
                        <center>
                            <a href="index.php" class="btn btn-outline-info">Login</a>
                            <button type="submit" class="btn btn-outline-success" name="register">Register</button></center>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>