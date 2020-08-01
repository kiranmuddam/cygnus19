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
   <link rel="stylesheet" type="text/css" href="assets/css/team.css">
 <?php include_once ('css.php') ?>
  <style type="text/css">
   .hi{
    color:#fff !important;
    background-color:#000 !important;
    width:60% !important;
   }


 </style>
</head>
  <body class="index">



   <?php include_once('header.php');?> 


 <div class="tournaments-page">  
<section class="schedule-section">

   <div class="heading" style="margin-left:40%;">
   <center>
      <div class="copy">        
         <h3>Cygnus Team</h3>         
      </div>
</center>
   </div>
   <div class="heading" style="margin-left:40%;">
   <center>
      <div class="copy">        
         <h4>Details will be updated soon.</h4>         
      </div>
</center>
   </div>
   
</section>



  </div>

<?php include 'title.php' ?>
</div>
<?php include 'login_modal.php' ?>
<?php include 'event_modal.php' ?>
<?php include 'footer.php' ?>
