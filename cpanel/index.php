<?php
session_start();
if(isset($_SESSION['tz_organizer']))
{
  header("location:home.php");
}
require_once("site-settings.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title><?php echo $title ?> Admin</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="node_modules/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="node_modules/simple-line-icons/css/simple-line-icons.css">
  <link rel="stylesheet" href="node_modules/flag-icon-css/css/flag-icon.min.css">
  <link rel="stylesheet" href="node_modules/perfect-scrollbar/dist/css/perfect-scrollbar.min.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="shortcut icon" href="images/favicon.png" />
  <script type="text/javascript">

  window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 5000);
</script>
</head>
<body>
  <?php
if(isset($_POST['login'])==true){
$orgid=strip_tags(htmlspecialchars(addslashes(strtoupper($_POST['orgid']))));
$orgpass=strip_tags(htmlspecialchars(addslashes($_POST['orgpass'])));
$eorgpass=md5($orgpass);
$check=mysqli_query($con,"SELECT * FROM organizers WHERE orgid='$orgid'");
while($d=mysqli_fetch_array($check,MYSQLI_BOTH)){
  $acc_status=$d['acc_status'];
}
if($acc_status=='Access'){
$dup=mysqli_query($con,"SELECT * FROM organizers WHERE orgid='$orgid' AND orgpass='$eorgpass'");
   if(mysqli_num_rows($dup)==1){
           $_SESSION['tz_organizer']=$orgid;
            $q=mysqli_fetch_array($dup,MYSQLI_BOTH);
              if($q['role']=="Webteam" ){
              $_SESSION['tz_webteam']=$orgid;
             }
          mysqli_query($con,"UPDATE organizers SET status='online' WHERE orgid='".$_SESSION['tz_organizer']."'");
          echo "<script>window.location='home.php'</script>";          
          }else{
          $error='Wrong Username Or Password';
          }

}else if($acc_status=='blocked'){
  $block='Your Account is Blocked by Webteam';
}
}
?>
 <?php
                        if(isset($error)){
                            ?>
                            <center>
                             <div class="alert alert-danger" style="width:70%;">
                                                <strong>Warning!</strong> <?php echo $error?>
                                            </div>
                                          </center>
                        <?php
                        }
                        ?> 
                         <?php
                        if(isset($block)){
                            ?>
                            <center>
                             <div class="alert alert-danger" style="width:70%;">
                                                <strong>Blocked!</strong> <?php echo $block?>
                                            </div>
                                          </center>
                        <?php
                        }
                        ?> 
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper">
      <div class="row">
        <div class="content-wrapper full-page-wrapper d-flex align-items-center auth">
          <div class="row w-100">
            <div class="col-lg-8 mx-auto">
              <div class="row">
                <div class="col-lg-6 bg-white">
                  <div class="auth-form-light text-left p-5">
                    <h2>Login</h2>
                    <h4 class="font-weight-light">Hello! let's get started</h4><br>

                    <form method="post" action="index.php" role="form">
                        <div class="form-group">
                          <!--label for="exampleInputEmail1">Username</label-->
                  <input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Username"  id="orgid" name="orgid" onkeyup="changetouppercase(this.id)" maxlength="7">
                          <i class="mdi mdi-account"></i>
                        </div>
                        <div class="form-group">
                          <!--label for="exampleInputPassword1">Password</label-->
                          <input type="password" class="form-control" placeholder="Password" id="orgpass" name="orgpass">
                          <i class="mdi mdi-eye"></i>
                        </div>
                        <div class="mt-5">
                          <button class="btn btn-block btn-success btn-lg font-weight-medium" name="login">Login</button>
                        </div>
                        <div class="mt-3 text-center">
                          <a href="javascript:alert('Please Contact Webteam for password....')" class="auth-link text-black">Forgot password?</a>
                        </div>                 
                    </form>


                  </div>
                </div>
                <div class="col-lg-6 login-half-bg d-flex flex-row">
                  <p class="text-white font-weight-medium text-center flex-grow align-self-end">Copyright &copy; 2018  All rights reserved.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- row ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="node_modules/jquery/dist/jquery.min.js"></script>
  <script src="node_modules/popper.js/dist/umd/popper.min.js"></script>
  <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="node_modules/perfect-scrollbar/dist/js/perfect-scrollbar.jquery.min.js"></script>
  <!-- endinjec -->
  <!-- inject:js -->
  <script src="js/off-canvas.js"></script>
  <script src="js/hoverable-collapse.js"></script>
  <script src="js/misc.js"></script>
  <script src="js/settings.js"></script>
  <script src="js/todolist.js"></script>
  <!-- endinject -->
</body>

</html>
