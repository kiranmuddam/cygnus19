<?php 
session_start();
error_reporting(0);
include'connect.php';
 if(isset($_SESSION['stuid'])==false){
      $stuid='Unknown';
   }else{
      $stuid=$_SESSION['stuid'];
   }

$ip=$_SERVER['REMOTE_ADDR'];
$today=date('Y-m-d');
$currentDate =  time(); 
$dat=date("Y-m-d H:i:s", $currentDate);
$visits=mysqli_query($con,"SELECT * FROM page_logs where dates='$today' and stuid='$stuid' and page='Team'");
$cm=mysqli_num_rows($visits);
  if($cm<=0){
mysqli_query($con,"INSERT INTO page_logs(ip,enter_time,no_of_times,dates,page,hub,stuid) VALUES('$ip','$dat','1','$today','Team','Cygnus','$stuid')");
mysqli_query($con,"INSERT INTO page_logs_log(ip,enter_time,no_of_times,dates,page,hub,stuid) VALUES('$ip','$dat','1','$today','Team','Cygnus','$stuid')");
   }else{
mysqli_query($con,"UPDATE page_logs SET no_of_times=no_of_times+1 where dates='$today' and page='Team' and stuid='$stuid'");
mysqli_query($con,"INSERT INTO page_logs_log(ip,enter_time,no_of_times,dates,page,hub,stuid) VALUES('$ip','$dat','1','$today','Team','Cygnus','$stuid')");        
    }
?>
<!DOCTYPE html>
<html class="index" lang="en" xml:lang="en" >
  <head>
    <meta charset='utf-8'>
<meta content='true' name='HandheldFriendly'>
<meta content='320' name='MobileOptimized'>
<meta content='initial-scale=1.0' name='viewport'>
<meta content='on' http-equiv='cleartype'>
<meta content='IE=edge,chrome=1' http-equiv='X-UA-Compatible'>
<meta content='width=device-width, initial-scale=1.0,maximum-scale=1.0,user-scalable=no,shrink-to-fit=no' name='viewport'>
<link href="index.php" rel="canonical">
<title>Team | Cygnus'19</title>   

<link rel="stylesheet" href="css/style.css"> 
 <?php include_once ('css.php') ?>
  <style type="text/css">
   .hi{
    color:#fff !important;
    background-color:#000 !important;
    width:60% !important;
   }
@media screen and (max-width: 720px) {
  .container2{
   margin-left: 230% !important;
  }
}

@media only screen and (min-width: 1536px) {
  .container1{
    font-size: 14px;
  }
}
@media only screen and (max-width: 1535px) {
  .container1{
    font-size: 13px;
  }
}

 </style>
</head>
  <body class="body">



   <?php include_once('header.php');?> 


  
<div class="container1 container2 modal-content">
  <div class="front side1">
    <div class="content1">
     <center> <img src="images/kiran.jpg" style="border-radius: 150px;" height="200" width="200"></center>
      <p style="font-size:20px;">Kiran
      </p>
    </div>
  </div>
  <div class="back side1">
    <div class="content1">
      <h4>Contact Me</h4>
      
      <form>
        <label>Kiran </label>
        <label>Web Developer</label>
        <label> E-mail : Redacted :) </label>
        
        <label> Mobile : Redacted :)</label> 
      </form>
    </div>
  </div></div>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 <div class="container1" id="mobile" style="">
  <div class="front side1">
    <div class="content1">
     <center> <img src="images/maneesh_f.jpg" style="border-radius: 150px;" height="200" width="200"></center>
      <p style="font-size:20px;">Maneeswar Mutyala
      </p>
    </div>
  </div>
  <div class="back side1">
    <div class="content1">
      <h4>Contact Me</h4>
      
      <form>
        <label>Maneeswar Mutyala [N150945] </label>
        <label>Web Developer</label>
        <label> E-mail : maneeswar2000m@gmail.com </label>
        
        <label> Phone no : 8790042337</label> 
      </form>
    </div>
  </div>
</div> <br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <div class="container1">
  <div class="front side1">
    <div class="content1">
      <center><img src="images/adminsiva.jpg" style="border-radius: 150px;" height="200" width="200"></center>
      <p style="font-size:20px;">Gamidi Siva Nagaraju
      </p>
    </div>
  </div>
  <div class="back side1">
    <div class="content1">
      <h4>Contact Me</h4>
      
      <form>
        <label>Gamidi Siva Nagaraju [N150883] </label>
        <label>Web Developer</label>
        <label> E-mail : sivan150883@gmail.com </label>
        
        <label> Phone no : 7095295375</label> 
      </form>
    </div>
  </div>
</div>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

  <div class="container1">
  <div class="front side1">
    <div class="content1">
    <center>  <img src="images/sur.jpg" style="border-radius: 150px;" height="200" width="200"></center>
      <p style="font-size:20px;">Surendra Jaladi
      </p>
    </div>
  </div>
  <div class="back side1">
    <div class="content1">
      <h4>Contact Me</h4>
      
      <form>
        <label>Surendra Jaladi [N150774] </label>
        <label>Web Developer</label>
        <label> E-mail : N150774@rguktn.ac.in </label>
        
        <label> Phone no : 8897974369</label> 
      </form>
    </div>
  </div>
</div>
</body>
</html>

<?php include 'login_modal.php' ?>
<?php include 'event_modal.php' ?>

<script src="assets/js/application.min.js" type="text/javascript" ></script>
    <script src="assets/js/referral.min.js" type="text/javascript" ></script>    
    <script src="plugins/jquery-toast-plugin-master/src/jquery.toast.js"></script>
    <script src="assets/js/toastr.js"></script>
    <script src="assets/js/script.js"></script>
    <script src="assets/js/validation.min.js"></script>
