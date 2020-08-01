<?php
session_start();
include 'connect.php';
if (isset($_SESSION['iot_user'])) {
    header('Location:home.php');
}
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
    <style type="text/css">
        body {
            background-image: url("images/bg5.jpg");
            background-size: 100% 100%;
            background-repeat: none;
        }
    </style>
</head>
<?php

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $r = mysqli_query($con, "SELECT * FROM users where username='$username'");
    $rr = mysqli_fetch_array($r, MYSQLI_BOTH);
    $c = mysqli_num_rows($r);
    if ($c > 0) {
        $status = $rr['status'];
        $role = $rr['type'];
        $epassword = $rr['password'];
        $user = $rr['username'];
        if ($epassword == ($password)) {
            $_SESSION['iot_user'] = $user;
            header('Location:home.php');
        } else {
            echo "<script>alert('Wrong Password')</script>";
        }
    } else {
        echo "<script>alert('Account Doesnot Exists')</script>";
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
                        <input type="text" class="form-control" placeholder="Device id" name="username" required="">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-eye-slash" aria-hidden="true"></i></span>
                        </div>
                        <input type="password" class="form-control" placeholder="********" name="password" required="">
                    </div>
                    <div>
                        <center>
                            <a href="register.php" class="btn btn-outline-info">Register</a>
                            <button type="submit" class="btn btn-outline-success" name="login">Login</button></center>

                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>